{!! Theme::partial('header') !!}

<section class="story-hero">
    <img src="{{Theme::asset()->url('images/story-bg.png')}}" alt="" class="img-fluid mx-auto">
    <div class="story-hero-content">
        <div class="container">
            <div class="story-hero-detail-wrapper d-flex justify-content-center">
                <div class="story-hero-detail text-center">
                    Bạn biết không? Chẳng điều gì kết nối cảm xúc mạnh mẽ bằng những câu chuyện. Và đặc biệt hơn khi đó là những câu chuyện của riêng mỗi người.
                    <br/><br/>
                    Với lý do đó, <b>“Chuyện bây giờ mới kể”</b> sẽ là cơ hội tuyệt vời để bạn bày tỏ lòng mình, để một lần được
                    “du hành” ngược dòng thời gian mà sống trọn những khoảnh khắc đáng nhớ trong suốt hành trình đồng hành và gắn bó
                    dưới “mái nhà” Vinasoy.
                    <br/><br/>
                    Dù bạn là ai, ở cương vị nào, câu chuyện của bạn sẽ là duy nhất, là một “mảnh ghép” đặc biệt trên hành trình trưởng thành của Vinasoy, là nguồn cảm hứng mạnh mẽ, tiếp thêm tin yêu và nhiệt huyết cho mỗi người.
                    <br/><br/>
                    Hãy một lần tự tin “kể hết” cùng <b>“Chuyện bây giờ mới kể”</b> nhé!
                </div>
            </div>
{{--            <div class="story-hero-more text-center">--}}
{{--                <a href="javascript:;" class="read-more">Xem thể lệ</a>--}}
{{--            </div>--}}
        </div>
    </div>
    <div class="story-rule">
        <div class="container">
            <div class="row">
                <div class="story-rule-wrapper w-100">
                    <div class="row">
                        <div class="col-12 col-md-4">
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
                                        CB-CNV gởi email câu chuyện về cho BTC tại địa chỉ:<br/>
                                        <a href="mailto:ttnb@vinasoy.com">ttnb@vinasoy.com</a><br/>
                                        với cú pháp<br/>
                                        <span class="text-green">[Chuyện bây giờ mới kể]-[Mã HRM người dự thi]</span><br/>
                                        Đính kèm mail là file nội dung câu chuyện<br/>
                                        (dưới dạng bài viết, thu âm, lời kể tóm tắt/chi tiết) hoặc hình ảnh…<br/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="story-rule-item">
                                <div class="story-rule-number dancing">
                                    <p>Cách <span>2</span></p>
                                </div>
                                <div class="story-rule-detail text-center">
                                    <div class="story-rule-image d-flex justify-content-center">
                                        <img src="{{Theme::asset()->url('images/icon-book.png')}}" alt="" class="img-fluid">
                                    </div>
                                    <div class="story-rule-title text-green text-uppercase">GỬI PHIẾU TRỰC TIẾP</div>
                                    <div class="story-rule-content">
                                        BTC bố trí các phiếu điền câu chuyện tại<br/>
                                        Bức tường Chuyện bây giờ mới kể<br/>
                                        CB-CNV điền phiếu và bỏ vào hòm thư<br/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="story-rule-item">
                                <div class="story-rule-number dancing">
                                    <p>Cách <span>3</span></p>
                                </div>
                                <div class="story-rule-detail text-center">
                                    <div class="story-rule-image d-flex justify-content-center">
                                        <img src="{{Theme::asset()->url('images/icon-note.png')}}" alt="" class="img-fluid">
                                    </div>
                                    <div class="story-rule-title text-green text-uppercase">ĐIỀN FORM ĐĂNG KÝ</div>
                                    <div class="story-rule-content">
                                        Chia sẻ câu chuyện dễ dàng bằng cách điền form ngay tại website.<br/>
                                        <a href="" class="read-more">Chia sẻ câu chuyện</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="story-cta">
    <div class="container">
        <div class="story-cta-title text-center">
            <h4 class="text-green dancing">Tham gia ngay!</h4>
            <p>Để tham gia chia sẻ câu chuyện, bạn hãy click vào nút bên dưới và làm theo hướng dẫn.</p>
{{--            <a href="javascript:;" class="read-more open-story-form">Chia sẻ câu chuyện <i class="fa-sharp fa-solid fa-down"></i></a>--}}
            <p><b>Thời hạn nhận bài: Đã hết thời hạn nhận bài</b></p>
        </div>

        <div class="story-form">
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
                        <button type="submit" class="btn btn-primary">Chia sẻ câu chuyện</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

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
@endphp

@if ($hightLightExe != null)
<section class="exe-content">
    <div class="exe-hightlight story-hightlight">
        <div class="exe-hightlight-wrapper">
            <div class="container">
                <div class="exe-hightlight-wrapper-inner">
                    <div class="exe-image">
                        <img src="{{ RvMedia::getImageUrl($hightLightExe->image, 'square', false, RvMedia::getDefaultImage()) }}" alt="" class="img-fluid">
                    </div>
                    <div class="ext-content">
                        <h4 class="text-orange text-uppercase">{{$hightLightExe->name}}</h4>
                        <div class="exe-detail">
                            {!! clean($hightLightExe->content) !!}
                        </div>
                        <div class="ext-hightlight-more text-center">
                            <a href="{{$hightLightExe->url}}" class="read-more">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<section class="list-story">
    <div class="container">
        <div class="list-story-search d-flex justify-content-center">
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
                            $query->where('vv_video_categories.id', 1);
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

        <div class="list-wrapper news-item-small">

            @if (Request::get('k') != '' && $exes != [])
                <div class="empty-search text-center">
                    <p>Tìm thấy <span class="text-green">{{$exes->count()}} kết quả</span> theo từ khóa của bạn.</p>
                </div>
            @endif

            <div class="row">
                @forelse($exes as $news)
                    <div class="col-12 col-md-3">
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
