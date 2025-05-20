<x-layouts.app  
    :title="__('Stocks')"
    :descriptions="__('Stocks')"
    :keywords="__('Stocks')"
    :no_index=0>
    <x-block.hero :h1="__('Stocks')" :breadcrumbs="$breadcrumbs"></x-x-block.hero>

    <div class="container mb-5">
        <div class="stocks">
            @if(count($stocks)>0)
                @foreach($stocks as $stock)
                    <x-stock.stock :stock="$stock" :lang="$lang"></x-stock.stock>
                @endforeach
                {!! $stocks->links() !!}
            @else
                <p>{{__('stock_title_noempty')}}</p>
            @endif
        </div> 
    </div>
</x-layouts.app>