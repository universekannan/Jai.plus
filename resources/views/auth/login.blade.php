<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="images/fav.ico">
@extends('admin/layouts.app')
@section('content')
  <section>
		<div class="tr-register">
			<div class="tr-regi-form">
				<h4>Sign <span>In</span></h4>
				<p>It's free and always will be.</p>
				            <p class="text-center text-danger" >{{ session('message') }} </p>

				<form class="col s12" method="post" action="{{ url('/adminlogin') }}">
				 @csrf
					<div class="row">
						<div class="input-field col s12">
							<input type="email" class="validate" name="email" placeholder="User Name" required>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input type="password" class="validate" name="password" placeholder="Password" required>
						</div>
					</div>
					 @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
					<div class="row">
						<div class="input-field col s12">
							<input type="submit" value="Sign In" class="waves-effect waves-light btn-large full-btn"> </div>
					</div>
				</form>
				<p>Are you a new user ? <a href="{{ url('register') }}">Register</a>
				</p>

			</div>
		</div>
	</section>
@endsection
















