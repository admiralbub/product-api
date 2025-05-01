<?php

namespace App\Actions\BlogComment;
use App\Models\BlogComment;
class BlogCommentAction
{
    /**
     * Create a new class instance.
     */
    public function execute($request,$id): BlogComment
    {
        $feedback = BlogComment::create([
            'user_name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'post_id'=>$id,
            'comment'=>$request->comment,

        ]);
        
        return $feedback;
        
    }
}