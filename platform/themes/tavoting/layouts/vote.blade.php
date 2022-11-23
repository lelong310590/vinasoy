{!! Theme::partial('header') !!}

<div class="submit-body">
    <section class="section-submit-hero" style="background-image: url({{Theme::asset()->url('images/submit-hero.png')}})">
        <div class="container">
            <div class="section-hero-content">
                <h1 class="site-title text-uppercase">
                    V<span>O</span>te For <br/>Your Winners!
                </h1>
            </div>
        </div>
    </section>

    <section class="vote-how" id="vote-how">
        <div class="container">
            <div class="vote-how-wrapper">
                <h2 class="site-title reverse text-uppercase">
                    How to <br/>V<span>O</span>te Online
                </h2>
                <div class="vote-how-inner d-flex justify-content-between align-items-center">
                    <div class="vote-how-text">
                        <div class="vote-how-item d-flex">
                            <div class="vote-how-icon">
                                <img src="{{Theme::asset()->url('images/how01.png')}}" alt="" class="img-fluid">
                            </div>
                            <div class="vote-how-content">
                                <h4 class="text-uppercase">Get ready to vote</h4>
                                <p>In order to vote, you need to <a href="{{route('public.member.login')}}">sign in</a> using either your Facebook or Gmail account. </p>
                            </div>
                        </div>
                        <div class="vote-how-item d-flex">
                            <div class="vote-how-icon">
                                <img src="{{Theme::asset()->url('images/how02.png')}}" alt="" class="img-fluid">
                            </div>
                            <div class="vote-how-content">
                                <h4 class="text-uppercase">Vote for your favourite<br/>team or individuals</h4>
                                <p>The videos are listed in alphabetical order of the contestant's name. Select the video you wish to vote and cast your vote by clicking the "VOTE NOW" button.  </p>
                            </div>
                        </div>
                    </div>
                    <div class="vote-how-image">
                        <img src="{{Theme::asset()->url('images/how-image.png')}}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="list-video">
        <div class="container">
            <div class="list-video-toolbar">
                <h2 class="site-title reverse text-uppercase">
                    V<span>O</span>TE NOW!
                </h2>
                <div class="list-video-search">
                    <form action="{{route('public.video.search')}}" method="get" role="form">
                        <div class="form-group">
                            <input type="text" class="form-control" name="keywords" id="" placeholder="Keyword...">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            @php
                $categories = app(\Botble\VideoVoting\Repositories\Interfaces\VideoCategoryInterface::class)->getCategories(['*'], [
                    'order'      => 'ASC',
                ]);

                $listVoted = [];

                if (auth()->guard('member')->check()) {
                    $listVoted = auth()->guard('member')->user()->videoVoted()->get()->pluck('id')->toArray();
                }
            @endphp
            <div class="video-category">
                @foreach($categories as $category)
                    <div class="video-category-wrapper">
                        <div class="video-category-title d-flex justify-content-between align-items-center">
                            <h4 class="text-uppercase">{{$category->name}} </h4>
                            <div class="video-category-toggle"><i class="fa fa-chevron-down"></i></div>
                        </div>

                        @php
                            $videos = app(\Botble\VideoVoting\Repositories\Interfaces\VideoInterface::class)->getModel()
                                ->whereHas('categories', function($query) use ($category) {
                                    $query->where('vv_video_categories.id', $category->id);
                                })
                                ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED())
                                ->orderBy('created_at', 'desc')
                                ->limit(6)
                                ->get();
                        @endphp

                        <div class="video-category-list">
                            <div class="row align-items-stretch">
                                @foreach($videos as $video)
                                    <div class="col-12 col-md-4">
                                        <div class="video-item">
                                            <div class="video-item-info-detail">
                                                <a href="{{$video->url}}">

                                                    @if (auth()->guard('member')->check())
                                                        @if (in_array($video->id, $listVoted))
                                                            <div class="video-voted-tag">
                                                                You have voted this video!
                                                            </div>
                                                        @endif
                                                    @endif

                                                    <img src="{{ RvMedia::getImageUrl($video->image, 'medium', false, RvMedia::getDefaultImage()) }}" data-video-link="{{$video->youtube_link}}" alt="{{ $video->name }}" class="img-fluid video-thumbnail">
                                                </a>
                                                <div class="video-info">
                                                    <p><span>Name</span>: {{$video->name}}</p>
                                                    <p><span>Age Group</span>: {{$video->age_group}}</p>
                                                    <p><span>Topic</span>: {{$video->video_topic}}</p>
                                                    <div class="video-total-vote">
                                                        Total Vote: {{number_format($video->vote_fake + $video->vote)}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="video-action d-flex justify-content-between align-items-center">
                                                <div class="video-link">
                                                    <a data-fancybox href="{{$video->youtube_link}}">
                                                        Youtube Link <i class="fab fa-youtube"></i>
                                                    </a>
                                                </div>
                                                @if (!in_array($video->id, $listVoted))
                                                    <div class="video-action-button">
                                                        <a href="javascript:;" class="main-button sa-voting" data-video-id="{{$video->id}}">Vote now</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="video-category-more text-center">
                                <a href="{{route('public.video-category', $category->slug)}}" class="main-button">View more</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-submit-content">
        <div class="container">
            <h2 class="site-title reverse text-uppercase text-right">Terms & C<span>O</span>nditions</h2>
            <div class="submit-content">
                <div class="submit-content-row d-flex justify-content-between align-items-start">
                    <div class="submit-content-item d-flex justify-content-start align-items-start">
                        <div class="submit-content-item-no">1</div>
                        <div class="submit-content-item-text">
                            <b>Top 300 individuals</b> will deliver their speech on a different topic (for Storytelling & Speech) or compete in a <b>debate tournament of 4 rounds</b>. A panel of experts will determine the <b>Top 66 Individuals</b>.
                        </div>
                    </div>
                    <div class="submit-content-item d-flex justify-content-start align-items-start">
                        <div class="submit-content-item-no">2</div>
                        <div class="submit-content-item-text">
                            The number of times you can vote will not be restricted. You <b>can vote for multiple contestants.</b>
                        </div>
                    </div>
                </div>
                <div class="submit-content-row d-flex justify-content-between align-items-start">
                    <div class="submit-content-item d-flex justify-content-start align-items-start">
                        <div class="submit-content-item-no">3</div>
                        <div class="submit-content-item-text">
                            The voting result will be used in combination with evaluation from the panel of experts to determine the <b>Top 100 individuals/team</b> that will advance to <b>Round 2</b>. <b>The final result</b> will be announced on <b>February 28th</b>.
                        </div>
                    </div>
                    <div class="submit-content-item d-flex justify-content-start align-items-start">
                        <div class="submit-content-item-no">4</div>
                        <div class="submit-content-item-text">
                            The organizing team reserves the right to disqualify entries or suspend voting if it has reasonable grounds to suspect that fraudulent voting has occurred or if it considers there has been any attempt to rig the voting.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{!! Theme::partial('footer') !!}
