<?php

namespace App\Http\Controllers\Salesdriver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\SalesdriverInterface;
class ExportSalesdriverProdController extends Controller
{
  //  public $salesdriver;
    public function __construct(
        public SalesdriverInterface $salesdriver
    )
    {
       // $this->salesdriver = $salesdriver;
    }
    public function __invoke() {
        $products =  $this->salesdriver->exportProductSalesdriver();
        $feedHtml = view('salesdriver.salesdriver_product', [
            'products' => $products['products'],
            'products_category'=>$products['products_category'],
        ])->render();


        return response($feedHtml)
            ->header(
                'Content-Type', 'text/xml'
            );   
    }
}
