<?php

namespace App\Http\Controllers\FoundCheaper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FoundCheaperRequest;
use App\Actions\FoundCheaper\FoundCheaperAction;
class FoundCheaperController extends Controller
{
    public function __invoke(FoundCheaperRequest $request, $slug) {
        $data = $request->only(['name', 'phone', 'product_id','url','comment']);
        (new FoundCheaperAction())->execute($data);
        return response()->json([
            'success'=>  __('add_form'),
            'redirect' => route('product.view',$slug)
        ]);
    }
}
