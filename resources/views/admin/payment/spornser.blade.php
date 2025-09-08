@extends('admin.layouts.app')

@section('admin/content')
<section class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>
        <h6 class="mb-0">Sponsor Income</h6>
    </div>
</section>

<!-- Content -->
<section class="content">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('sponserlist') }}" class="form-inline">
                    <div class="form-group mr-2">
                        <label for="from" class="mr-2">From:</label>
                        <input type="date" class="form-control" id="from" name="from" value="{{ $from }}">
                    </div>
                    <div class="form-group mr-2">
                        <label for="to" class="mr-2">To:</label>
                        <input type="date" class="form-control" id="to" name="to" value="{{ $to }}">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0"><i class="fas fa-user-friends"></i> Sponsor Income List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>From ID</th>
                                <th>From Name</th>
                                <th>Sponsor Amount 50% </th>
                                <th>Package Amount </th>
                                <th>Reason</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($spornsers as $key => $spornser)
                            <tr>
                                <td>{{ ($spornsers->currentPage() - 1) * $spornsers->perPage() + $key + 1 }}</td>
                                <td>{{ $spornser->from_username }}</td>
                                <td>{{ $spornser->from_name }}</td>
                                <td>{{ $spornser->amount }} </td>
                                <td>{{ $spornser->plan_amount }} </td>
                                <td>{{ $spornser->reason_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($spornser->created_at)->format('d-m-Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('page_scripts')
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

