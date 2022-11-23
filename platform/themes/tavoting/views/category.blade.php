<div class="news-detail">
    <div class="container">
        <div class="news-meta-title text-center">
            <h4 class="text-green dancing">Sự kiện & tin tức</h4>
            <p>Hành trình Vinasoy 25 năm - Nâng tầm dinh dưỡng vàng từ thực vật</p>
        </div>

        @php
            $category = app(\Botble\Blog\Repositories\Interfaces\PostInterface::class)
                ->getModel()
                ->whereHas('categories', function ($query) {
                    $query->where('categories.id', 13);
                })
                ->where('status', 'published')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        @endphp

        <div class="category-news-list">
            <div class="row">
                @foreach($category as $news)
                    <div class="col-12 col-md-3">
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
        </div>
    </div>
</div>


