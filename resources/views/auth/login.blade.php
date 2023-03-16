@extends('layouts.auth')
@section('content')
<!-- wrap @s -->
<div class="nk-wrap nk-wrap-nosidebar">
    <!-- content @s -->
    <div class="nk-content ">
        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
            <div class="brand-logo pb-4 text-center">
                @include('partials.alerts')
            </div>
            <div class="card card-bordered">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Sign-In</h4>
                        </div>
                    </div>
                    {!! Form::model([], ['url' => 'login', 'class' => 'form-validate', 'autocomplete' =>
                    'off']) !!}
                    @method('post')
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">Email</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="email" name="email" class="form-control form-control-lg" id="default-01"
                                placeholder="Enter your email address">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password">Password</label>
                            <a class="link link-primary link-sm" href="javascript:void(0)">Forgot Code?</a>
                        </div>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" name="password" class="form-control form-control-lg" id="password"
                                placeholder="Enter your Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                    </div>
                    <div class="form-note-s2 text-center pt-4"> New on our platform? <a href="{{ route('register') }}">Create
                            an account</a>
                    </div>
                    <div class="text-center pt-4 pb-3">
                        <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                    </div>
                    <ul class="nav justify-center gx-4">
                        <li class="nav-item"><a class="nav-link" href="javascript:void(0)">Facebook</a></li>
                        <li class="nav-item"><a class="nav-link" href="javascript:void(0)">Google</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="nk-footer nk-auth-footer-full">
            <div class="container wide-lg">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="nk-block-content text-center text-lg-start">
                            <p class="text-soft">&copy; {{ date('Y') }} made by <a
                                    href="https://www.linkedin.com/in/sohailak/" target="_blank">Sohail</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- wrap @e -->
</div>
<!-- content @e -->

@endsection
