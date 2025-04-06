<?php
namespace App\Dto;

class ProductDto {
    public ?string $name;
    public ?float $price;
    public ?string $category;
    public array $attributes = [];

    public function __construct(array $data) {
        $this->name = $data['name'];
        $this->price = $data['price'];
        $this->category = $data['category'];
        $this->attributes = $data['attributes'];

    }
   
}
?>