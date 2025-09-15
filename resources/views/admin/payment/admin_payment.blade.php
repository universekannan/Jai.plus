@extends('admin.layouts.app')

@section('admin/content')

<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Admin Payment</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>From</th>
                                <th>From Name</th>
                                <th>Income ($)</th>
                                <th>Package Amount ($)</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($adminQuery as $key => $admin)
                            @php $plan = DB::table('plans')->where('id',$admin->plan_id)->first(); @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $admin->from_username }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->amount }} $</td>
                                <td>{{ $plan->plan_amount }} $</td>
                                <td>{{ $admin->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
$(function() {
    $('#example2').DataTable({
        "paging": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true
    });
});
</script>
@endpush

@endsection