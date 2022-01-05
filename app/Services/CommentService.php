<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function save($data){
        $comment = new Comment();
        $comment->bug_id = $data['bug_id'];
        $comment->content = $data['content'];
        $comment->user_id = $data['user_id'];
        $comment->images = $data['images']??null;
        $comment->files = $data['files']??null;
        $comment->is_active = 1;
        $comment->save(); 
    }
    
}
