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
        <div class="row row-cols-7 g-1">
            @foreach ($plans as $plan)
            @php
            if (in_array($plan->id, $userPlans)) {
            $colorClass = 'bg-info ';
            } elseif ($plan->id == $nextPlanId) {
            $colorClass = 'bg-warning text-dark';
            } else {
            $colorClass = 'bg-gray ';
            }
            @endphp
            <div class="col">
                <div class="card rounded-2 {{ $colorClass }} mini-plan-card">
                    <div class="card-body p-1">
                        <div class="text-center">
                            <div class="plan-name">{{ Str::limit($plan->plan_name, 8) }}</div>
                            <div class="plan-amount">{{ $plan->plan_amount }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>



        <div class="row">
            <div class="col-md-3 col-sm-6">
                <a href="{{ url('admin/members/1') }}">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-primary"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Active Members</span>
                            <span class="info-box-number">{{ $ActiveMembers }}</span>
                            <small>{{ $LastWeekActiveMembers }} from last week</small>
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
                            <small>{{ $LastWeekInactiveMembers }} from last week</small>
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
                            <small>Remaining ({{ $remainingPlansCount }})</small>
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
                            <small>{{ $LastWeekwalletIncome }}  from last week</small>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="{{ url('admin/spornser') }}">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-info"><i class="fas fa-dollar-sign"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Sponsor Income (50%)</span>
                            <span class="info-box-number">{{ $sponserIncome }} </span>
                            <small>{{ $LastWeeksponserIncome }}  from last week</small>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="{{ url('admin/upgrade') }}">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-secondary"><i class="fas fa-level-up-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Upgrade Package</span>
                            <span class="info-box-number">{{ Auth::user()->upgrade ?? 0 }} </span>
                            <small>Upgrade Amount</small>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="#" data-toggle="modal" data-target="#rebirthIncome">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-primary"><i class="fas fa-sync-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Global Rebirth</span>
                            <span class="info-box-number">{{ $rebirthIncome }} </span>
                            <small>{{ $LastWeekrebirthIncome }} Global Regain User</small>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="#" data-toggle="modal" data-target="#uplineIncome">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-success"><i class="fas fa-sitemap"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total 7 Upline Sponsor Income</span>
                            <span class="info-box-number">{{ $uplineIncome }} </span>
                            <small>{{ $LastWeekInuplineIncome }}  from last week</small>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="{{ url('admin/withdrawal') }}/1">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-danger"><i class="fas fa-hand-holding-usd"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Withdrawal Request</span>
                            <span class="info-box-number">{{ $Withdrawal }} </span>
                            <small>{{ $LastWeekWithdrawal }} from last week</small>
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
                            <span class="info-box-text">Total Admin Amount</span>
                            <span class="info-box-number">{{ $totalAdminAmount }} </span>
                        </div>
                    </div>
                </a>
            </div>
            @endif
        </div>


    </div>
</div>

@endsection