<?php

namespace App\Repositories;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Dto\ProductDto;
class ProductRepository implements ProductRepositoryInterface
{
    public function lists(){
        return Product::all();
    }
    public function getById($id){
        return Product::find($id);
    }
    public function create(ProductDto $productDto){
        $productAttributes = [
            'name' => $productDto->name,
            'price' => $productDto->price,
            'category' => $productDto->category,
            'attributes' => $productDto->attributes,
        ];

        return Product::create($productAttributes);
    }
 
    public function update($id, ProductDto $productDto){
        $productAttributes = [
            'name' => $productDto->name,
            'price' => $productDto->price,
            'category' => $productDto->category,
            'attributes' => $productDto->attributes,
        ];

        return Product::whereId($id)->update($productAttributes);
    }
     
    public function delete($id){
        Product::destroy($id);
    }
    
}
