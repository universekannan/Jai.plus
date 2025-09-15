<style>
body.dark-mode .main-header {
    background-color: #343a40 !important;
    color: #fff !important;
}

body.dark-mode .main-header .nav-link,
body.dark-mode .main-header .navbar-nav .nav-item>a {
    color: #fff !important;
}
</style>
<header class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        @if(auth()->user()->plan_id != 0)
        @php
        $registerLink = url('/register/' . auth()->user()->user_name);

        $shareMessage = "Hey! Friends!! Join JAI using my referral details:\n"
        . "User Name: " . auth()->user()->name . "\n"
        . "Phone: " . auth()->user()->phone . "\n"
        . "Referral User Id: " . auth()->user()->user_name . "\n"
        . "Sign up here: " . $registerLink;

        $encodedMessage = urlencode($shareMessage);
        @endphp

        <!-- WhatsApp Share -->
        <li class="nav-item">
            <a class="btn btn-success btn-sm mr-2" href="https://wa.me/?text={{ $encodedMessage }}"
                title="Share on WhatsApp" target="_blank">
                <i class="fab fa-whatsapp"></i> Share
            </a>
        </li>

        <!-- Copy Referral -->
        <!-- <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm mr-2" id="copyReferral" data-text="{{ $shareMessage }}">
                <i class="fas fa-copy"></i> <span id="copyText">Copy</span>
            </button>
        </li> -->
        @endif

        <!-- User Dropdown -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                @if(auth()->check() && auth()->user()->photo)
                <img src="{{ asset(auth()->user()->photo) }}" class="user-image img-circle elevation-2"
                    alt="User Image">
                @else
                <img src="{{ asset('assets/images/avatars/user.png') }}" class="user-image img-circle elevation-2"
                    alt="User Image">
                @endif
                <span class="d-none d-md-inline">{{ auth()->check() ? auth()->user()->name : 'Guest' }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-primary">
                    @if(auth()->check() && auth()->user()->photo)
                    <img src="{{ asset(auth()->user()->photo) }}" class="img-circle elevation-2" alt="User Image">
                    @else
                    <img src="{{ asset('assets/images/avatars/user.png') }}" class="img-circle elevation-2"
                        alt="User Image">
                    @endif

                    <p>
                        {{ auth()->check() ? auth()->user()->name : 'Guest' }}
                        <small>{{ auth()->check() ? auth()->user()->email : '' }}</small>
                    </p>
                </li>

                <li class="user-footer">
                    <a href="{{ route('profile') }}" class="btn btn-default btn-flat"><i class="fas fa-user"></i>
                        Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-default btn-flat float-right">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>

                <li class="user-footer">
                    <button id="toggle-darkmode" class="btn btn-dark btn-block">
                        <i class="fas fa-moon"></i> Dark Mode
                    </button>
                </li>
            </ul>
        </li>

    </ul>
</header>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const body = document.body;
    const darkToggle = document.getElementById("toggle-darkmode");
    const navbar = document.querySelector(".main-header");

    if (localStorage.getItem("dark-mode") === "enabled") {
        body.classList.add("dark-mode");
        if (navbar) {
            navbar.classList.remove("navbar-light");
            navbar.classList.add("navbar-dark");
            navbar.classList.add("bg-dark");
        }
    }

    darkToggle.addEventListener("click", function() {
        body.classList.toggle("dark-mode");

        if (body.classList.contains("dark-mode")) {
            localStorage.setItem("dark-mode", "enabled");
            if (navbar) {
                navbar.classList.remove("navbar-light");
                navbar.classList.add("navbar-dark");
                navbar.classList.add("bg-dark");
            }
        } else {
            localStorage.setItem("dark-mode", "disabled");
            if (navbar) {
                navbar.classList.remove("navbar-dark", "bg-dark");
                navbar.classList.add("navbar-light");
            }
        }
    });
});


// document.getElementById('copyReferral')?.addEventListener('click', function() {
//     let textToCopy = this.getAttribute('data-text');

//     navigator.clipboard.writeText(textToCopy).then(() => {
//         let copyText = document.getElementById('copyText');
//         copyText.textContent = "Copied! ✓";

//         setTimeout(() => {
//             copyText.textContent = "Copy";
//         }, 5000);
//     }).catch(() => {
//         alert('Failed to copy.');
//     });
// });
</script>