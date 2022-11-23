<div class="login-wrapper">
    <div class="container">
        <div class="login-form">
            <form method="POST" action="{{ route('public.member.password.email') }}">
                @csrf
                <div class="form-group">
                    <input id="email" type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" required placeholder="{{ trans('plugins/member::dashboard.email') }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-blue btn-full fw6">
                        {{ trans('plugins/member::dashboard.reset-password-cta') }}
                    </button>
                    <div class="text-center">
                        <a href="{{ route('public.member.login') }}"
                           class="btn btn-link">{{ trans('plugins/member::dashboard.back-to-login') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
