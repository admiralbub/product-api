
@if(count($category)!=0)
    <div class="categories-block">
        <div class="categories-block-header">
            <h3>{{__('Product categories')}}</h3>
        </div>
        
        <ul class="categories-block-list" id="categoriesList">
            
            @foreach($category as $child)
                <li class="category-item">
                    <a href="{{route('product.category',$child->slug)}}" class="category-item">
                        <span>{{$child->name}}</span>
                        <span class="arrow-icon"><i class="bi bi-chevron-right"></i></span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="filter">
        <h3 class="mb-3">{{__('Price')}}</h3>
                        
        <div class="slider-container">
            <div class="slider-track">
                <div class="slider-track-highlight" id="track-highlight"></div>
            </div>
            <div class="thumb" id="min-thumb"></div>
            <div class="thumb" id="max-thumb"></div>
        </div>
        <form action="#" method="get">                    
            <div class="price-range">
        
                <input type="text" class="input-min form-control js-price-down" value="1" value="1" name="min_price" data-min="1" id="min-price">
                <span>-</span>
                
                <input type="text" id="max-price" class="input-max form-control js-price-up" value="{{max($price)}}" name="max_price" data-max="{{max($price)}}">
            </div>
            <div class="mt-2 d-grid gap-2">
                <button class="btn btn-primary">{{__('Apply')}}</button>
            </div>
        </form>                
    </div>
</div>
@if($brands->count() != 0)
    <div class="selection-container container mt-5">
        <div class="selection-title">{{__('Brand')}}</div>
        <div class="scrollable-options">
            @foreach($brands as $brand)
                <div class="form-check">
                    <input class="form-check-input filter_brand_check" type="checkbox" name="brand" value="{{filterUrlAttr(\Request::url(),$brand->id,'brand')}}" {{isset($selectedFilter["brand"]) ? in_array($brand->id,$selectedFilter["brand"] ) ? 'checked' : "" : ""}}>
                    <label class="form-check-label" for="basf">
                        <a href="{{filterUrlAttr(\Request::url(),$brand->id,'brand')}}" class="text-secondary">{{$brand->name}}</a>
                    </label>
                </div>
            @endforeach
        </div>
    </div>
@endif

@if($attrs)
    @foreach ($attrs as $groupName => $attributes)
        <div class="selection-container container mt-5">
            <div class="selection-title">{{$groupName}}</div>
            <div class="scrollable-options">
                @foreach ($attributes as $attr) 
                    <div class="form-check">
                        <input class="form-check-input filter_attr_check" type="checkbox" name="brand" value="{{filterUrlAttr(\Request::url(), $attr->id, $attr->group)}}" {{isset($selectedFilter[$attr->group]) ? in_array($attr->id,$selectedFilter[$attr->group] ) ? 'checked' : "" : ""}}>
                        <label class="form-check-label" for="basf">
                            <a href="{{filterUrlAttr(\Request::url(), $attr->id, $attr->group)}}" class="text-secondary">{{$attr->name}}</a>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

    @endforeach
@endif

