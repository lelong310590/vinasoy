@php
    $memberList = $video->member_id;
    $memberArray = explode(',', $memberList);
    $members = app(\Botble\Member\Repositories\Interfaces\MemberInterface::class)
        ->getModel()
        ->whereIn('hrm', $memberArray)
        ->get();
@endphp
<div class="exe-detail-wrapper">
    <div class="container">
        <div class="exe-hightlight">
            <div class="exe-hightlight-wrapper">
                <div class="container">
                    <div class="exe-hightlight-wrapper-inner">
                        <div class="exe-image">
                            <img src="{{ RvMedia::getImageUrl($video->image, 'full', false, RvMedia::getDefaultImage()) }}" alt="" class="img-fluid">
                        </div>
                        <div class="ext-content">
                            <div class="exe-content-meta">
                                <p><b>Câu chuyện được chia sẻ bởi</b></p>
                                <div class="ext-content-author text-green">
                                    @foreach($members as $m)
                                        <p>{{$m->name}} - {{$m->hrm}}</p>
                                    @endforeach
                                </div>
                            </div>
                            <h1 class="text-orange text-uppercase">{{$video->name}}</h1>
                            <div class="exe-detail exe-detail-full">
                                {!! clean($video->content) !!}
                            </div>
                            <div class="exe-sharing d-flex justify-content-end align-center">
                                <div class="exe-share-social">
                                    <p>Chia sẻ</p>
                                    <div class="exe-share-link">
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
            <h4 class="dancing text-green">Đọc thêm các câu chuyện khác!</h4>
            <p>Nếu bạn cũng có câu chuyện của riêng mình, đừng ngại ngần chia sẻ nó với chúng tôi.</p>
{{--            <div class="exe-detail-mega-nav text-center">--}}
{{--                <a href="" class="text-orange">Xem thể lệ</a>--}}
{{--                <a href="" class="text-orange">Chia sẻ câu chuyện</a>--}}
{{--            </div>--}}
        </div>

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
                        ->paginate(10);
                }
            } else {
                $exes = $exesQuery->where('status', 'published')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
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
                                    <img src="{{ RvMedia::getImageUrl($news->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{$news->name}}" class="img-fluid">
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
