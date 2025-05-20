<x-layouts.app  
    :title="$blog->meta_title_parsed ? $blog->meta_title_parsed : $blog->meta_title"
    :descriptions="$blog->meta_description_parsed ? $blog->meta_description_parsed : $blog->meta_description"
    :keywords="$blog->meta_keywords_parse ? $blog->meta_keywords_parsed : $blog->meta_keywords"
    no_index=0>

    <div class="container">
        @push('head')
            <x-schema-org.blog :blog="$blog" />
        @endpush
        <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>

        <div class="blog_show mt-3 mb-5">
            @if($blog->img)
                <div class="blog_show-img py-3">
                     <img src="{{asset($blog->img)}}" alt="">
                </div>
            @endif
            <h1 class="fs-2">{{$blog->h1_parsed ? $blog->h1_parsed : $blog->h1}}</h1>
            <div class="py-3">
                <i class="bi bi-clock"></i>
                {{$blog->created_at->format('d.m.Y H:i')}}
            </div>
            <div class="mt-3">
                {!! $blog->description !!}
            </div>
            <div class="py-3 blog_author">
                @if($blog->author->available())
                    <x-post.author :author="$blog->author"/>
                @endif
            </div>
        </div>
        <div class="container py-5">
            
            <div class="row">
                <x-post.comments :comments="$comments" :blog="$blog"/>
                
                <x-post.comment-form :id="$blog->id" :slug="$blog->slug"/>
            </div>
        </div>
    </div>
</x-layouts.app>