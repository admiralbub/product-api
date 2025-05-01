<?xml version="1.0" encoding="utf-8" standalone="no"?>
<yml_catalog date="{{ date('Y-m-d H:i') }}">
  <shop>
    <name>Національна онлайн дистрибуція GrowexMarket</name>
    <company>Національна онлайн дистрибуція GrowexMarket</company>
    <currencies>
      <currency id="UAH" rate="1"/>
      <currency id="USD" rate="1.000000"/>
      <currency id="EUR" rate="1.000000"/>
    </currencies>
    <categories>
      @foreach($products_category as $product_category)
        @if($product_category->parent_id == "")
           
                
            @foreach($product_category->childs->sortBy('sort') as $subcategory)
               <category id="{{ $subcategory->id }}">{{ $product_category->name_ua }} - {{$subcategory->name_ua}}</category>
            @endforeach
            @foreach($subcategory->childs->sortBy('sort') as $subcategory2)
                  <category id="{{ $subcategory2->id }}" parentId="{{ $subcategory->id }}">{{ $subcategory2->name_ua }}</category>
            @endforeach

        @endif
      @endforeach
      @foreach($products_category as $product_category)
        @if($product_category->parent_id == "")
           
                
            @foreach($product_category->childs->sortBy('sort') as $subcategory)
                @foreach($subcategory->childs->sortBy('sort') as $subcategory2)
                     <category id="{{ $subcategory2->id }}" parentId="{{ $subcategory->id }}">{{ $subcategory2->name_ua }}</category>
                @endforeach
            @endforeach
           

        @endif
      @endforeach

     
    </categories>
    <offers>
      @foreach($products as $product)
        <offer id="{{$product->id}}" available="true">
          <price>{{ $product->price }}</price>
          <currencyId>UAH</currencyId>
          <name>{{$product->name_ua}}</name>
           @if($product->categories->first->getRootCategory())
              <categoryId>{{ $product->categories->first->getRootCategory()->id }}</categoryId>
          @endif
          <quantity_in_stock>0</quantity_in_stock>
          <url>{{route('product.view',['slug'=>$product->slug])}}</url>
          <picture>{{ asset($product->image) }}</picture>
        </offer>
      @endforeach
    </offers>
  </shop>
</yml_catalog>