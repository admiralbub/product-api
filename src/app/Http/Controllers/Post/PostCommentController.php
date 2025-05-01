<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Interfaces\CommentPostInterface;
class PostCommentController extends Controller
{
    public function __construct(public CommentPostInterface $commentPost)
    {
    }

    public function send(CommentRequest $request,$id) {
        $this->commentPost->addComment($request,$id);
        return response()->json([
            'success'=>  __('Thank you for your feedback. Your review will be published within this hour.'),
            'redirect' => route('blog.index',['slug'=>$request->slug])
        ]);
    }
}
