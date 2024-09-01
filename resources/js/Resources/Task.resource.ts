import {UserResource} from "@/Resources/User.resource";
import {TaskCategoryResource} from "@/Resources/TaskCategory.resource";

export type TaskResource = {
    id: number;
    name: string;
    description: string | null;
    durationMinutes: number;
    userId: number | null;
    taskCategoryId: number | null;
    createdAt: string;
    updatedAt: string;

    user: UserResource | null;
    taskCategory: TaskCategoryResource | null;
}
