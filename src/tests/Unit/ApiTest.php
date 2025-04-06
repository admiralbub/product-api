<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
class ApiTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create_to_product() {
        $products = [
            'name' => 'Product 22',
            'price' => 1.99,
            'category' => 'E-book',
            'attributes' => ['format' => 'PEN', 'pages' => 2],
        ];
        $this->post(route('api.create'), $products)
            ->assertStatus(200);
    }
    public function test_update_to_product() {
        $product = Product::first();
        $products = [
            'name' => 'Product 22',
            'price' => 1.99,
            'category' => 'E-book',
            'attributes' => ['format' => 'PEN', 'pages' => 2],
        ];
        $this->patch(route('api.getById',$product->id), $products)
            ->assertStatus(200);
    }
    public function test_list_to_products() {
        $this->get(route('api.lists'))
            ->assertStatus(200);
    }

    public function test_retrieve_product_details() {
        $product = Product::first();
        $this->get(route('api.getById',$product->id))
            ->assertStatus(200);
    }
    public function test_delete_product() {
        $product = Product::first();
        $this->delete(route('api.delete',$product->id))
            ->assertStatus(200);
    }
}
