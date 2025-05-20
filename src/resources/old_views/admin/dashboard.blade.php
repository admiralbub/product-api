<div class="container-fluid py-5">
    <div class="row g-4 cards">
        <!-- Плитка 1 -->
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <h5 class="card-heading">{{__('Order')}}</h5>
                <div class="card-body">
                    <i class="bi bi-cart"></i>
                    <h2 class="pull-right">{{$count_order}}</h2>

                </div>
            </div>

            
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <h5 class="card-heading">{{__('Purchased')}}</h5>
                <div class="card-body">
                    <i class="bi bi-currency-dollar"></i>
                    <h2 class="pull-right">{{$pay_count}}</h2>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <h5 class="card-heading">{{__('Product')}}</h5>
                <div class="card-body">
                    <i class="bi bi-shop"></i>
                    <h2 class="pull-right">{{$product_count}}</h2>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <h5 class="card-heading">{{__('Users')}}</h5>
                <div class="card-body">
                    <i class="bi bi-person-fill"></i>
                    <h2 class="pull-right">{{$user_count}}</h2>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <h5 class="card-heading">{{__('Brand')}}</h5>
                <div class="card-body">
                    <i class="bi bi-boxes"></i>
                    <h2 class="pull-right">{{$brand_count}}</h2>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <h5 class="card-heading">{{__('Article')}}</h5>
                <div class="card-body">
                    <i class="bi bi-book"></i>
                    <h2 class="pull-right">{{$blog_count}}</h2>

                </div>
            </div>
        </div>
        
    </div>
</div>