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
                        <span class="info-box-icon bg-info">
                            <i class="fas fa-rupee-sign"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Direct Referral Income</span>
                            <span class="info-box-number">{{ $sponserIncome }}</span>
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
            <div class="modal fade" id="rebirthIncome" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white">Global Rebirth Income</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Amount ($)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Upgrade</td>
                                            <td><strong>{{ $GRUpgrade }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Admin</td>
                                            <td><strong>{{ $GRAdmin }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="bg-light text-right"><strong>Total</strong></td>
                                            <td class="bg-light"><strong>{{ $GRTotal }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <a href="{{ url('admin/global_rebirth') }}" class="btn btn-primary">Read More</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
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