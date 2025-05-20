<?php
namespace App\Services;
 
use App\Interfaces\BlogInterface;
use App\Models\Post;
use App\Models\AuthorPost;
class BlogService implements BlogInterface {

    static  public $paginate_count = 12;
    static public function blogList() {
        return Post::available()->orderBy('id','DESC')->paginate(self::$paginate_count);
    }
    static public function blogShow() {
        return Post::available()->with('author')->first();
    }
    static public function blogMain() {
        return Post::available()->orderBy('id','DESC')->with('author')->limit(3)->get();
    }
    static public function author($authorPostId) {
        return AuthorPost::where('id', $authorPostId)->available()->first();
    }
    static public function authorPost($authorPostId) {
        return Post::where('author_id', $authorPostId)->available()->paginate(self::$paginate_count);
    }

}

?>