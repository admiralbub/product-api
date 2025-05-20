@props([
    'blogMains',
])
@if(count($blogMains))
    <div class="news-section py-5">
        <div class="container">
            <h3 class="fs-1 ">
                {{__('All news')}}
                
            </h3>
            <div class="row g-4">
                @foreach($blogMains as $blogMain)
                    <x-post.post :blog="$blogMain"/>
                @endforeach
            </div>
        </div>
    </div>

@endif