<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'durationMinutes' => $this->duration_minutes,
            'description' => $this->description,
            'userId' => $this->user_id,
            'taskCategoryId' => $this->task_category_id,
            'createdAt' => Carbon::dateFormat($this->created_at),
            'updatedAt' => Carbon::dateFormat($this->updated_at),

            'user' => UserResource::make($this->whenLoaded('user')),
            'taskCategory' => TaskCategoryResource::make($this->whenLoaded('taskCategory')),
        ];
    }
}
