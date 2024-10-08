import {UserResource} from "@/Resources/User.resource";

export type TaskCategoryResource = {
    id: number;
    name: string;
    userId: number | null;
    createdAt: string;
    updatedAt: string;

    user?: UserResource | null;
}
