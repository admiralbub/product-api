<?php
namespace App\Interfaces;
use App\Models\Feedback;
use App\Models\Post;
interface CommentPostInterface {
    public function addComment($request,$id);
    public function listComment($slug);
    
}
?>