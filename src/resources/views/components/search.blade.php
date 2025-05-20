<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('Search')}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="catalog-search" action="{{route('products.search')}}" method="GET">
                    <div class="catalog-search-box position-relative">
                        <input class="catalog-search-box-input" type="text" name="search" id="search_descktop" value="" data-language="index_search" placeholder="{{__('Search')}}..." autocomplete="off">
                        <button class="catalog-search-box-btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                        <div class="search_block d-none"></div>
                    </div>
                </form>

            </div>
           
        </div>
    </div>
</div>