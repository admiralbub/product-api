<div class="col-md-3">
    <div class="card h-100">
        <div class="position-relative">
            <div class="card-img">
                <a href="{{route('stock.show',['slug'=>$stock->slug])}}">
                    <img src="{{asset($stock->img)}}" class="card-img-top">
                </a>
                
            </div>
            <span class="date-badge">
                <i class="bi bi-clock me-1"></i>
                {{dateBetween($stock->start_stocks_date, $stock->end_stocks_date, $lang)}}
            </span>
        </div>
        <div class="card-body text-center">
           
            <h5 class="card-title fw-bold">
                <a href="{{route('stock.show',['slug'=>$stock->slug])}}" class="blog-title py-3">
                    {{$stock->name}}
                </a>
            </h5>
        </div>
    </div>
</div>
