@props([
    'brand',
])
<div class="col-md-2 col-sm-6" onclick="document.location='{{route('product.brand.show',['slug'=>$brand->slug])}}'">
    <div class="brand-item">
        <a href="{{route('product.brand.show',['slug'=>$brand->slug])}}">
            <img src="{{asset($brand->images)}}" alt="Easy Harvesting">
            <div class="brand-caption">
                {{$brand->name}}
            </div>
        </a>
    </div>
</div>