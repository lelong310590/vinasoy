<div class="login-wrapper">
    <div class="container">
        <div class="login-form">
            <form method="POST" action="{{route('public.member.login')}}">
                @csrf
                <p class="text-center">Sign in or <a href="{{route('public.member.register')}}">create new account</a> </p>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend2">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               placeholder="{{ trans('plugins/member::dashboard.email') }}" name="email"
                               value="{{ old('email') }}" autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend2">
                                <i class="fas fa-key"></i>
                            </span>
                        </div>
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               placeholder="{{ trans('plugins/member::dashboard.password') }}" name="password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-login-action d-flex justify-content-between align-items-center">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ trans('plugins/member::dashboard.remember-me') }}
                            </label>
                        </div>

                        <div class="text-center">
                            <a class="btn btn-link" href="{{ route('public.member.password.request') }}">
                                {{ trans('plugins/member::dashboard.forgot-password-cta') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-blue btn-full fw6">
                        Sign In
                    </button>
                </div>

                <div class="text-center">
                    {!! apply_filters(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, null, \Botble\Member\Models\Member::class) !!}
                </div>
            </form>
        </div>
    </div>
</div>
