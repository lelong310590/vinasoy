{!! Theme::partial('header') !!}

<section class="proud-page">
    <img src="{{Theme::asset()->url('images/hero-proud.png')}}" alt="" class="img-fluid">
    <div class="proud-hero-content">
        <div class="container">
            <div class="story-hero-detail-wrapper d-flex justify-content-center">
                <div class="story-hero-detail proud-hero-detail text-center">
                    Hấp dẫn – Sôi động - Ấn tượng, <span class="text-green">“Vinasoy – Tự hào 25 năm”</span> hứa hẹn mang đến một thử thách đầy thú vị, nơi tôn vinh tinh thần đồng đội, nơi các thành viên được thỏa sức thể hiện chất riêng và cùng nhau tạo nên những tác phẩm dự thi nổi bật để bày tỏ tình yêu và niềm tự hào dành cho Tập đoàn.
                    <br/><br/>
                    Trên hết, đây còn là cơ hội tuyệt vời để gắn kết tinh thần đồng đội, phát huy sức mạnh tập thể và có thêm những kỷ niệm đáng giá cùng đồng nghiệp.
                    <br/><br/>
                    Bạn đã sẵn sàng bùng nổ sự sáng tạo và chinh phục thử thách <span class="text-green">“Vinasoy – Tự hào 25 năm”</span> chưa?
                </div>
            </div>
            <div class="proud-hero-more story-hero-more text-center">
                <a href="javascript:;" class="read-more">Xem thể lệ</a>
            </div>
        </div>
    </div>

    <div class="story-rule">
        <div class="container">
            <div class="row">
                <div class="story-rule-wrapper w-100">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="story-rule-item">
                                <div class="story-rule-number dancing">
                                    <p>Cách <span>1</span></p>
                                </div>
                                <div class="story-rule-detail text-center">
                                    <div class="story-rule-image d-flex justify-content-center">
                                        <img src="{{Theme::asset()->url('images/icon-mail.png')}}" alt="" class="img-fluid">
                                    </div>
                                    <div class="story-rule-title text-green text-uppercase">Gửi Email cho ban tổ chức</div>
                                    <div class="story-rule-content">
                                        Đại diện đội/nhóm gửi email về cho BTC qua địa chỉ:<br/>
                                        <a href="mailto:ttnb@vinasoy.com">ttnb@vinasoy.com</a><br/>
                                        với cú pháp<br/>
                                        [Tự hào 25 – Ảnh – Tên đội] <br/>
                                        <b>Nội dung gửi bao gồm:</b>
                                        <ul class="text-left">
                                            <li>Tên đội - số lượng thành viên đội.</li>
                                            <li>Họ tên, mã HRM, phòng ban của trưởng nhóm và từng người trong đội.</li>
                                            <li>Hình ảnh dự thi + nội dung mô tả, dưới 300 chữ.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="story-rule-item">
                                <div class="story-rule-number dancing">
                                    <p>Cách <span>2</span></p>
                                </div>
                                <div class="story-rule-detail text-center">
                                    <div class="story-rule-image d-flex justify-content-center">
                                        <img src="{{Theme::asset()->url('images/icon-note.png')}}" alt="" class="img-fluid">
                                    </div>
                                    <div class="story-rule-title text-green text-uppercase">ĐIỀN FORM ĐĂNG KÝ</div>
                                    <div class="story-rule-content">
                                        <p>Đội/nhóm có thể đăng ký tham gia cuộc thi thông qua form đăng ký ngay bên dưới</p>
                                        <a href="" class="read-more">Tham gia cuộc thi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="story-form story-form-active">
                <div class="story-form-inner">
                    @if (!auth('member')->check())
                        <div class="story-form-alert text-center">
                            <p>Vui lòng <a href="javascript:;" class="text-orange sign-in-button">Đăng nhập</a> trước khi chia sẻ bài thi</p>
                        </div>
                    @endif
                    <form action="" method="post" role="form" enctype="multipart/form-data" id="dropzone">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="" id="" placeholder="Tiêu đề câu chuyện của bạn">
                        </div>

                        <div class="form-group">
                            <input type="file" name="file" id="dropzone-item"/>
                        </div>

                        <div class="form-group">
                            <textarea type="text" class="form-control" rows="10" name="" id="" placeholder="Nội dung câu chuyện"></textarea>
                        </div>

                        <div class="story-form-submit text-center">
                            <button type="submit" class="btn btn-primary">Nộp bài thi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>

<section class="list-story video-list">
    <div class="container">
        <div class="list-story-search d-flex justify-content-center align-items-center flex-column">
            <h4 class="text-center text-green dancing">
                Dach sách các bài thi khác.
            </h4>
            <div class="search-form">
                <form action="{{Request::url()}}" method="get" role="form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nhập tên hoặc mã nhân viên để tìm câu chuyện dễ hơn" name="k" value="{{Request::get('k')}}">
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

            $listVoted = [];

            if (auth()->guard('member')->check()) {
                $listVoted = auth()->guard('member')->user()->videoVoted()->get()->pluck('id')->toArray();
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
                    @if ($loop->first)
                        <div class="col-12">
                            <div class="news-item hightlight-item">
                                <div class="news-thumbnail">
                                    <a href="{{$news->url}}">
                                        <img src="{{ RvMedia::getImageUrl($news->image, 'full', false, RvMedia::getDefaultImage()) }}" alt="{{$news->name}}" class="img-fluid">
                                    </a>
                                </div>
                                <div class="news-meta">
                                    <div class="video-meta">
                                        <div class="row">
                                            <div class="col-12 col-md-5">
                                                <div class="video-meta-name">
                                                    <p><b>Vòng 1 - Thi ảnh</b></p>
                                                    <p class="text-green dancing">{{$news->name}}</p>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-7">
                                                <div class="video-meta-wrapper d-md-flex justify-content-between align-items-center">
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
                    @else

                    <div class="col-12 col-md-4">
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

                    @endif
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

{!! Theme::partial('footer') !!}
