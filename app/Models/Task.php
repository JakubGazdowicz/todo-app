<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration_minutes',
        'task_category_id',
        'user_id',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function (Task $task) {
            $user = User::find($task->user_id);
            $taskDuration = $task->duration_minutes;

            self::subtractMinutesFromUserAfterCreateOrUpdateTask(
                taskDuration: $taskDuration,
                user: $user,
            );
        });

        static::updating(function (Task $task) {
            $originalUserId = $task->getOriginal('user_id');
            $originalDuration = $task->getOriginal('duration_minutes');

            $newUserId = $task->user_id;
            $newDuration = $task->duration_minutes;

            if ($originalUserId != $newUserId) {
                $originalUser = User::find($originalUserId);
                self::compensateUserMinutesAfterUpdateTask($originalDuration, $originalUser);

                $newUser = User::find($newUserId);
                self::subtractMinutesFromUserAfterCreateOrUpdateTask($newDuration, $newUser);
            } else {
                $user = User::find($newUserId);

                self::compensateUserMinutesAfterUpdateTask($originalDuration, $user);

                self::subtractMinutesFromUserAfterCreateOrUpdateTask($newDuration, $user);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function taskCategory(): BelongsTo
    {
        return $this->belongsTo(TaskCategory::class);
    }

    private static function subtractMinutesFromUserAfterCreateOrUpdateTask($taskDuration, ?User $user = null): void
    {
        if ($user) {
            if ($user->remaining_minutes < $taskDuration) {
                throw new Exception("Nie masz wystarczającej liczby minut, aby dodać to zadanie");
            }

            $user->remaining_minutes -= $taskDuration;
            $user->save();
        }
    }

    private static function compensateUserMinutesAfterUpdateTask($taskDuration, ?User $user = null): void
    {
        if ($user) {
            $user->remaining_minutes += $taskDuration;
            $user->save();
        }
    }
}
