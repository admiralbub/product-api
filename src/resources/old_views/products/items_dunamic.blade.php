@foreach($products as $product)
    <x-products.product :product="$product"></x-products.product>
@endforeach