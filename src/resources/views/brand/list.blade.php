<x-layouts.app  
    :title="__('Brand')"
    :descriptions="''"
    :keywords="''"
    no_index=0>

    <x-block.hero :h1="__('Brand')" :breadcrumbs="$breadcrumbs"></x-x-block.hero>
    <div class="container py-2">
        
        <div class="row brands mt-5">
            @foreach($brands as $brand)
                <x-brand.list :brand="$brand"/>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $brands->links() }}
        </div>
    </div>
</x-layouts.app>