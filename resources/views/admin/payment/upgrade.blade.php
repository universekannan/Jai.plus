@extends('admin.layouts.app')

@section('admin/content')
<section class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Upgrade</h4>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#sponsor" role="tab">
                            <i class="fas fa-user-friends mr-1"></i> Sponsor Income (5%)
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#global" role="tab">
                            <i class="fas fa-globe mr-1"></i> Global Regain Income
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#upline" role="tab">
                            <i class="fas fa-level-up-alt mr-1"></i> Upline Income (10%)
                        </a>
                    </li>
                </ul>

                <div class="tab-content py-3">

                    {{-- Sponsor Income --}}
                    <div class="tab-pane fade show active" id="sponsor" role="tabpanel">
                        <div class="table-responsive">
                            <table id="table-sponsor" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>From</th>
                                        <th>From Name</th>
                                        <th>Income </th>
                                        <th>Package Amount </th>
                                        <th>Reason</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sponserQuery as $key => $spornser)
                                    @php
                                    $plan = DB::table('plans')->where('id',$spornser->plan_id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $spornser->from_username }}</td>
                                        <td>{{ $spornser->name }}</td>
                                        <td>{{ $spornser->amount }} </td>
                                        <td>{{ $plan->plan_amount ?? '-' }} </td>
                                        <td>{{ $spornser->reasonname }}</td>
                                        <td>{{ \Carbon\Carbon::parse($spornser->created_at)->format('d-m-Y H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    @php
                                    $sumamount = DB::table('sponser_income')
                                    ->where('pay_reason_id', 4)
                                    ->where('to_id', auth()->user()->id)
                                    ->sum('amount');
                                    @endphp
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Total Income </strong></td>
                                        <td><strong>{{ $sumamount }} </strong></td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                   
                    <div class="tab-pane fade" id="upline" role="tabpanel">
                        <div class="table-responsive">
                            <table id="table-upline" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>From</th>
                                        <th>From Name</th>
                                        <th>Income </th>
                                        <th>Package Amount </th>
                                        <th>Reason</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($uplineQuery as $key => $upline)
                                    @php
                                    $plan = DB::table('plans')->where('id',$upline->plan_id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $upline->from_username }}</td>
                                        <td>{{ $upline->name }}</td>
                                        <td>{{ $upline->amount }} </td>
                                        <td>{{ $plan->plan_amount ?? '-' }} </td>
                                        <td>{{ $upline->reasonname }}</td>
                                        <td>{{ \Carbon\Carbon::parse($upline->created_at)->format('d-m-Y H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    @php
                                    $sumuplineamount = DB::table('upline_income')
                                    ->where('pay_reason_id', 3)
                                    ->where('to_id', auth()->user()->id)
                                    ->sum('amount');
                                    @endphp
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Total Income </strong></td>
                                        <td><strong>{{ $sumuplineamount }} </strong></td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="global" role="tabpanel">
                        <div class="table-responsive">
                            <table id="table-global" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>From</th>
                                        <th>Income </th>
                                        <th>Package Amount </th>
                                        <th>Reason</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($globalQuery as $key => $global)
                                    @php
                                    $plan = DB::table('plans')->where('id',$global->plan_id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $global->from_username }}</td>
                                        <td>{{ $global->amount }} </td>
                                        <td>{{ $plan->plan_amount ?? '-' }} </td>
                                        <td>{{ $global->reasonname }}</td>
                                        <td>{{ \Carbon\Carbon::parse($global->created_at)->format('d-m-Y H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    @php
                                    $sumrebirthamount = DB::table('global_regain')
                                    ->where('pay_reason_id', 4)
                                    ->where('to_id', auth()->user()->id)
                                    ->sum('amount');
                                    @endphp
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Total Income </strong></td>
                                        <td><strong>{{ $sumrebirthamount }} </strong></td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@push('page_scripts')
<script>
$(function() {
    $('#table-sponsor').DataTable();
    $('#table-upline').DataTable();
    $('#table-global').DataTable();
});
</script>
@endpush

