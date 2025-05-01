<?php
namespace App\Interfaces;
use App\Models\Blog;
use App\Models\Post;
use App\Models\AuthorPost;
interface BlogInterface {
    static public function blogList();
    static public function blogShow();
    static public function author($authorPostId);
    static public function authorPost($authorPostId);
}

?>