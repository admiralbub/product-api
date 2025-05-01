<?php
namespace App\Services;
 
use App\Interfaces\CommentPostInterface;
use App\Models\Post;
use App\Models\BlogComment; 
use App\Actions\BlogComment\BlogCommentAction;
    


class CommentPostService implements CommentPostInterface {
    public function addComment($request,$id) {
        return (new BlogCommentAction())->execute($request,$id);
    }
    public function listComment($slug) {
        $post = Post::where('slug',$slug)->available()->first();
        return BlogComment::where('post_id',$post->id)->available()->get();
    }
}