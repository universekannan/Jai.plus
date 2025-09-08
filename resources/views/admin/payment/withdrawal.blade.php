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
                    <h3 class="card-title">Withdrawals</h3>
                </div>
                <div class="card-body">

                    <!-- Filter + Search -->
                    <form method="GET" action="{{ url()->current() }}">
                        <div class="row mb-3">
                            <div class="col-md-1">
                                <select class="form-control" name="pageper" onchange="this.form.submit()">
                                    <option value="25" {{ request('pageper') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('pageper') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('pageper') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </div>
                            <div class="col-md-3 offset-md-8">
                                <div class="input-group">
                                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search...">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Go</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Withdrawals Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead class="thead">
                                <tr>
                                    <th>#</th>
                                    <th>From</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
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
                                        <td>
                                            @if ($item->status == 1)
                                                Pending
                                            @else
                                                Completed
                                            @endif
                                        </td>
                                        @if(auth()->user()->user_type_id == 1)
                                            <td>
                                                <a href="#" class="btn btn-sm btn-info"
                                                   onclick="update_withdrawal('{{ $item->id }}','{{ $item->withdrawal_amount }}','{{ $item->status }}')">
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

                    <!-- Pagination -->
                    <div class="mt-2">
                        {!! $withdrawal->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>

            <!-- Add Withdrawal Modal -->
            <div class="modal fade" id="addwithdrawal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form action="{{ url('/addwithdrawal') }}" method="post">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title">Request Withdrawal</h4>
                                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Wallet Amount</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="wallet" value="{{ Auth::user()->wallet }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Withdrawal Amount</label>
                                    <div class="col-sm-8">
                                        <input required type="number" class="form-control" name="withdrawal_amount" id="withdrawal_amount" placeholder="Enter withdrawal amount">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Balance After Withdrawal</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="new_balance" id="new_balance" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Message</label>
                                    <div class="col-sm-8">
                                        <textarea required class="form-control" name="message" rows="3" placeholder="Message"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Submit Request">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Withdrawal Modal -->
            <div class="modal fade" id="updatewithdrawal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <form action="{{ url('/updatewithdrawal') }}" method="post">
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
$(document).on('input', '#withdrawal_amount', function() {
    let wallet = parseFloat($('#wallet').val()) || 0;
    let withdrawal = parseFloat($(this).val()) || 0;
    let balanceField = $('#new_balance');
    $('#withdrawal-error').remove();

    if (withdrawal > wallet) {
        $(this).after('<small id="withdrawal-error" class="text-danger">Insufficient balance</small>');
        balanceField.val('0.00');
    } else {
        let balance = wallet - withdrawal;
        balanceField.val(balance.toFixed(2));
    }
});

function update_withdrawal(id, withdrawal_amount, status) {
    $("#edit_withdrawal_amount").val(withdrawal_amount);
    $("#editstatus").val(status);
    $('#withdrawal_id').val(id);
    $("#updatewithdrawal").modal("show");
}
</script>
@endsection
