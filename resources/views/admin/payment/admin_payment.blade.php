@extends('admin.layouts.app')
@section('admin/content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Admin Payment</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-sponsor" data-toggle="pill" href="#sponsor" role="tab"
                            aria-controls="sponsor" aria-selected="true">
                            Sponsor Income (5%)
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-global" data-toggle="pill" href="#global" role="tab"
                            aria-controls="global" aria-selected="false">
                            Global Regain Income
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-upline" data-toggle="pill" href="#upline" role="tab"
                            aria-controls="upline" aria-selected="false">
                            Upline Income (20%)
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">

                    <!-- Sponsor Tab -->
                    <div class="tab-pane fade show active" id="sponsor" role="tabpanel" aria-labelledby="tab-sponsor">
                        <div class="table-responsive">
                            <table id="table-sponsor" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>From</th>
                                        <th>From Name</th>
                                        <th>Income ($)</th>
                                        <th>Package Amount ($)</th>
                                        <th>Reason</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sponserQuery as $key => $spornser)
                                    @php $plan = DB::table('plans')->where('id',$spornser->plan_id)->first(); @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $spornser->from_username }}</td>
                                        <td>{{ $spornser->name }}</td>
                                        <td>{{ $spornser->amount }} $</td>
                                        <td>{{ $plan->plan_amount }} $</td>
                                        <td>{{ $spornser->reasonname }}</td>
                                        <td>{{ $spornser->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Global Regain Tab -->
                    <div class="tab-pane fade" id="global" role="tabpanel" aria-labelledby="tab-global">
                        <div class="table-responsive">
                            <table id="table-global" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>From</th>
                                        <th>From Name</th>
                                        <th>Income ($)</th>
                                        <th>Package Amount ($)</th>
                                        <th>Reason</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($globalQuery as $key => $global)
                                    @php $plan = DB::table('plans')->where('id',$global->plan_id)->first(); @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $global->from_username }}</td>
                                        <td>{{ $global->to_username }}</td>
                                        <td>{{ $global->amount }} $</td>
                                        <td>{{ $plan->plan_amount }} $</td>
                                        <td>{{ $global->reasonname }}</td>
                                        <td>{{ $global->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Upline Tab -->
                    <div class="tab-pane fade" id="upline" role="tabpanel">
                        <div class="table-responsive">
                            <table id="table-upline" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>From</th>
                                        <th>From Name</th>
                                        <th>Income ($)</th>
                                        <th>Package Amount ($)</th>
                                        <th>Reason</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($uplineQuery as $key => $upline)
                                    @php $plan = DB::table('plans')->where('id',$upline->plan_id)->first(); @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $upline->from_username }}</td>
                                        <td>{{ $upline->name }}</td>
                                        <td>{{ $upline->amount }} $</td>
                                        <td>{{ $plan->plan_amount }} $</td>
                                        <td>{{ $upline->reasonname }}</td>
                                        <td>{{ $upline->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
@push('scripts')
<script>
$(function() {
    $('#table-sponsor').DataTable();
    $('#table-global').DataTable();
    $('#table-upline').DataTable();
});
</script>
@endpush

@endsection