@props([
    'blog',
])
<div class="blog col-md-3">
    <div class="card mb-4">
        <div class="card-body">
            <div>
                <img src="{{asset($blog->img)}}" alt="" class="blog-img"/>
            </div>
            
            <div class="pt-3">
                <a href="{{route('blog.index',['slug'=>$blog->slug])}}" class="blog-title py-3">
                    {{$blog->name}}
                </a>
            </div>
           
                                        
        </div>
        <div class="card-footer text-muted d-flex justify-content-between">
            <div>
                <i class="bi bi-clock"></i>
                {{$blog->created_at->format('d.m.Y H:i')}}
            </div>
            <div>
                <i class="bi bi-chat"></i>
                ({{$blog->comment->count()}})
            </div>
        

        </div>
    </div>
</div>