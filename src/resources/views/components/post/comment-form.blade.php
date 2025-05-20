@props([
    'id',
    'slug',
])
<div class="comments">


    <div class="comment-block">
        <span class="comment-block__title py-2">{{__('Add comment')}}</span>
                    
        <form class="form" method="POST" action="{{route('blog.comment-send',['id'=>$id])}}">
            @csrf
            <div class="comment-block__inputs mt-4">
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <input type="text" class="form-control" placeholder="{{__('firstName_title')}}" name="name" id="name" value="{{auth()->check() ? auth()->user()->first_name : '' }}" data-require="true" data-max="256">
                    </div>
                    <div class="col-md-6">
                        <input type="tel" class="form-control" placeholder="{{__('Phone_title')}}" name="phone" id="phone"  value="{{auth()->check() ? auth()->user()->phone : '' }}" data-require="true" data-min="16">
                    </div>
                    <div class="col-md-12 mt-3">
                        <input type="email" class="form-control" placeholder="{{__('Email')}}" name="email" id="email"  value="{{auth()->check() ? auth()->user()->email : '' }}" data-require="true" data-max="256">
                    </div>
                </div>
                            
                <div class="mb-3">
                    <textarea class="form-control" placeholder="{{__('Comment')}}" name="comment"></textarea>
                </div>
            </div>            
            <input type="text" class="form-control" name="slug" value="{{$slug}}" hidden>                    
                        
            <div class="comment-block__button">
                <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
            </div>
        </form>
    </div>

</div>
