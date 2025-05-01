<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\BlogInterface;
use App\Breadcrumbs\Breadcrumb;
use App\Interfaces\CommentPostInterface;
class BlogPostController extends Controller
{

    public function __construct(
        private BlogInterface $blog,
        private  Breadcrumb $breadcrumbs,
        private CommentPostInterface $commentPost
    ) {}
    public function __invoke() {
        
        $blogs = $this->blog->blogList();
        $bread = [
            "name"=>__("Blog"),
            "route"=>"blog.list"
        ];
        $breadcrumbs = $this->breadcrumbs->breadPage($bread);
        return view('blog.list',[
            'blogs'=>$blogs,
            'breadcrumbs'=>$breadcrumbs
        ]);
    }

    public function show(Request $request,$slug) {
        $blog = $this->blog->blogShow($slug);
        $listComments = $this->commentPost->listComment($slug);
        
        $bread = [
            "name"=>$blog->name,
            "route"=>'blog.index',
            'slug' => $blog->slug,
            "parent" => [
                "name"=>__("Blog"),
                "route"=>"blog.list"
            ],
        ];

        $breadcrumbs = $this->breadcrumbs->breadPage($bread);


        return view('blog.index',[
            'blog'=>$blog,
            'comments'=>$listComments,
            'breadcrumbs'=>$breadcrumbs
        ]);
    }
    public function author($id)
    {
        
        $author = $this->blog->author($id);
        $posts = $this->blog->authorPost($id);
        if(!$author) {
            abort(404);
        }
        $bread = [
            "name"=>$author->name,
            "id"=>$author->id,
            "route"=>"blogs.author",
            "parent" => [
                "name"=>__("Blog"),
                "route"=>"blog.list"
            ],
            
            
        ];
        $breadcrumbs = $this->breadcrumbs->breadPage($bread);
        return view('blog.author',[
            'author'=>$author,
            'posts'=>$posts,
            'breadcrumbs'=>$breadcrumbs
        ]);
    }

}
