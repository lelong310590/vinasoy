{!! Theme::partial('header') !!}

<div class="news-wrapper">
    <div class="container">
        <div class="news-top-wrapper">
            @php
                $newest = app(\Botble\Blog\Repositories\Interfaces\PostInterface::class)
                    ->getModel()
                    ->where('status', 'published')
                    ->orderBy('created_at', 'desc')
                    ->limit(4)
                    ->get();
            @endphp

            <div class="news-top-title d-flex justify-content-between align-items-center">
                <h1 class="site-title reverse text-uppercase">Newest</h1>
                <a href="/about" class="button-more">
                    <div class="circle d-none d-md-block"></div>
                    <img src="{{Theme::asset()->url('images/ring.png')}}" alt="" class="img-fluid d-md-none d-block"> <span>See more</span>
                </a>
            </div>

            @if ($newest->count() > 0)
            <div class="grid-container">
                @foreach($newest as $news)
                    <div class="grid-item">
                        <a class="newest-item" href="{{$news->url}}" style="background-image: url('{{ RvMedia::getImageUrl($news->image, 'medium', false, RvMedia::getDefaultImage()) }}')">
                            <div class="newest-title">
                                {{$news->name}}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @endif
        </div>

        @php
            $lastestNews = app(\Botble\Blog\Repositories\Interfaces\PostInterface::class)
                ->getModel()
                ->where('status', 'published')
                ->orderBy('created_at', 'desc')
                ->skip(4)
                ->limit(9)
                ->get();
        @endphp

        @if ($lastestNews->count() > 0)
        <div class="news-bottom-wrapper">
            <div class="news-top-title d-flex justify-content-between align-items-center">
                <h2 class="site-title reverse text-uppercase">LAST NEWS</h2>
                <a href="/about" class="button-more">
                    <div class="circle d-none d-md-block"></div>
                    <img src="{{Theme::asset()->url('images/ring.png')}}" alt="" class="img-fluid d-md-none d-block"> <span>See more</span>
                </a>
            </div>

            <div class="news-carousel-navigation">
                <a href="javascript:;" class="carousel-left"><i class="fa fa-chevron-left"></i></a>
                <a href="javascript:;" class="carousel-right"><i class="fa fa-chevron-right"></i></a>
            </div>
            <div class="news-carousel owl-carousel owl-theme">
                @foreach($lastestNews as $news)
                <div class="item">
                    <div class="news-carousel-item">
                        <a class="news-carousel-thumbnail" href="{{$news->url}}" style="background-image: url('{{ RvMedia::getImageUrl($news->image, 'medium', false, RvMedia::getDefaultImage()) }}')"></a>
                        <div class="news-carousel-extra">
                            <h4 class="news-carousel-title">
                                <a href="{{$news->url}}">{{$news->name}}</a>
                            </h4>
                            <div class="news-carousel-excerpt">
                                {{$news->description}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

{!! Theme::partial('footer') !!}
