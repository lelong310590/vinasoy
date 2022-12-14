@php
    $memberList = $video->member_id;
    $memberArray = explode(',', $memberList);
    $members = app(\Botble\Member\Repositories\Interfaces\MemberInterface::class)
        ->getModel()
        ->whereIn('id', $memberArray)
        ->get();

    $listVoted = [];

    if (auth()->guard('member')->check()) {
        $listVoted = auth()->guard('member')->user()->videoVoted()->get()->pluck('id')->toArray();
    }
@endphp
<div class="exe-detail-wrapper video-pround-wrapper">
    <div class="container">
        <div class="exe-hightlight">
            <div class="exe-hightlight-wrapper">
                <div class="container">

                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="video-detail-wrapper">
                            <div class="video-state-name text-center">
                                <p><b class="text-uppercase">Thi sáng tạo ảnh & clip nhóm</b></p>
                                <h1 class="text-green dancing">{{$video->name}}</h1>
                            </div>

                            <div class="video-detail-intro">
                                <div class="video-meta-wrapper d-md-flex justify-content-between align-items-center">
                                    <div class="video-meta-team">
                                        @php
                                            $memberList = $video->member_id;
                                            $memberArray = explode(',', $memberList);
                                            $members = app(\Botble\Member\Repositories\Interfaces\MemberInterface::class)
                                                ->getModel()
                                                ->whereIn('hrm', $memberArray)
                                                ->get();
                                            $leader = $members->first();
                                        @endphp
                                        <p><b>Đội tham gia:</b> <span class="text-green">{{$video->team_member_name}}</span></p>
                                        <p><b>Trưởng nhóm:</b> <span class="text-green">{{$leader != null ? $leader->first_name : ''}}</span></p>
                                        <p class="list-member">
                                            <b>Thành viên:</b> <span class="text-green">{{count($memberArray)}} thành viên</span>
                                            <a href="javascript:;" id="view-member-list">Xem danh sách</a>
                                        </p>
                                    </div>
                                    <div class="video-meta-action d-flex align-items-center justify-content-center flex-column">
                                        <div class="video-meta-like-count">
                                            <i class="fa-solid fa-heart"></i> {{number_format($video->vote)}}
                                        </div>
                                        @if (!in_array($video->id, $listVoted))
                                            <a href="javascript:;" class="main-button sa-voting" data-video-id="{{$video->id}}">Bình chọn</a>
                                        @else
                                            <a href="javascript:;" class="main-button outline-button sa-devoting" data-video-id="{{$video->id}}">Bỏ bình chọn</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="member-list">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Họ và tên</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $member)
                                        <tr>
                                            <td>{{$member->first_name}} {{$loop->index == 0 ? '⭐' : ''}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="video-detail-carousel-wrapper carousel-wrapper">
                            <div class="video-detail-carousel owl-carousel owl-theme">
                                @foreach (gallery_meta_data($video) as $image)
                                    @if ($image)
                                        <div class="item">
                                            <img src="{{ RvMedia::getImageUrl(Arr::get($image, 'img'), 'full', false, RvMedia::getDefaultImage()) }}" alt="{{ clean(Arr::get($image, 'description')) }}" class="img-fluid">
                                        </div>
                                    @endif
                                @endforeach

                                @if ($video->video_link != null)
                                    <div class="item">
                                        <a data-fancybox href="#myVideo" class="exe-has-video">
                                            <i class="fa-solid fa-play"></i>
                                            <img src="{{ RvMedia::getImageUrl($video->image, 'full', false, RvMedia::getDefaultImage()) }}" alt="" class="img-fluid">
                                        </a>

                                        <video width="640" height="320" controls id="myVideo" style="display:none;">
                                            <source src="{{env('APP_URL').'/storage/'.$video->video_link}}" type="video/mp4">
                                            Your browser doesn't support HTML5 video tag.
                                        </video>
                                    </div>
                                @endif

                                @if ($video->youtube_link != null)
                                    <div class="item">
                                        <a data-fancybox class="exe-has-video" href="{{getVideoEmbedLink($video->youtube_link)}}">
                                            <i class="fa-solid fa-play"></i>
                                            <img src="{{ RvMedia::getImageUrl($video->image, 'full', false, RvMedia::getDefaultImage()) }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="carousel-navigation d-none d-md-flex">
                                <a href="javascript:;" class="news-carousel-navigation carousel-left"><i class="fa-solid fa-circle-arrow-left"></i></a>
                                <a href="javascript:;" class="news-carousel-navigation carousel-right"><i class="fa-solid fa-circle-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="video-detail-content-description d-flex">
                            <div class="exe-detail">
                                <h4 class="text-green">Mô tả bài thi</h4>
                                {!! clean($video->content) !!}
                            </div>
                            <div class="exe-sharing d-flex align-items-end flex-column text-center">
                                <div class="exe-share-social w-100">
                                    <p>Chia sẻ</p>
                                    <div class="exe-share-link d-flex justify-content-between w-100">
                                        <a href="javascript:;" onclick="copyUrl()"><i class="fa-solid fa-share-nodes"></i></a>

                                        <script type="text/javascript">
                                            function copyUrl() {
                                                if (navigator.clipboard && window.isSecureContext) {
                                                    // navigator clipboard api method'
                                                    navigator.clipboard.writeText('{{Request::url()}}');
                                                } else {
                                                    // text area method
                                                    let textArea = document.createElement("textarea");
                                                    textArea.value = '{{Request::url()}}';
                                                    // make the textarea out of viewport
                                                    textArea.style.position = "fixed";
                                                    textArea.style.left = "-999999px";
                                                    textArea.style.top = "-999999px";
                                                    document.body.appendChild(textArea);
                                                    textArea.focus();
                                                    textArea.select();
                                                    return new Promise((res, rej) => {
                                                        // here the magic happens
                                                        document.execCommand('copy') ? res() : rej();
                                                        textArea.remove();
                                                    });
                                                }
                                            }
                                        </script>

                                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}"><i class="fa-brands fa-facebook-f"></i></a>
                                    </div>
                                </div>
                                <div class="exe-qr">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{Request::url()}}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="list-story exe-detail-list">
    <div class="container">

        <div class="exe-detail-mega-title text-center">
            <h4 class="dancing text-green">Danh sách bài thi khác.</h4>
        </div>

        <div class="list-story-search d-flex justify-content-center">
            <div class="search-form">
                <form action="{{Request::url()}}" method="get" role="form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nhập tên hoặc mã nhân viên để tìm bài thi dễ hơn" name="k" value="{{Request::get('k')}}">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm</button>
                </form>
            </div>
        </div>

        @php
            $exesQuery = app(\Botble\VideoVoting\Repositories\Interfaces\VideoInterface::class)
                        ->getModel()
                        ->whereHas('categories', function ($query) {
                            $query->where('vv_video_categories.id', 2);
                         });
            if (Request::get('k') != '') {
                $member = app(\Botble\Member\Repositories\Interfaces\MemberInterface::class)
                        ->getModel()
                        ->where('hrm', Request::get('k'))
                        ->orWhere('first_name', 'like', '%'.Request::get('k').'%')
                        ->first();

                if ($member == null) {
                    $exes = [];
                } else {
                    $exes = $exesQuery
                        ->where('member_id', 'like', '%'.$member->hrm.'%')
                        ->where('status', 'published')
                        ->orderBy('created_at', 'desc')
                        ->paginate(16);
                }
            } else {
                $exes = $exesQuery->where('status', 'published')
                        ->orderBy('created_at', 'desc')
                        ->paginate(16);
            }
        @endphp

        <div class="list-wrapper">

            @if (Request::get('k') != '' && $exes != [])
                <div class="empty-search text-center">
                    <p>Tìm thấy <span class="text-green">{{$exes->count()}} kết quả</span> theo từ khóa của bạn.</p>
                </div>
            @endif

            <div class="row">
                @forelse($exes as $news)
                    <div class="col-12 col-md-4">
                        <div class="news-item">
                            <div class="news-thumbnail news-thumbnail-round-2">
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
                                            <p><b>Trưởng nhóm:</b> <span class="text-green">{{$leader != null ? $leader->first_name : ''}}</span></p>
                                            <p><b>Thành viên:</b> <span class="text-green">{{count($memberArray)}} thành viên</span></p>
                                        </div>
                                        <div class="video-meta-action d-flex align-items-center">
                                            <div class="video-meta-like-count">
                                                <i class="fa-solid fa-heart"></i> {{number_format($news->vote)}}
                                            </div>
                                            @if (!in_array($news->id, $listVoted))
                                                <a href="javascript:;" class="main-button sa-voting" data-video-id="{{$news->id}}">Bình chọn</a>
                                            @else
                                                <a href="javascript:;" class="main-button outline-button sa-devoting" data-video-id="{{$news->id}}">Bỏ bình chọn</a>
                                            @endif
                                            <a href="{{$news->url}}">Xem bài thi</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    @if (Request::get('k') != '')
                        <div class="empty-search text-center">
                            <p>Không tìm thấy <span class="text-green">kết quả</span> theo từ khóa của bạn.</p>
                            <img src="{{Theme::asset()->url('images/empty.png')}}" alt="" class="img-fluid mx-auto">
                        </div>
                    @endif
                @endforelse
            </div>

            @if ($exes != [])
                <div class="pagination-wrapper text-center">
                    {{$exes->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
