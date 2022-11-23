<div class="dashboard-wrapper">
    <div class="container">
        <div class="dashboard-content">
            <div class="row">
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
                                <li><a href="">Vinasoy, chuyện bây giờ mới kể</a></li>
                                <li><a href="">Tự hào 25 năm - <span>Vòng 1</span></a></li>
                                <li><a href="">Tự hào 25 năm - <span>Vòng 2</span></a></li>
                            </ul>
                        </div>
                        <div class="dashboard-list">
                            <div class="dashboard-list-title text-green text-uppercase">
                                Bài tôi đã bình chọn
                            </div>
                            <ul>
                                <li><a href="">Tự hào 25 năm - <span>Vòng 1</span></a></li>
                                <li><a href="">Tự hào 25 năm - <span>Vòng 2</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8">
                    <div class="dashboard-right">
                        <div class="dashboard-right-title text-green">
                            THÔNG TIN TÀI KHOẢN
                        </div>
                        <div class="dashboard-right-content">
                            <div class="content-left">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Họ và tên</td>
                                            <td>{{$user->first_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Ngày sinh</td>
                                            <td>{{$user->dob}}</td>
                                        </tr>
                                        <tr>
                                            <td>Số điện thoại</td>
                                            <td>{{$user->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="content-right">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td>HRM</td>
                                        <td>{{$user->hrm}}</td>
                                    </tr>
                                    <tr>
                                        <td>Phòng ban</td>
                                        <td>{{$user->department}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nơi làm việc</td>
                                        <td>{{$user->area}}</td>
                                    </tr>
                                    <tr>
                                        <td>Thị trường</td>
                                        <td>Việt Nam</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
