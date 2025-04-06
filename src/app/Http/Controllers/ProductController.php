<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Responses\ApiResponse;
use App\Interfaces\ProductRepositoryInterface;
use App\Dto\ProductDto;
class ProductController extends Controller
{
    public function __construct(private readonly ProductRepositoryInterface $products)
    {

    }
     /**
     * Получить список продуктов.
     *
     * @return ApiResponse
     */
    public function lists()
    {
        $data = $this->products->lists();

        return new ApiResponse(200, ProductResource::collection($data), '');

    }
    /**
     * Получить продукт по ID.
     *
     * @param int $id
     * @return ApiResponse
     */
    public function getById($id) {
        $product = $this->products->getById($id);
        if(!$product) {
            return new ApiResponse(404, '', 'Not found product');
        }
        return new ApiResponse(200, new ProductResource($product), '');
    }

    /**
     * Создать новый продукт.
     *
     * @param ProductRequest $request
     * @return ApiResponse
     */
    public function create(ProductRequest $request) {
        try {
            $productDto = new ProductDto($request->validated());
            $product = $this->products->create($productDto);
        } catch (\Exception $ex) {
            return new ApiResponse(500, '', $ex->getMessage());
        }
        return new ApiResponse(200, 'Product successfully added!', '');
    }
    /**
     * Обновить продукт.
     *
     * @param int $id
     * @param ProductRequest $request
     * @return ApiResponse
     */
    public function update($id, ProductRequest $request) {


        $product = $this->products->getById($id);
        if (!$product) {
            return new ApiResponse(404, '', 'Product not found');
        }
        try {
            $productDto = new ProductDto($request->validated());
            $this->products->update($id, $productDto);
        } catch (\Exception $ex) {
            return new ApiResponse(500, '', $ex->getMessage());
        }
        return new ApiResponse(200, 'Product successfully update!', '');
    }
    /**
     * Удалить продукт.
     *
     * @param int $id
     * @return ApiResponse
     */
    public function delete($id) {

        $product = $this->products->getById($id);
        if (!$product) {
            return new ApiResponse(404, '', 'Product not found');
        }
        try {
            $this->products->delete($id);
        } catch (Exception $e) {
            return new ApiResponse(500, '', '' . $e->getMessage());
        }
        return new ApiResponse(200, 'Product successfully delete!', '');
    }
}
