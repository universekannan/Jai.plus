<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">

                <a href="{{ url('/home') }}" class="h1"><b>{{ config('app.name') }}</b>Login</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form method="post" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="device_token" id="device_token">

                    <div class="input-group mb-3">
                        <input type="text" name="user_name" placeholder="User Name" class="form-control">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" placeholder="Password"
                            class="form-control @error('password') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                    <br>
                    <!-- Register button centered below -->
                    <div class="col-12">
                        <div class="text-center">
                            <p class="mb-0">Don't have an account yet? <a href="{{ url('register') }}">Sign up here</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- <script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('/sw.js') }}"></script> -->
    <!-- <script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }uul
</script> -->
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-messaging.js"></script>
    <script>
    const firebaseConfig = {
        apiKey: "AIzaSyDPF4E8KHU2ZLCvrB8Q9zMcUbHyWc5GYdQ",
        authDomain: "mimart-5e4a1.firebaseapp.com",
        projectId: "mimart-5e4a1",
        storageBucket: "mimart-5e4a1.appspot.com",
        messagingSenderId: "725105025812",
        appId: "1:725105025812:web:bd77056fd20a9d9ca69801"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function IntitalizeFireBaseMessaging() {
        messaging
            .requestPermission()
            .then(function() {
                //console.log("Notification Permission");
                return messaging.getToken();
            })
            .then(function(token) {
                //console.log("Token : " + token);
                document.getElementById("device_token").value = token;
            })
            .catch(function(reason) {
                // alert(reason);
            });
    }
    messaging.onTokenRefresh(function() {
        messaging.getToken()
            .then(function(newtoken) {
                //console.log("New Token : " + newtoken);
                document.getElementById("device_token").value = newtoken;
            })
            .catch(function(reason) {
                //alert(reason);
            })
    });
    IntitalizeFireBaseMessaging();
    </script>
</body>

</html>