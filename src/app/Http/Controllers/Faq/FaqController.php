<?php

namespace App\Http\Controllers\Faq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Breadcrumbs\Breadcrumb;
class FaqController extends Controller
{
    public function __construct(
        //private Blog $blog,
        private Faq $faq,
        public Breadcrumb $breadcrumbs
    ) {

    }
    public function index()
    {
        $bread = [
            "name"=>__("Faq"),
            "route"=>"faq.index"
        ];
        
        $faqs = $this->faq->available()->get();
        $breadcrumbs = $this->breadcrumbs->breadPage($bread);
        return response()
            ->view('faq.index', compact('faqs','breadcrumbs'));
    }
}
