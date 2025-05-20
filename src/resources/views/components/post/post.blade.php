@props([
    'blog',
])


<div class="col-md-4">
    <div class="card h-100">
        <div class="position-relative">
            <div class="card-img">
                <a href="{{route('blog.index',['slug'=>$blog->slug])}}">
                    <img src="{{asset($blog->img)}}" class="card-img-top"  />
                </a>
                
            </div>
            <span class="date-badge">{{$blog->created_at->format('d.m.Y')}}</span>
        </div>
        <div class="card-body text-center">
            <div class="meta mb-2 text-muted small">
                <a href="{{route('blogs.author',['id'=>$blog->author->id])}}">
                    <i class="bi bi-person-fill me-1"></i>
                    {{$blog->author->name}}
                </a>
                
                <span class="ms-3"><i class="bi bi-chat-dots-fill me-1"></i>{{$blog->comment->count()}}</span>
            </div>
            <h5 class="card-title fw-bold">
                <a href="{{route('blog.index',['slug'=>$blog->slug])}}" class="blog-title py-3">
                    {{$blog->name}}
                </a>
            </h5>
        </div>
    </div>
</div>