@extends('admin.layouts.app')

@section('admin/content')

@php
$date = $from ?? date('Y-m-01');
$to = $to ?? date('Y-m-d');
@endphp

<div class="page-wrapper">
    <div class="page-content">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Upline Sponsor</h4>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">

                        <thead class="thead-dark">
                            <tr>
                                <th>LEVEL NO</th>
                                @foreach ($plans as $planlt)
                                <th>{{ $planlt->plan_name }}</th>

                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plans as $planli)
                            <tr>
                                <td>Level {{ $planli->id }}</td>

                                @foreach ($plans as $planCheck)
                                @php
                                $ftIncome = DB::table('upline_income')
                                ->where('to_id', Auth::id())
                                ->where('pay_reason_id', 4)
                                ->where('plan_id', $planCheck->id)
                                ->count();
                                @endphp

                                <td>
                                    @if ($planli->id == $planCheck->id)
                                    <b>{{ $ftIncome }}</b>

                                    @if ($ftIncome > 0)
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#modal-xl{{ $planCheck->id }}">
                                        <i class="fas fa-eye"></i> View
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-xl{{ $planCheck->id }}" tabindex="-1"
                                        role="dialog">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">{{ $planCheck->plan_name }} Upline Income
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>S No</th>
                                                                <th>Full Name</th>
                                                                <th>User Name</th>
                                                                <th>Income ($)</th>
                                                                <th>Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $getFTdata = DB::table('upline_income')
                                                            ->select('upline_income.from_id','upline_income.amount','upline_income.created_at')
                                                            ->where('upline_income.pay_reason_id', 4)
                                                            ->where('upline_income.to_id', Auth::id())
                                                            ->where('upline_income.plan_id', $planCheck->id)
                                                            ->get();
                                                            $j = 1;
                                                            @endphp

                                                            @foreach ($getFTdata as $data)
                                                            @php
                                                            $userData = DB::table('users')
                                                            ->select('name','user_name')
                                                            ->where('id',$data->from_id)
                                                            ->first();
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $j++ }}</td>
                                                                <td>{{ $userData->name ?? '-' }}</td>
                                                                <td>{{ $userData->user_name ?? '-' }}</td>
                                                                <td>{{ $data->amount }} $</td>
                                                                <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i') }}
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @else
                                    0
                                    @endif
                                </td>
                                @endforeach
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection