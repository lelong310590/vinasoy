<div class="video-category-page-wrapper">
    <div class="container">
        <div class="video-category-main-title">
            <h1 class="text-center">{{$category->name}}</h1>
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
            <div class="video-category-pagination text-center">
                {{$videos->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
</div>
