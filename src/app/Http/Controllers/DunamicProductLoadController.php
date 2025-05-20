<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ProductInterface;
class DunamicProductLoadController extends Controller
{
    public function __construct(
        private ProductInterface $productInt
    ) {

    }
    public function loadMore(Request $request) {
        $skip = $request->input('skip', 0);
        $limit = $request->input('limit', 22);
        $products = $this->productInt->loadDunamicProduct($skip, $limit);
        return response()->json([
            'html' => view('products.items_dunamic', compact('products'))->render(),
            'count' => $products->count()
        ]);
    }
}
