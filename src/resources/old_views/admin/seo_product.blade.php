<div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column gap-3">
    <form method="post">
        @foreach($seo_products as $seo_product)
            @csrf
            @if($seo_product->type=="field")
                <div class="position-relative">
                    <label class="form-label">{{$seo_product->name}}</label>

                    <input class="form-control"  name="seo_product[{{$seo_product->key_meta_tag}}]" value="{{$seo_product->value_meta_tag}}">

                </div>
            @endif
            @if($seo_product->type=="text")
                <div class="position-relative">
                    <label class="form-label">{{$seo_product->name}}</label>

                    <textarea class="form-control" name="seo_product[{{$seo_product->key_meta_tag}}]"  rows="3">{{$seo_product->value_meta_tag}}</textarea>
                </div>
            @endif
            
        @endforeach
    </form>
</div>
