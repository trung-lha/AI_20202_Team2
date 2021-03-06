@extends('layouts.app')

@section('content')
    <style>
        form.user .form-control-user {
            padding: 1rem 0.5rem;
        }

    </style>
    @include('layouts.header')
    <div class="container pt-3" style="margin-top: 12%;">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>

                            <form class="user" method="POST" action="{{route('register')}}" id="register_form">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">

                                        <input id="name" type="text"
                                            class="form-control form-control-user @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" placeholder="  Username" required
                                            autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{-- <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address"> --}}
                                    <input id="email" type="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="  Email Address">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        {{-- <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password"> --}}
                                        <input id="password" type="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password" placeholder="  Password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        {{-- <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password"> --}}
                                            <input id="password-confirm" type="password" class="form-control form-control-use" name="password_confirmation" required autocomplete="new-password" placeholder="  Confirm Password" >
                                    </div>
                                </div>
                                <a ref="javascript:{}" onclick="document.getElementById('register_form').submit();" class="btn btn-primary btn-user btn-block">
                                    <span style="color: black">Register</span>
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('layouts.footer')

@endsection
