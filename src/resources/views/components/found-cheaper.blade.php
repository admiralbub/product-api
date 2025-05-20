@props([
    'product',
])
<div class="modal fade" id="FoundProduct" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="modal-title fs-4" id="exampleModalLabel">{{__('FOUND CHEAPER')}}</strong>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" method="POST" action="{{route('product.foundCheaper',['slug'=>$product->slug])}}">
                @csrf
                <div class="modal-body">
                    <p>
                        @foreach(__('Found product title') as $text)
                            {!! $text !!}
                        @endforeach
                    </p>
                    <div class="form-group mb-2">
                        <label for="exampleInput">{{__('firstName_title')}}</label>
                        <input type="text" class="form-control" name="name" data-require="true" value="{{auth()->check() ? auth()->user()->first_name : '' }}">
                        <div class="error_valid" id="errorname"></div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="exampleInput">{{__('Phone_title')}}</label>
                        <input type="tel" class="form-control tel" name="phone" data-require="true"  data-min="16" placeholder="+38 (999) 999 99-99" value="{{auth()->check() ? auth()->user()->phone : '' }}">
                        <div class="error_valid" id="errorphone"></div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="exampleInput">{{__('Url found product')}}</label>
                        <input type="text" class="form-control" id="url" name="url" data-require="true">
                        <div class="error_valid" id="errorurl"></div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="exampleInput">{{__('Comment')}}</label>
                        <textarea class="form-control" rows="3" name="comment"></textarea>
                    </div>
                    <input type="hidden" id="id" name="product_id" value="{{$product->id}}">
                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary">{{__('Send')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>