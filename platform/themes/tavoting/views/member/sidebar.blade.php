<div class="col-12 col-md-4">
    <div class="dashboard-navigation">
        <div class="avatar">
            <img src="{{Theme::asset()->url('images/avatar.png')}}" alt="" class="img-fluid">
            <div class="avatar-info">
                <h4 class="text-green">{{$user->first_name}}</h4>
                <p>HRM: {{$user->hrm}}</p>
            </div>
        </div>
        <div class="dashboard-title-main">
            Thông tin tài khoản
        </div>
        <div class="dashboard-list">
            <div class="dashboard-list-title text-green text-uppercase">
                Bài thi của tôi
            </div>
            <ul>
                <li><a href="{{route('public.member.challenge', ['slug' => 'chuyen-bay-gio-moi-ke'])}}">Chuyện bây giờ mới kể</a></li>
                <li><a href="">Tự hào 25 năm</a></li>
            </ul>
        </div>
        <div class="dashboard-list">
            <div class="dashboard-list-title text-green text-uppercase">
                Bài tôi đã bình chọn
            </div>
            <ul>
                <li><a href="">Tự hào 25 năm</a></li>
            </ul>
        </div>
    </div>
</div>
