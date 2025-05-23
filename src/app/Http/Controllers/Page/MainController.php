<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\MainPageInterface;
use App\Interfaces\BlogInterface;
use App\Models\MainSlider;
class MainController extends Controller
{
   // private $mainPage;
    public function __construct(private MainPageInterface $mainPage,private BlogInterface $blogMain) {
       // $this->mainPage = $mainPage;
    }
    public function __invoke() {
        $slidersMains = $this->mainPage->getMainSlider();
        $newProduct = $this->mainPage->getProductNew();
        $recommendedProduct = $this->mainPage->getProductRecommended();

        $saleProduct = $this->mainPage->getProductSale();
        
        $popularProduct = $this->mainPage->getProductPopular();
        $blogMains = $this->blogMain->blogMain();


        $page = $this->mainPage->getMainPage();
        if(!$page) {
            abort(404);
        }
        return view('index',compact(
            'slidersMains',
            'newProduct',
            'recommendedProduct',
            'saleProduct',
            'popularProduct',
            'page',
            'blogMains'
        ));
    }
}
