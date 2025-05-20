<x-layouts.app  
    :title="__('Author blog').' - '.$author->name"
    :descriptions="__('Author blog').' - '.$author->name"
    :keywords="__('Author blog').' - '.$author->name"
    no_index=0>
    
    <div class="container py-5">
        <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>
        <div class="blog_show mt-3 mb-5">
            <h1 class="fs-2">{{__('Author blog').' - '.$author->name}}</h1>
            <div class="py-3">
                @if($author->available())
                    <x-post.author :author="$author"/>
                @endif
            </div>
            <div class="mt-4">
                <span class="fs-3 fw-bold">
                    {{__('All articles by the author')}}
                </span>
            </div>
        </div>
        <div class="blogs mt-4">
            
            @if(count($posts))
                <div class="row g-4">
                    @foreach($posts as $blog)
                        <x-post.post :blog="$blog"/>
                    @endforeach
                </div>
            @else
                <p>{{__('At the moment, the blog is empty')}}</p>
            @endif
        </div>
    </div>

</x-layouts.app>