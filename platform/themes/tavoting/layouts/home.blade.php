{!! Theme::partial('header') !!}

<main class="main" id="main">
    <section class="hero-image d-flex justify-content-center">
        <img src="{{Theme::asset()->url('images/hero.png')}}" alt="" class="img-fluid">
    </section>

    <div class="group-bg">
        <section class="flashback">
            <div class="container">
                <div class="flashback-wrapper d-flex">
                    <div class="col-12 col-md-6">
                        <div class="flashback-text">
                            <h4 class="text-green dancing">Cùng hồi tưởng về hành trình...</h4>
                            <p>Mang ý nghĩa gắn kết và mong muốn lan tỏa những điều ấn tượng về hành trình <span class="text-green">25 năm vững bước của Vinasoy</span>, hy vọng nơi đây sẽ là “ngôi nhà chung” để các thành viên được tiếp thêm cảm hứng và hun đúc tinh thần nhiệt huyết mỗi ngày. Hãy thỏa sức khám phá & tận hưởng những trải nghiệm thú vị nhé!</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="logo-decor d-flex justify-content-center">
                            <img src="{{Theme::asset()->url('images/logo-deco.png')}}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @php
            $homeNews = app(\Botble\Blog\Repositories\Interfaces\PostInterface::class)
                        ->getModel()
                        ->where('status', 'published')
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->get();
        @endphp

        <section class="home-news">
            <div class="container">
                <div class="home-news-title text-center">
                    <h4 class="text-green dancing">Sự kiện & tin tức</h4>
                    <p>Hành trình Vinasoy 25 năm - Nâng tầm dinh dưỡng vàng từ thực vật</p>
                    <a href="" class="text-orange">Xem tất cả</a>
                </div>

                <div class="carousel-wrapper">
                    <div class="home-new-carousel owl-carousel owl-theme">
                        @foreach($homeNews as $news)
                            <div class="item">
                                <div class="news-item">
                                    <div class="news-thumbnail">
                                        <a href="{{$news->url}}">
                                            <img src="{{ RvMedia::getImageUrl($news->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{$news->name}}" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="news-meta">
                                        <h4 class="news-title text-uppercase text-green">{{$news->name}}</h4>
                                        <div class="news-expert">
                                            {{$news->description}}
                                        </div>
                                        <div class="text-center news-more">
                                            <a href="{{$news->url}}" class="read-more">Đọc thêm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="carousel-navigation">
                        <a href="javascript:;" class="news-carousel-navigation carousel-left"><i class="fa-solid fa-circle-arrow-left"></i></a>
                        <a href="javascript:;" class="news-carousel-navigation carousel-right"><i class="fa-solid fa-circle-arrow-right"></i></a>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <div class="section-exe">
        <div class="container">
            <div class="exe-title">
                <h4 class="text-center text-green dancing">Vinasoy-Chuyện bây giờ mới kể</h4>
                <p class="text-center">Bạn biết không? Chẳng điều gì kết nối cảm xúc mạnh mẽ bằng những câu chuyện. Và đặc biệt hơn khi đó là những câu chuyện của riêng mỗi người...</p>
            </div>
        </div>

        <div class="exe-content">

            @php
                $hightLightExe = app(\Botble\VideoVoting\Repositories\Interfaces\VideoInterface::class)
                            ->getModel()
                            ->whereHas('categories', function ($query) {
                                $query->where('vv_video_categories.id', 1);
                             })
                            ->where('is_featured', true)
                            ->where('status', 'published')
                            ->orderBy('created_at', 'desc')
                            ->first();


                $query = app(\Botble\VideoVoting\Repositories\Interfaces\VideoInterface::class)
                            ->getModel()
                            ->whereHas('categories', function ($query) {
                                $query->where('vv_video_categories.id', 1);
                             })
                            ->where('status', 'published');

                if ($hightLightExe == null) {
                    $exes = $query->orderBy('created_at', 'desc')
                            ->limit(10)
                            ->get();
                } else {
                    $exes = $query->where('id', '!=', $hightLightExe->id)
                            ->orderBy('created_at', 'desc')
                            ->limit(10)
                            ->get();
                }

            @endphp

            <div class="exe-hightlight">
                <div class="exe-hightlight-wrapper">
                    <div class="container">
                        <div class="exe-hightlight-wrapper-inner">
                            <div class="exe-image">
                                <img src="{{ RvMedia::getImageUrl($hightLightExe->image, 'full', false, RvMedia::getDefaultImage()) }}" alt="" class="img-fluid">
                            </div>
                            <div class="ext-content">
                                <h4 class="text-orange text-uppercase">{{$hightLightExe->name}}</h4>
                                <div class="exe-detail">
                                    {!! clean($hightLightExe->content) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="exe-carousel-wrapper carousel-wrapper">
                    <div class="exe-carousel owl-carousel owl-theme">
                        @foreach($exes as $news)
                            <div class="item">
                                <div class="news-item">
                                    <div class="news-thumbnail">
                                        <a href="{{$news->url}}">
                                            <img src="{{ RvMedia::getImageUrl($news->image, 'square', false, RvMedia::getDefaultImage()) }}" alt="{{$news->name}}" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="news-meta">
                                        <h4 class="news-title text-uppercase text-green">{{$news->name}}</h4>
                                        <div class="news-expert">
                                            {{$news->description}}
                                        </div>
                                        <div class="text-center news-more">
                                            <a href="{{$news->url}}" class="read-more">Đọc thêm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="carousel-navigation">
                        <a href="javascript:;" class="news-carousel-navigation carousel-left"><i class="fa-solid fa-circle-arrow-left"></i></a>
                        <a href="javascript:;" class="news-carousel-navigation carousel-right"><i class="fa-solid fa-circle-arrow-right"></i></a>
                    </div>

                    <div class="exe-more text-center">
                        <a href="/chuyen-chua-ke" class="read-more">Khám phá thêm các câu chuyện khác</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-proud">
        <div class="container">
            <div class="proud-title">
                <h4 class="text-center text-green dancing">Tự hào 25 năm</h4>
                <p class="text-center">Hấp dẫn – Sôi động - Ấn tượng, “Vinasoy – Tự hào 25 năm” hứa hẹn mang đến một thử thách đầy thú vị, nơi tôn vinh tinh thần đồng đội, nơi các thành viên được<br/> thỏa sức thể hiện chất riêng </p>
            </div>

            @php
                $news = app(\Botble\VideoVoting\Repositories\Interfaces\VideoInterface::class)
                    ->getModel()
                    ->whereHas('categories', function ($query) {
                        $query->where('vv_video_categories.id', 2);
                     })
                    ->where('is_featured', true)
                    ->where('status', 'published')
                    ->orderBy('created_at', 'desc')
                    ->first();

                    $listVoted = [];

                    if (auth()->guard('member')->check()) {
                        $listVoted = auth()->guard('member')->user()->videoVoted()->get()->pluck('id')->toArray();
                    }
            @endphp

            @if ($news != null)
            <div class="proud-video">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="news-item hightlight-item">
                        <div class="news-thumbnail">
                            <a href="{{$news->url}}">
                                <img src="{{ RvMedia::getImageUrl($news->image, 'full', false, RvMedia::getDefaultImage()) }}" alt="{{$news->name}}" class="img-fluid">
                            </a>
                        </div>
                        <div class="news-meta">
                            <div class="video-meta">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="video-meta-wrapper d-flex justify-content-between align-items-center">
                                            <div class="video-meta-team">
                                                @php
                                                    $memberList = $news->member_id;
                                                    $memberArray = explode(',', $memberList);
                                                    $members = app(\Botble\Member\Repositories\Interfaces\MemberInterface::class)
                                                        ->getModel()
                                                        ->whereIn('id', $memberArray)
                                                        ->get();
                                                    $leader = app(\Botble\Member\Repositories\Interfaces\MemberInterface::class)
                                                        ->getModel()
                                                        ->whereIn('id', $memberArray)
                                                        ->first();
                                                @endphp
                                                <p><b>Đội tham gia:</b> <span class="text-green">{{$news->team_member_name}}</span></p>
                                                <p><b>Trưởng nhóm:</b> <span class="text-green">{{$leader->first_name}}</span></p>
                                                <p><b>Thành viên:</b> <span class="text-green">{{count($memberArray)}} thành viên</span></p>
                                            </div>
                                            <div class="video-meta-action d-flex align-items-center">
                                                <a href="{{$news->url}}">Xem bài thi</a>
                                                @if (!in_array($news->id, $listVoted))
                                                    <a href="javascript:;" class="main-button sa-voting" data-video-id="{{$news->id}}">Bình chọn</a>
                                                @else
                                                    <a href="javascript:;" class="main-button outline-button sa-devoting" data-video-id="{{$news->id}}">Bỏ bình chọn</a>
                                                @endif
                                                <div class="video-meta-like-count">
                                                    <i class="fa-solid fa-heart"></i> {{number_format($news->vote)}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="proud-more text-center">
                <a href="/tu-hao-25-nam" class="read-more">Khám phá thêm các hình ảnh, video khác</a>
            </div>
        </div>
    </div>

</main>

{!! Theme::partial('footer') !!}
