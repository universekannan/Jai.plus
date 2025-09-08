@extends('admin.layouts.app')
@section('admin/content')

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-flex align-items-center justify-content-between mb-3">
            <div class="mb-0 text-uppercase">
                <h6>Profile</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <div>{{ session('error') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{ url('/updateprofile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="userid" value="{{ $profile->id }}">

                            <div class="d-flex justify-content-center mb-3">
                                <div class="position-relative">
                                    <img src="{{ auth()->check() && auth()->user()->photo 
                                        ? asset(auth()->user()->photo) 
                                        : asset('assets/images/avatars/user.png') }}" class="rounded-circle border border-3 border-primary"
                                        alt="user avatar" style="width:120px; height:120px; object-fit:cover;">

                                    <input type="file" name="photo" id="photoInput" accept="image/*" class="d-none">

                                    <label for="photoInput"
                                        class="position-absolute start-50 translate-middle-x bg-primary text-white rounded-circle p-2 shadow"
                                        style="cursor:pointer; transform: translate(-50%, 50%); bottom: 20px;">
                                        <i class="fas fa-edit"></i>
                                    </label>
                                </div>
                            </div>


                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input required type="text" name="name" class="form-control"
                                        value="{{ $profile->name }}" placeholder="Name">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label">User ID</label>
                                <div class="col-sm-8">
                                    <input type="text" name="user_name" class="form-control"
                                        value="{{ $profile->user_name }}" placeholder="User ID" readonly>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-8">
                                    <input required type="text" name="phone" class="form-control"
                                        value="{{ $profile->phone }}" placeholder="Phone">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input required type="email" name="email" class="form-control"
                                        value="{{ $profile->email }}" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label">Wallet Address</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input required type="text" id="walletAddress" name="wallet_address"
                                            class="form-control" value="{{ $profile->wallet_address }}"
                                            placeholder="Wallet Address">
                                        <button type="button" class="btn btn-primary" id="copyWalletBtn">
                                            Copy
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-md-12 text-center">
                                    <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const copyBtn = document.getElementById("copyWalletBtn");
const walletInput = document.getElementById("walletAddress");

copyBtn.addEventListener("click", function() {
    walletInput.select();
    walletInput.setSelectionRange(0, 99999);

    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(walletInput.value).then(() => {
            copyBtn.innerHTML = "✔ Copied";
            copyBtn.classList.replace("btn-primary", "btn-success");

            setTimeout(() => {
                copyBtn.innerHTML = "Copy";
                copyBtn.classList.replace("btn-success", "btn-primary");
            }, 3000);
        });
    } else {
        document.execCommand("copy");
    }
});
</script>
@endsection