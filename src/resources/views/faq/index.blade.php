<x-layouts.app  
    :title="__('Faq')"
    :descriptions="__('Faq')"
    :keywords="''"
    no_index=0>

    <x-block.hero :h1="__('Faq')" :breadcrumbs="$breadcrumbs"></x-x-block.hero>
    <div class="container">
        <div class="mt-3 mb-5">
            <div class="accordion accordion-flush mt-4" id="accordionFlushExample">
                @foreach($faqs as $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading{{$faq->id}}">
                            <button class="accordion-button collapsed text-uppercase" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse{{$faq->id}}"
                                aria-expanded="false"
                                aria-controls="flush-collapse{{$faq->id}}">
                                <strong>{{$faq->question}}</strong>
                            </button>
                        </h2>
                        <div id="flush-collapse{{$faq->id}}" class="accordion-collapse collapse"
                            aria-labelledby="flush-heading{{$faq->id}}"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">{!!$faq->answer!!}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>