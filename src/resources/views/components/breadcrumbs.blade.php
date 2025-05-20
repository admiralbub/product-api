@push('head')
<x-schema-org.bread-crumb :breadcrumbs="$breadcrumbs"/>
@endpush
<ol class="breadcrumb justify-content-center">
    <li class="breadcrumb-item"><a href="{{route('index')}}">{{__('Home')}}</a></li>
    @if(isset($breadcrumbs[0]['type']) && !empty($breadcrumbs[0]['type'] == "page"))
        @foreach($breadcrumbs as $breadcrumb)
            @if (isset($breadcrumb['parent']))
                <li class="breadcrumb-item"><a href="{{route($breadcrumb['parent']['route'])}}">{{ $breadcrumb['parent']['name'] }}</a></li>
                <li class="breadcrumb-item active"><a href="{{$breadcrumb['slug'] ? route($breadcrumb['route'], ['slug' => $breadcrumb['slug']]) : route($breadcrumb['route'], ['id' => $breadcrumb['id']])}}">{{ $breadcrumb['name'] }}</a></li>
            @else
                <li class="breadcrumb-item active"><a href="{{ $breadcrumb['slug'] ? route($breadcrumb['route'], ['slug' => $breadcrumb['slug']]) : route($breadcrumb['route'], ['id' => $breadcrumb['id']])}}">{{ $breadcrumb['name'] }}</a></li>
            @endif
                    
                    
        @endforeach
    @else
        @foreach($breadcrumbs as $i => $breadcrumb)
            <li class="breadcrumb-item @if(!isset($breadcrumb['name_product'])) @if($breadcrumbs->last()['id'] === $breadcrumb['id']) active @endif @endif"><a href="{{route('product.category',$breadcrumb['slug'])}}">{{ $breadcrumb['name'] }}</a></li>
                    
        @endforeach
        @if(isset($breadcrumb['name_product']))
            <li class="breadcrumb-item active"><a href="{{route('product.view',$breadcrumb['name_slug'])}}">{{ $breadcrumb['name_product'] }}</a></li>
        @endif
    @endif

</ol>