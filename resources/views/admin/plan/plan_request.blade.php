@extends('admin.layouts.app')

@section('admin/content')


<!-- Page Header -->
<section class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>
        <!-- Optional Button -->
        <!--
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addwithdrawal">
                <i class="fa fa-plus"></i> New Withdrawal
            </button>
            -->
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">

        <!-- Withdrawal Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Plan Activation Request </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>From</th>
                                <th>Amount</th>
                                @if(auth()->user()->user_type_id == 1)
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($withdrawal as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->from_name }}</td>
                                <td>{{ $item->withdrawal_amount }}</td>
                                @if(auth()->user()->user_type_id == 1)
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"
                                        onclick="update_plan_request('{{ $item->id }}','{{ $item->withdrawal_amount }}','{{ $item->status }}')">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No withdrawals found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Update Withdrawal Modal -->
        <div class="modal fade" id="update_plan_activation_request" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <form action="{{ url('/update_plan_activation_request') }}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title">Update Withdrawal</h5>
                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="withdrawal_id" id="withdrawal_id">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Withdrawal Amount</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="edit_withdrawal_amount" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    <select id="editstatus" name="status" class="form-control">
                                        <option value="1">Pending</option>
                                        <option value="2">Completed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function update_plan_request(id, withdrawal_amount, status) {
    $("#edit_withdrawal_amount").val(withdrawal_amount);
    $("#editstatus").val(status);
    $('#withdrawal_id').val(id);
    $("#update_plan_activation_request").modal("show");
}
</script>
@endsection