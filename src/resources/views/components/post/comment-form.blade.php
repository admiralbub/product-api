@props([
    'id',
    'slug',
])
<div class="col-md-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <span class="mb-0 fs-3 fw-semibold">{{__('Add comment')}}</span>
        </div>
        <div class="card-body">
            <form class="form" method="POST" action="{{route('blog.comment-send',['id'=>$id])}}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{__('firstName_title')}} *</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{auth()->check() ? auth()->user()->first_name : '' }}" data-require="true" data-max="256">
                </div>
                                
                <div class="mb-3">
                    <label for="phone" class="form-label">{{__('Phone_title')}} *</label>
                    <input type="tel" class="form-control tel"  name="phone" id="phone"  value="{{auth()->check() ? auth()->user()->phone : '' }}" data-require="true" data-min="16">
                </div>
                                
                <div class="mb-3">
                    <label for="email" class="form-label">{{__('Email')}} *</label>
                    <input type="email" class="form-control" name="email" id="email"  value="{{auth()->check() ? auth()->user()->email : '' }}" data-require="true" data-max="256">
                </div>
                                
                <div class="mb-3">
                    <label for="comment" class="form-label">{{__('Comment')}} *</label>
                    <textarea class="form-control" id="comment" rows="4" name="comment"></textarea>
                </div>
                <input type="text" class="form-control" name="slug" value="{{$slug}}" hidden>                   
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
