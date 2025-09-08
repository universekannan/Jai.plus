<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} Registration</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/select2.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="hold-transition register-page">

    <div class="register-box">
        <div class="card">
            <div class="card-body register-card-body">
                @php
                $ref = Request::segment(2);
                $referrer = null;
                if(!empty($ref)) {
                $referrer = DB::table('users')->where('user_name', $ref)->first();
                }
                @endphp

                <div class="text-center mb-4">
                    <h5 class="mt-3">T F C - Registration</h5>
                    <p class="mb-0">Please create your Crypto Wallet account</p>
                    @if($referrer)
                    <div class="col-12">
                        <p class="form-control-plaintext mb-0">
                            Referred By: <strong>{{ $referrer->name }}</strong> ,
                            Referral ID: <strong>{{ $ref }}</strong>
                        </p>
                    </div>
                    @endif
                </div>

                <form method="post" action="{{ route('newregister') }}">
                    @csrf

                    @if($ref)
                    <input type="hidden" name="referral_id" value="{{ $ref }}">
                    @endif

                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" placeholder="Full name">
                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="fas fa-user"></i></span></div>
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="Email">
                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="fas fa-envelope"></i></span></div>
                        @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    @php
                    $countries = DB::table('countries')->get();
                    @endphp

                    <div class="input-group mb-3">
                        <div class="input-group-prepend" style="max-width:150px;">
                            <select class="form-control select2 @error('country_code') is-invalid @enderror"
                                name="country_code" id="country_code" style="width:120px;">
                                <option value="">Code</option>
                                @foreach ($countries as $res)
                                <option value="{{ $res->phone_code }}"
                                    {{ old('country_code') == $res->phone_code ? 'selected' : '' }}>
                                    {{ $res->iso3 }} ( +{{ $res->phone_code }} )
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="form-control @error('phone') is-invalid @enderror" placeholder="Phone Number">

                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>

                        @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group mb-3">
                        <div class="input-group-prepend" style="max-width:150px;">
                            <select class="form-control select2 @error('whatsapp_country_code') is-invalid @enderror"
                                name="whatsapp_country_code" id="whatsapp_country_code" style="width:120px;">
                                <option value="">Code</option>
                                @foreach ($countries as $res)
                                <option value="{{ $res->phone_code }}"
                                    {{ old('whatsapp_country_code') == $res->phone_code ? 'selected' : '' }}>
                                    {{ $res->iso3 }} ( +{{ $res->phone_code }} )
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number') }}"
                            class="form-control @error('whatsapp_number') is-invalid @enderror"
                            placeholder="WhatsApp Number">

                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                        </div>

                        @error('whatsapp_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="fas fa-lock"></i></span></div>
                        @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Retype password">
                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="fas fa-lock"></i></span></div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="wallet_address" value="{{ old('wallet_address') }}"
                            class="form-control @error('wallet_address') is-invalid @enderror"
                            placeholder="Crypto Wallet Address">
                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="fas fa-wallet"></i></span></div>
                        @error('wallet_address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>

                <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
            </div>
        </div>
    </div>

    <script src="js/app.js"></script>
    <script src="assets/js/select2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>

</html>