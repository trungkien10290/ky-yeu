<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function save($data)
    {
        return Comment::create($data);
    }
}
