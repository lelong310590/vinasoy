<!-- JS Library-->
{!! Theme::footer() !!}

<footer class="footer" id="footer">
    <div class="container">
        <div class="footer-wrapper">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="footer-logo">
                        <a href="">
                            <img src="{{Theme::asset()->url('images/footer-logo.png')}}" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="footer-col">
                                <h4>Menu</h4>
                                {!!
                                    Menu::renderMenuLocation('main-menu', [
                                        'options' => ['class' => 'menu sub-menu--slideLeft'],
                                        'view'    => 'main-menu',
                                    ])
                                !!}
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="footer-col">
                                <h4>Liên hệ</h4>
                                <p>02 Nguyễn Chí Thanh, phường Quảng Phú, thành phố Quảng Ngãi</p>
                                <div class="copyright">
                                    Bản quyền © Vinasoy 2022
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="form-popup">
    <div class="form-popup-close">
        <a href="javascript:;"><i class="fa-solid fa-xmark"></i></a>
    </div>
    <div class="form-popup-content">
        <div class="login-form text-center">
            <h4 class="text-green dancing">Đăng nhập</h4>
            <p>Vui lòng nhập tên đăng nhập (Mã HRM) và mật khẩu của bạn (ngày/tháng/năm sinh).<br/>
                Ví dụ: bạn sinh ngày 19/08/1980, nhập mật khẩu là 190880</p>
            <form method="POST" action="{{ route('public.member.login') }}">
                @csrf
                <div class="form-group">
                    <input id="email" type="text"
                           class="form-control{{ $errors->has('hrm') ? ' is-invalid' : '' }}"
                           placeholder="Mã HRM" name="hrm"
                           value="{{ old('hrm') }}" autofocus>
                    @if ($errors->has('hrm'))
                        <span class="invalid-feedback">
                                <strong>{{ $errors->first('hrm') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               placeholder="Mật khẩu" name="password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-blue btn-full fw6">
                        Đăng nhập
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
