@props([
    'comments',
    'blog',
])

<!-- Левая колонка - список комментариев -->
<div class="col-md-12 col-md-4">
    <span class="mb-3 fs-3 fw-semibold">{{__('All comments')}} ({{$blog->comment->count()}})</span>
    @foreach($comments as $comment)                
        <!-- Пример комментария 1 -->
        <div class="card comment-card mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span class="comment-author">{{$comment->user_name}}</span>
                    <span class="comment-date">{{$comment->created_at->format('d.m.Y')}}</span>
                </div>
                <div class="comment-text">
                    {{$comment->comment}}
                </div>
            </div>
        </div>
    @endforeach
 </div>