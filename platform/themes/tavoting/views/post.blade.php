<div class="news-detail">
    <div class="container">
        <div class="news-meta-title text-center">
            <h4 class="text-green dancing">Sự kiện & tin tức</h4>
            <p>Hành trình Vinasoy 25 năm - Nâng tầm dinh dưỡng vàng từ thực vật</p>
        </div>

        <div class="news-content-detail">
            <h1 class="text-green">{{$post->name}}</h1>
            <div class="news-content">
                {!! $post->content !!}
            </div>

            @php
                $related = app(\Botble\Blog\Repositories\Interfaces\PostInterface::class)
                    ->getModel()
                    ->where('id', '!=', $post->id)
                    ->where('status', 'published')
                    ->orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get();
            @endphp

            @if ($related->count() > 0)
            <div class="related-post">
                <ul>
                    @foreach($related as $r)
                    <li><a href="{{$r->url}}">{{$r->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="news-back">
                <a href="/tin-tuc-cap-nhat"><i class="fa-solid fa-circle-arrow-left"></i> Quay lại</a>
            </div>
        </div>
    </div>
</div>


