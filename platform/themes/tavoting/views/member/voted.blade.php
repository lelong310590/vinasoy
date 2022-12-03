<div class="dashboard-wrapper">
    <div class="container">
        <div class="dashboard-content">
            <div class="row">
                @include(Theme::getThemeNamespace() . '::views/member/sidebar')

                <div class="col-12 col-md-8">
                    <div class="dashboard-right">
                        <div class="dashboard-right-title text-green">
                            <p>Bài thi đã bình chọn</p>
                            <h4>{{$challengeCategory->name}}</h4>
                        </div>
                        <div class="dashboard-right-content">
                            @if ($post->count() == 0)
                                <div class="empty w-100">
                                    <img src="{{Theme::asset()->url('images/empty.png')}}" alt="" class="img-fluid mx-auto">
                                    <p class="mt-20 text-center">Bạn chưa tham gia bình chọn bài thi nào.</p>
                                </div>
                            @else
                                <div class="list-wrapper w-100 {{$challengeCategory->slug == 'chuyen-bay-gio-moi-ke' ? 'news-item-small' : ''}}">
                                    <div class="row">
                                        @if ($challengeCategory->slug == 'chuyen-bay-gio-moi-ke')
                                            @foreach($post as $news)
                                                <div class="col-12 col-md-4">
                                                    <div class="news-item">
                                                        <div class="news-thumbnail">
                                                            <a href="{{$news->url}}">
                                                                <img src="{{ RvMedia::getImageUrl($news->image, 'square', false, RvMedia::getDefaultImage()) }}" alt="{{$news->name}}" class="img-fluid">
                                                            </a>
                                                        </div>
                                                        <div class="news-meta text-center">
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
                                        @else
                                            @foreach($post as $news)
                                                <div class="col-12 col-md-6">
                                                    <div class="news-item">
                                                        <div class="news-thumbnail">
                                                            <a href="{{$news->url}}">
                                                                <img src="{{ RvMedia::getImageUrl($news->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{$news->name}}" class="img-fluid">
                                                            </a>
                                                        </div>
                                                        <div class="news-meta">
                                                            <div class="video-meta video-meta-small">
                                                                <div class="video-meta-name">
                                                                    <p class="text-green dancing">{{$news->name}}</p>
                                                                </div>
                                                                <div class="video-meta-wrapper">
                                                                    <div class="video-meta-team">
                                                                        @php
                                                                            $memberList = $news->member_id;
                                                                            $memberArray = explode(',', $memberList);
                                                                            $members = app(\Botble\Member\Repositories\Interfaces\MemberInterface::class)
                                                                                ->getModel()
                                                                                ->whereIn('hrm', $memberArray)
                                                                                ->get();
                                                                            $leader = $members->first();
                                                                        @endphp
                                                                        <p><b>Đội tham gia:</b> <span class="text-green">{{$news->team_member_name}}</span></p>
                                                                        <p><b>Trưởng nhóm:</b> <span class="text-green">{{$leader->first_name}}</span></p>
                                                                        <p><b>Thành viên:</b> <span class="text-green">{{count($memberArray)}} thành viên</span></p>
                                                                    </div>
                                                                    <div class="video-meta-action d-flex align-items-center">
                                                                        <div class="video-meta-like-count">
                                                                            <i class="fa-solid fa-heart"></i> {{number_format($news->vote)}}
                                                                        </div>
                                                                        <a href="{{$news->url}}">Xem bài thi</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="pagination-wrapper text-center">
                                        {{$post->withQueryString()->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
