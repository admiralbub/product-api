<?php

namespace App\Interfaces;

use App\Dto\ProductDto;

interface ProductRepositoryInterface
{
    public function lists();
    public function getById($id);
    public function create(ProductDto $product);
    public function update($id, ProductDto $product);
    public function delete($id);
}
