<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Comment extends Model
{
    use HasFactory;

    public function bug()
    {
        return $this->belongsTo(Bug::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::created(function (Comment $comment) {
            try {
                $comment->bug()->increment('comments_count');
            } catch (\Throwable $exception) {
                Log::info($exception->getMessage());
            }

        });

        static::deleted(function (Comment $comment) {

            try {
                $comment->bug()->decrement('comments_count');
            } catch (\Throwable $exception) {
                Log::info($exception->getMessage());
            }

        });
    }

}
