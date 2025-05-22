<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Requests\ContactRequest;
use App\Interfaces\PageInterface;
use App\Breadcrumbs\Breadcrumb;
class PageController extends Controller
{
    private $page;
    private $breadcrumbs;
    public function __construct(PageInterface $page, Breadcrumb $breadcrumbs) {
        $this->page = $page;
        $this->breadcrumbs = $breadcrumbs;
    }

    public function index($slug) {
        $page = $this->page->getPage($slug);
        $bread = [
            "name"=>$page->name,
            "route"=>'page.pages',
            'slug' => $page->url
        ];

        $breadcrumbs = $this->breadcrumbs->breadPage($bread);
        return view('page.page',[
            'page'=>$page,
            'breadcrumbs'=>$breadcrumbs
        ]);
    }
    public function contactSend(ContactRequest $request) {
        return response()->json([
            'success'=>  __('add_form'),
            'redirect' => route('page.pages','kontakti')
        ]);
    }
    
}
