<!-- JS Library-->
{!! Theme::footer() !!}

<footer class="footer" id="footer">
    <div class="container">
        <div class="footer-wrapper">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="footer-logo">
                        <a href="{{route('public.index')}}">
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
                                <p>Email: <a href="mailto:ttnb@vinasoy.com">ttnb@vinasoy.com</a></p>
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
            <p>Vui lòng nhập tên đăng nhập (Mã HRM) và mật khẩu của bạn (ngày/tháng/năm sinh)</p>
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
{{--                <div class="form-group">--}}
{{--                    <div class="input-group">--}}
{{--                        <input id="password" type="password"--}}
{{--                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} d-none"--}}
{{--                               placeholder="Mật khẩu" name="password">--}}
{{--                        @if ($errors->has('password'))--}}
{{--                            <span class="invalid-feedback">--}}
{{--                                <strong>{{ $errors->first('password') }}</strong>--}}
{{--                            </span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Ngày sinh</label>
                            <select name="dob_day" id="dob_day" class="form-control">
                                @for($i = 1; $i <= 31; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="">Tháng sinh</label>
                            <select name="dob_month" id="dob_month" class="form-control">
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{$i < 10 ? '0'.$i : $i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="">Năm sinh</label>
                            <select name="dob_year" id="dob_year" class="form-control">
                                @for($i = 1945; $i <= 2010; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
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

<script type="text/javascript">
    $(document).ready(function () {

        function reload() {
            window.location.reload()
        }

        $('.sa-devoting').on('click', function () {

            @if (auth('member')->check())
            const csrf = $('meta[name="csrf-token"]').attr('content');
            var videoId = $(this).attr('data-video-id');
            Swal.fire({
                title: 'Bỏ bình chọn !',
                text: 'Bạn muốn bỏ bình chọn bài thi này ?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrf
                        }
                    });
                    $.ajax({
                        url: "{{route('public.ajax.devote')}}",
                        type: 'POST',
                        data: {
                            videoId
                        },
                        success: function( response ) {
                            if (response.error) {
                                //failed
                                Swal.fire({
                                    title: 'Lỗi!',
                                    text: "Bạn không thể bỏ bình chọn bài thi này. Vui lòng thử lại sau",
                                    icon: 'error',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {} {
                                        reload()
                                    }
                                })
                            } else {
                                //successs
                                Swal.fire({
                                    title: 'Thành công!',
                                    text: "Bạn đã bỏ bình chọn cho bài thi này!",
                                    icon: 'success',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {
                                        reload()
                                    }
                                })
                            }
                        },
                        error: function( err ) {
                            Swal.fire({
                                title: 'Lỗi!',
                                text: "Bạn không thể bỏ bình chọn bài thi này. Vui lòng thử lại sau",
                                icon: 'error',
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    reload()
                                }
                            })
                        }
                    });
                }
            })
            @endif
        })

        $('.sa-voting').on('click', function () {

            @if (auth('member')->check())
            const csrf = $('meta[name="csrf-token"]').attr('content');
            var videoId = $(this).attr('data-video-id');
            Swal.fire({
                title: 'Bình chọn !',
                text: 'Bạn muốn bình chọn bài thi này ?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrf
                        }
                    });
                    $.ajax({
                        url: "{{route('public.ajax.vote')}}",
                        type: 'POST',
                        data: {
                            videoId
                        },
                        success: function( response ) {
                            if (response.error) {
                                //failed
                                Swal.fire({
                                    title: 'Lỗi!',
                                    text: "Bạn không thể bình chọn bài thi này. Vui lòng thử lại sau",
                                    icon: 'error',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {} {
                                        reload()
                                    }
                                })
                            } else {
                                //successs
                                Swal.fire({
                                    title: 'Cảm ơn!',
                                    text: "Bạn đã bình chọn cho bài thi này!",
                                    icon: 'success',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {
                                        reload()
                                    }
                                })
                            }
                        },
                        error: function( err ) {
                            Swal.fire({
                                title: 'Lỗi!',
                                text: "Bạn không thể bình chọn bài thi này. Vui lòng thử lại sau",
                                icon: 'error',
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    reload()
                                }
                            })
                        }
                    });
                }
            })
            @else
            Swal.fire({
                title: 'Lưu ý!',
                html:
                    'Bạn phải <a href="{{route('public.member.login')}}">đăng nhập</a> để bình chọn bài thi',
                icon: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false
            })
            @endif
        })
    })
</script>

@if (session()->has('success_msg') || session()->has('error_msg') || (isset($errors) && $errors->count() > 0) || isset($error_msg))
    <script type="text/javascript">

        window.showAlert = function (messageType, message) {
            if (messageType && message !== '') {
                var alertId = Math.floor(Math.random() * 1000);
                var html = "<div class=\"alert ".concat(messageType, " alert-dismissible\" id=\"").concat(alertId, "\">\n                <span class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"close\"></span>\n                <i class=\"fi-rs-") + (messageType === 'alert-success' ? 'check' : 'cross') + " message-icon\"></i>\n                ".concat(message, "\n            </div>");
                $('#alert-container').append(html).ready(function () {
                    window.setTimeout(function () {
                        $("#alert-container #".concat(alertId)).remove();
                    }, 6000);
                });
            }
        };

        $(document).ready(function () {
            @if (session()->has('success_msg'))
            window.showAlert('alert-success', '{{ session('success_msg') }}');
            @endif

            @if (session()->has('error_msg'))
            window.showAlert('alert-danger', '{{ session('error_msg') }}');
            @endif

            @if (isset($error_msg))
            window.showAlert('alert-danger', '{{ $error_msg }}');
            @endif

            @if (isset($errors))
            @foreach ($errors->all() as $error)
            window.showAlert('alert-danger', '{!! clean($error) !!}');
            @endforeach
            @endif
        });
    </script>
    @endif

</body>
</html>
