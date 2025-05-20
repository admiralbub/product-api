@props([
    'author',
])


<div class="author-block">
    <div class="author-block__image">
        <img src="{{asset($author->img)}}" alt="Kevin Martin">
    </div>
    <div class="author-block__info">
        <h4 class="author-block__name">{{__('Author blog')}} - {{$author->name}}</h4>
        <div class="author-block__text mt-2">
            {!! $author->description !!}
        </div>
    </div>
 </div>