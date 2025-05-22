

<div class="comments">


    <div class="comment-block">
        <span class="comment-block__title py-2">{{__('Add your review')}}</span>
                    
        <form class="mt-3 form"  method="POST" action="{{route('feedback.post',['id'=>$id])}}">
            @csrf
            <div class="comment-block__inputs mt-4">
                <div class="mb-3">
                    <textarea class="form-control" placeholder="{{__('Feedback')}}" name="comment"></textarea>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <input type="text" class="form-control" placeholder="{{__('firstName_title')}}" name="name" id="name" value="{{auth()->check() ? auth()->user()->first_name : '' }}" data-require="true" data-max="256">
                    </div>
                    
                    <div class="col-md-6 mb-3 mb-md-0">
                        <input type="email" class="form-control" placeholder="{{__('Email')}}" name="email" id="email"  value="{{auth()->check() ? auth()->user()->email : '' }}" data-require="true" data-max="256">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">
                        {{__('Grade')}}:
                        <span class="text-danger">*</span>
                    </label>
                    <div class="rating-review">
                        <input type="radio" id="sr-0-1" name="rating" value="5" />
                        <label for="sr-0-1">★</label>
                        <input type="radio" id="sr-0-2" name="rating" value="4" />
                        <label for="sr-0-2">★</label>
                        <input type="radio" id="sr-0-3" name="rating" value="3" />
                        <label for="sr-0-3">★</label>
                        <input type="radio" id="sr-0-4" name="rating" value="2" />
                        <label for="sr-0-4">★</label>
                        <input type="radio" id="sr-0-5" name="rating" value="1" />
                        <label for="sr-0-5">★</label>
                    </div>
                </div>
                
            </div>            
            <input type="text" class="form-control" name="slug" value="{{$slug}}" hidden>               
                        
            <div class="comment-block__button">
                <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
            </div>
        </form>
    </div>

</div>
