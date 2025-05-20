<x-layouts.app  
    :title="__('Blog')"
    :descriptions="__('Blog')"
    :keywords="''"
    no_index=0>

    <div class="container">
        <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>
        <div class="mt-3 mb-5">
            <h1 class="fs-2">{{__('Blog')}}</h1>

            <div class="blogs mt-4">
                @if(count($blogs))
                    <div class="row g-4">
                        @foreach($blogs as $blog)
                            <x-post.post :blog="$blog"/>
                        @endforeach
                    </div>
                @else
                    <p>{{__('At the moment, the blog is empty')}}</p>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>