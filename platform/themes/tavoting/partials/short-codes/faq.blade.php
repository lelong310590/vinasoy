@foreach($categories as $category)
    <div class="faq-wrapper__list d-flex justify-content-between align-items-start flex-wrap">
        @foreach($category->faqs as $faq)
            <div class="faq-item">
                <div class="faq-item__title d-flex justify-content-between align-items-center">
                    <p>{{ $faq->question }}</p>
                    <div class="faq-item__toggle">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
                <div class="faq-item__content">
                    {!! clean($faq->answer) !!}
                </div>
            </div>
        @endforeach
    </div>
@endforeach
