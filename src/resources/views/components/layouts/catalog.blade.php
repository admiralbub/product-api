@foreach($categories->sortBy('sort') as $category)
    <li><a class="dropdown-item" href="{{route('product.category',['slug'=>$category->slug])}}">{{$category->name}}</a></li>
@endforeach