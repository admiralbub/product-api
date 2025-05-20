<x-layouts.app  
    :title="__('not_found_title')"
    :descriptions="__('not_found_title')"
    :keywords="__('not_found_title')"
    no_index=1>

    <x-block.hero :h1="__('not_found_title')" :breadcrumbs="''"></x-x-block.hero>

    <div class="container  mt-5  not-page">
	    <h2>{{__("not_found_title")}}</h2>
        <div class="mt-4 fs-5">
            @foreach(__('not_found_text') as $text)
                {!! $text !!}
            @endforeach
        </div>
        <a href="{{route('index')}}" class="btn btn-primary px-4 py-2 mt-2 fw-bold">{{__('Home')}}</a>
       
    </div>

</x-layouts.app>