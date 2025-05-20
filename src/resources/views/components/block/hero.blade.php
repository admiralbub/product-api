@props([
    'h1',
    'breadcrumbs'
])
<section class="shop-hero">
    <div class="overlay"></div>

    <div class="container text-center">
        @if($breadcrumbs)
            <nav aria-label="breadcrumb">
                
                <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>
            </nav>
        @endif
        <h1 class="shop-title">{{$h1}}</h1>
    </div>
</section>