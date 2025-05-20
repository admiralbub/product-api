<x-layouts.app  
    :title="__('Blog')"
    :descriptions="__('Blog')"
    :keywords="''"
    no_index=0>


    <x-block.hero :h1="__('Blog')" :breadcrumbs="$breadcrumbs"></x-x-block.hero>


    <div class="container">
        <div class="mt-3 mb-5">

            <div class="news-section mt-4">
                @if(count($blogs))
                    @foreach($blogs as $blog)
                        <x-post.post :blog="$blog"/>
                    @endforeach
                @else
                    <p>{{__('At the moment, the blog is empty')}}</p>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>