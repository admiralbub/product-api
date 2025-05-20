<x-layouts.app  
    :title="$blog->meta_title_parsed ? $blog->meta_title_parsed : $blog->meta_title"
    :descriptions="$blog->meta_description_parsed ? $blog->meta_description_parsed : $blog->meta_description"
    :keywords="$blog->meta_keywords_parse ? $blog->meta_keywords_parsed : $blog->meta_keywords"
    no_index=0>


    <x-block.hero :h1="$blog->h1_parsed ? $blog->h1_parsed : $blog->h1" :breadcrumbs="$breadcrumbs"></x-x-block.hero>
    <div class="container">
        @push('head')
            <x-schema-org.blog :blog="$blog" />
        @endpush
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="blog-post mt-3">
                    <!-- Featured Image -->
                    <div class="featured-image position-relative mb-4">
                        <img src="{{asset($blog->img)}}" alt="Father with children in a farm field" class="img-fluid rounded">
                        <div class="date-badge">{{$blog->created_at->format('d.m.Y')}}</div>
                    </div>
                    
                    <!-- Author Info -->
                    <div class="post-meta d-flex align-items-center">
                        <div class="author">
                            <i class="bi bi-person-fill"></i> 
                            <a href="{{route('blogs.author',['id'=>$blog->author->id])}}">{{$blog->author->name}}</a>
                        </div>
                        <div class="comments ms-4">
                            <i class="bi bi-chat-fill"></i> {{$blog->comment->count()}}
                        </div>
                    </div>
                    
                    <!-- Post Title -->
                    <span class="post-title py-3">{{$blog->h1_parsed ? $blog->h1_parsed : $blog->h1}}</span>
                    <!-- Post Content -->
                    <div class="post-content">
                        {!! $blog->description !!}
                    </div>
                </div>
            </div>
        </div>

       
        <div class="container py-5">
            
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <x-post.comments :comments="$comments" :blog="$blog"/>
                    
                    <x-post.comment-form :id="$blog->id" :slug="$blog->slug"/>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>