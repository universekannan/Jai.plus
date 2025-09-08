<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="images/fav.ico">
    @extends('layouts.app')
    @section('content')
        <section>
            <div class="tr-register">
                @if (session()->has('password'))
                    <div class="alert alert-success alert-dismissable" style="margin: 15px;">
                        <a href="#" style="color:green !important" class="close" data-dismiss="alert"
                            aria-label="close">&times;</a>
                        <strong> {{ session('password') }} </strong>
                    </div>
                @endif
                @if (session()->has('password_confirmation'))
                    <div class="alert alert-danger alert-dismissable" style="margin: 15px;">
                        <a href="#" style="color:red !important" class="close" data-dismiss="alert"
                            aria-label="close">&times;</a>
                        <strong> {{ session('password_confirmation') }} </strong>
                    </div>
                @endif
                <div class="tr-regi-form">
                    <h4>Create an <span>Account</span></h4>
                    <form method="post" action="{{ url('saveregister') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" class="validate form-control" name="full_name"
                                    placeholder="Full Name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="number" class="validate form-control" name="phone" placeholder="Mobile" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" class="validate form-control" name="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="password" class="validate form-control" name="password" id="password"
                                    placeholder="Password" required>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="input-field col s12">
                                <input type="text" class="validate form-control" name="confirm_password"
                                    id="confirm_password" placeholder="Confirm Password" required>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="submit" value="submit" class="waves-effect waves-light btn-large full-btn">
                                <span id='message'></span>
                            </div>
                        </div>
                    </form>
                    {{-- <form method="post" action="{{ route('saveregister') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" placeholder="Full name" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Retype password" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form> --}}
                </div>
            </div>
        </section>
 
    @endsection
