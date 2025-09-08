@extends('admin.layouts.app')
@section('admin/content')
<div class="page-wrapper">
	<div class="page-content">
		<div class="page-breadcrumb d-flex align-items-center justify-content-between mb-3">
			<div class="mb-0 text-uppercase">
			   <h6>Change Password</h6>
			</div>
		</div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert border-0 border-start border-5 border-white alert-dismissible fade show">
                                <div class="text-white">{{ session('success') }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert border-0 border-start border-5 border-white alert-dismissible fade show">
                                <div class="text-white">{{ session('error') }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('updatepassword') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="password">Old Password</label>
                                        <input type="text" class="form-control" name="oldpassword"
                                            required="required" id="oldpassword" placeholder="Enter Old Password">
                                    </div>
                                    <div class="form-group  mb-3">
                                        <label for="new_password">New Password</label>
                                        <input type="text" class="form-control" name="new_password"
                                            required="required" id="password" placeholder="Enter New Password">
                                    </div>
                                    <div class="form-group  mb-3">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="text" class="form-control" name="confirm_password"
                                            required="required" id="password" placeholder="Enter Confirm Password">
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="col-md-12 text-center">
                                            <a href="" class="btn btn-info">Back</a>
                                            <input id="save" class="btn btn-success" type="submit" name="submit"
                                                value="Submit" />
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
