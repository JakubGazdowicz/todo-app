export type PaginateResource<T> = {
    data: T[];
    links: {
        first: string;
        last: string;
        next: string | null;
        prev: string | null;
    }
    meta: {
        pagination: {
            current_page: number;
            from: number;
            last_page: number;
            links: Link[];
            path: string;
            per_page: number;
            to: number;
            total: number;
        };
    };
};

type Link = {
    active: boolean;
    label: string;
    url: string | null;
}
