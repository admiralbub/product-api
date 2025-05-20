@props([
    'author',
])

<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-2">
            <img src="{{asset($author->img)}}" class="author-avatar  img-fluid img-thumbnail rounded-start" >
        </div>
        <div class="col-md-10">
            <div class="card-body">
                <span class="blog_author_name card-title" itemprop="author">
                    <a href="{{route('blogs.author',['id'=>$author->id])}}">
                        {{__('Author blog')}} - {{$author->name}}
                    </a>
                </span>
                <p class="card-text">
                    {!! $author->description !!}
                </p>
                                                
            </div>
        </div>
    </div>
</div>