@extends('admin.layouts.app')

@section('admin/content')

<section class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <h3>Plan Activation Request </h3>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>User Id</th>
                                <th>Plan Amount</th>
                                @if(auth()->user()->user_type_id == 1)
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($plan_payment_request as $key => $item)
                            @php
                            $plan = DB::table('plans')->where('id',$item->plan_id)->first();
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->from_name }}</td>
                                <td>{{ $item->user_name }}</td>
                                <td>{{ $plan->plan_amount ?? '-' }} </td>
                                @if(auth()->user()->user_type_id == 1)
                                <td>
                                    <a href="#" class="btn btn-sm btn-info" onclick="update_plan_request(
                                        '{{ $item->id }}',
                                        '{{ $item->image ? asset($item->image) : '' }}',
                                        '{{ $item->status }}',
                                        '{{ $item->from_name }}',
                                        '{{ $item->user_name }}',
                                        '{{ $plan->plan_amount ?? '-' }}'
                                    )"><i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No Request found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="update_plan_activation_request" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <form action="{{ url('/update_plan_activation_request') }}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title">Update Plan Activation Request</h5>
                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="plan_request_id" id="plan_request_id">

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">From Name</label>
                                <div class="col-sm-8">
                                    <input type="text" id="edit_from_name" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">User Id</label>
                                <div class="col-sm-8">
                                    <input type="text" id="edit_user_name" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Plan Amount</label>
                                <div class="col-sm-8">
                                    <input type="text" id="edit_plan_amount" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Payment Proof</label>
                                <div class="col-sm-8">
                                    <img id="edit_withdrawal_image" src="" alt="Proof Image"
                                        class="img-fluid rounded border"
                                        style="max-height: 200px; display:none; cursor:pointer;"
                                        onclick="window.open(this.src, '_blank')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    <select id="editstatus" name="status" class="form-control">
                                        <option value="0">Plan Request</option>
                                        <option value="1">Plan Activate</option>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function update_plan_request(id, image, status, from_name, user_name, plan_amount) {
    $("#editstatus").val(status);
    $('#plan_request_id').val(id);
    $('#edit_from_name').val(from_name);
    $('#edit_user_name').val(user_name);
    $('#edit_plan_amount').val(plan_amount);

    if (image) {
        $("#edit_withdrawal_image").attr("src", image).show();
    } else {
        $("#edit_withdrawal_image").hide();
    }

    $("#update_plan_activation_request").modal("show");
}
</script>
@endsection