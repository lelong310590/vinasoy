<div class="login-wrapper">
    <div class="container">
        <div class="login-form">
            <form method="POST" action="{{ route('public.member.register') }}">

                <p class="text-center">If you have account. <a href="{{route('public.member.login')}}">Click here to Sign In</a> </p>
                @csrf
                <div class="form-group">
                    <input id="first_name" type="text"
                           class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                           name="first_name" value="{{ old('first_name') }}" required autofocus
                           placeholder="{{ trans('plugins/member::dashboard.first_name') }}">
                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="last_name" type="text"
                           class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                           name="last_name" value="{{ old('last_name') }}" required
                           placeholder="{{ trans('plugins/member::dashboard.last_name') }}">
                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="email" type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" required
                           placeholder="{{ trans('plugins/member::dashboard.email') }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           name="password" required
                           placeholder="{{ trans('plugins/member::dashboard.password') }}">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" required
                           placeholder="{{ trans('plugins/member::dashboard.password-confirmation') }}">
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-blue btn-full fw6">
                        {{ trans('plugins/member::dashboard.register-cta') }}
                    </button>
                </div>

                <div class="text-center">
                    {!! apply_filters(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, null, \Botble\Member\Models\Member::class) !!}
                </div>
            </form>
        </div>
    </div>
</div>
