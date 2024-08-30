<?php

namespace App\Models\Traits;

trait Search
{
    protected function search(string $search)
    {
        return self::where(function ($query) use ($search) {
            $searchLow = strtolower(trim($search));
            $searchLowAndTrim = str_replace(' ', '', $searchLow);

            $relationColumns = [];
            $normalColumns = [];

            foreach ($this->searchable as $string) {
                if (str_contains($string, '.')) {
                    $relationColumns[] = $string;
                } else {
                    $normalColumns[] = $string;
                }
            }

            $query->where(function($row) use( $searchLow, $normalColumns, $searchLowAndTrim ) {
                foreach ($normalColumns as $r) {
                    $row->orWhereRaw('LOWER('.$r.') LIKE ?', ["%$searchLow%"]);
                    $row->orWhereRaw('LOWER(REPLACE('.$r.', " ", "")) LIKE ?', ["%$searchLowAndTrim%"]);
                }
            });

            $query->orWhere(function($row) use( $searchLow, $relationColumns, $searchLowAndTrim ) {
                foreach ($relationColumns as $r) {
                    $c = explode('.', $r);
                    if(count($c) > 2) throw new \Exception('LCI Searchable: you can only search in basic relations of type "relation.column" and not "relation.in.relation.column"');
                    $row->orWhereHas($c[0], function ($q) use($r, $c, $searchLow, $searchLowAndTrim) {
                        $q->whereRaw('LOWER('.$q->from.'.' . $c[1] . ') LIKE ?', ["%$searchLow%"]);
                        $q->orWhereRaw('LOWER(REPLACE('.$q->from.'.' . $c[1].', " ", "")) LIKE ?', ["%$searchLowAndTrim%"]);
                    });
                }
            });
        });
    }
}
