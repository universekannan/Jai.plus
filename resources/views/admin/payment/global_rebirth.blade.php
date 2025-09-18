@extends('admin.layouts.app')

@section('admin/content')

<section class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Regain Income</h4>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach($Userplans as $Userplan)
            <div class="col-lg-3 col-6">
                <!-- Small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h4>{{ $Userplan->plan_amount }}</h4>
                        <p>{{ $Userplan->plan_name }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#modal-xl{{ $Userplan->id }}" class="small-box-footer">
                        View Details <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="modal fade" id="modal-xl{{ $Userplan->id }}">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title">
                                {{ $Userplan->plan_name }} - Regain Income
                            </h4>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Full Name</th>
                                        <th>User Name</th>
                                        <th>Income </th>
                                        <th>Package Amount </th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $getFTdata = DB::table('global_regain')
                                    ->select('users.name','users.user_name','global_regain.amount',
                                    'global_regain.created_at','global_regain.plan_id',
                                    'global_regain.to_id')
                                    ->join('users','users.id','=','global_regain.from_id')
                                    ->where('global_regain.pay_reason_id', 2)
                                    ->where('global_regain.from_id', auth()->user()->id)
                                    ->where('global_regain.to_id','!=', 1)
                                    ->where('global_regain.plan_id', $Userplan->id)
                                    ->get();
                                    @endphp

                                    @foreach ($getFTdata as $key => $data)
                                    @php
                                    $plan = DB::table('plans')->where('id',$data->plan_id)->first();
                                    $user = DB::table('users')->where('id',$data->to_id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->user_name }}</td>
                                        <td>{{ $data->amount }}</td>
                                        <td>{{ $plan->plan_amount }}</td>
                                        <td>{{ date('d M Y h:i A', strtotime($data->created_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</section>
@endsection

