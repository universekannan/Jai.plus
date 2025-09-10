@extends('admin.layouts.app')
@section('admin/content')
<div class="page-wrapper">
    <div class="page-content">

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissable" style="margin: 15px;">
            <a href="#" style="color:white !important" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong style="color:white !important"> {{ session('success') }} </strong>
        </div>
        @endif

        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>
        <br>

        <div class="row">
            <div class="col-md-3 col-sm-6">
                <a href="{{ url('admin/members/1') }}">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-primary"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Active Members</span>
                            <span class="info-box-number">{{ $ActiveMembers }}</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="{{ url('admin/members/2') }}">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-danger"><i class="fas fa-user-slash"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Inactive Members</span>
                            <span class="info-box-number">{{ $InactiveMembers }}</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="{{ url('admin/user_activate_plan') }}">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-success"><i class="fas fa-trophy"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Next Active Plan</span>
                            <span class="info-box-number">{{ $nextPlanName }}</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="{{ url('admin/wallet') }}">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-warning"><i class="fas fa-wallet"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Wallet</span>
                            <span class="info-box-number">{{ Auth::user()->wallet }} </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="{{ url('admin/spornser') }}">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-info"><i class="fas fa-dollar-sign"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Direct Refferal Income</span>
                            <span class="info-box-number">{{ $sponserIncome }} </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="{{ url('admin/global_rebirth') }}">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-primary"><i class="fas fa-sync-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Regain Income</span>
                            <span class="info-box-number">{{ $rebirthIncome }} </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{ url('admin/upline_spornser') }}">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-success"><i class="fas fa-sitemap"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Upline Income</span>
                            <span class="info-box-number">{{ $uplineIncome }} </span>
                        </div>
                    </div>
                </a>
            </div>

            @if(auth()->user()->id == 1)
            <div class="col-md-3 col-sm-6">
                <a href="{{ url('admin/admin_payment') }}">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-dark"><i class="fas fa-user-shield"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Service Activities</span>
                            <span class="info-box-number">{{ $totalAdminAmount }} </span>
                        </div>
                    </div>
                </a>
            </div>
            @endif
            <div class="col-md-3 col-sm-6">
                <a href="{{ url('admin/withdrawal') }}/1">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-danger"><i class="fas fa-hand-holding-usd"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Withdrawal Request</span>
                            <span class="info-box-number">{{ $Withdrawal }} </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection