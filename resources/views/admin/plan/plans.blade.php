@extends('admin.layouts.app')
@section('admin/content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-flex align-items-center justify-content-between mb-3">
            <div class="mb-0 text-uppercase">
                <h6>Plans</h6>
            </div>
            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#addplan">
                <i class="fa fa-plus"></i> Add Plan
            </button>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissable" style="margin: 15px;">
                            <a href="#" style="color:white !important" class="close" data-dismiss="alert"
                                aria-label="close">&times;</a>
                            <strong> {{ session('success') }} </strong>
                        </div>
                        @endif

                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Plan Name</th>
                                        <th>Plan Amount</th>
                                        <th>Sponsor Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plan as $centerslist)
                                    <tr>
                                        <td>{{ $centerslist->id }}</td>
                                        <td>{{ $centerslist->plan_name }}</td>
                                        <td>{{ $centerslist->plan_amount }}</td>
                                        <td>{{ $centerslist->sponser_amount }}</td>
                                        <td>
                                            @if ($centerslist->status == 1)
                                            Active
                                            @else
                                            Inactive
                                            @endif
                                        </td>
                                        <td width="10%" style="white-space: nowrap">
                                            <a onclick="edit_plan('{{ $centerslist->id }}','{{ addslashes($centerslist->plan_name) }}','{{ $centerslist->plan_amount }}',
                                            '{{ $centerslist->sponser_amount }}','{{ $centerslist->upline_amount }}','{{ $centerslist->regain_amount }}','{{ $centerslist->service_amount }}',
                                            '{{ $centerslist->status }}')" href="#" title="Edit Plan"
                                                class="btn btn-success" data-toggle="modal" data-target="#editplan">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="modal fade" id="addplan" tabindex="-1" role="dialog" aria-labelledby="addplanLabel"
                            aria-hidden="true">
                            <form action="{{ url('/addplan') }}" method="post">
                                {{ csrf_field() }}
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h4 class="modal-title" id="addplanLabel">Add Plan</h4>
                                            <button type="button" class="close text-white" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="plan_name_add" class="form-label"><span
                                                                style="color:red">*</span> Plan Name</label>
                                                        <input required type="text" class="form-control"
                                                            name="plan_name" id="plan_name_add" placeholder="Plan Name">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="plan_amount_add" class="form-label"><span
                                                                style="color:red">*</span> Plan Amount </label>
                                                        <input required type="number" class="form-control"
                                                            name="plan_amount" id="plan_amount_add"
                                                            placeholder="Plan Amount">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="sponser_amount_add" class="form-label"><span
                                                                style="color:red">*</span> Sponsor Amount (%)</label>
                                                        <input required type="number" class="form-control"
                                                            name="sponser_amount" id="sponser_amount_add"
                                                            placeholder="Sponsor Amount %">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="upline_amount_add" class="form-label"><span
                                                                style="color:red">*</span> Upline Amount (%)</label>
                                                        <input required type="number" class="form-control"
                                                            name="upline_amount" id="upline_amount_add"
                                                            placeholder="Upline Amount %">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="regain_amount_add" class="form-label"><span
                                                                style="color:red">*</span> Global Rebirth Amount
                                                            (%)</label>
                                                        <input required type="number" class="form-control"
                                                            name="regain_amount" id="regain_amount_add"
                                                            placeholder="Global Rebirth Amount %">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="service_amount_add" class="form-label"><span
                                                                style="color:red">*</span> Service Amount
                                                            (%)</label>
                                                        <input required type="number" class="form-control"
                                                            name="service_amount" id="service_amount_add"
                                                            placeholder="Service Amount %">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <input class="btn btn-primary" type="submit" value="Submit" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="modal fade" id="editplan" tabindex="-1" role="dialog"
                            aria-labelledby="editplanLabel" aria-hidden="true">
                            <form action="{{ url('/editplan') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" id="edit_plan_id" />
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h4 class="modal-title" id="editplanLabel">Edit Plan</h4>
                                            <button type="button" class="close text-white" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="plan_name_edit" class="form-label"><span
                                                                style="color:red">*</span> Plan Name</label>
                                                        <input required type="text" class="form-control"
                                                            name="plan_name" id="plan_name_edit"
                                                            placeholder="Plan Name">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="plan_amount_edit" class="form-label"><span
                                                                style="color:red">*</span> Plan Amount </label>
                                                        <input required type="number" class="form-control"
                                                            name="plan_amount" id="plan_amount_edit"
                                                            placeholder="Plan Amount">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="sponser_amount_edit" class="form-label"><span
                                                                style="color:red">*</span> Sponsor Amount (%)</label>
                                                        <input required type="number" class="form-control"
                                                            name="sponser_amount" id="sponser_amount_edit"
                                                            placeholder="Sponsor Amount %">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="upline_amount_edit" class="form-label"><span
                                                                style="color:red">*</span> Upline Amount (%)</label>
                                                        <input required type="number" class="form-control"
                                                            name="upline_amount" id="upline_amount_edit"
                                                            placeholder="Upline Amount %">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="regain_amount_edit" class="form-label"><span
                                                                style="color:red">*</span> Global Rebirth Amount
                                                            (%)</label>
                                                        <input required type="number" class="form-control"
                                                            name="regain_amount" id="regain_amount_edit"
                                                            placeholder="Global Rebirth Amount %">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="service_amount_edit" class="form-label"><span
                                                                style="color:red">*</span> Service Amount
                                                            (%)</label>
                                                        <input required type="number" class="form-control"
                                                            name="service_amount" id="service_amount_edit"
                                                            placeholder="Global Rebirth Amount %">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="status_edit"
                                                            class="form-label"><strong>Status</strong></label>
                                                        <select class="form-control" id="status_edit" name="status"
                                                            required>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <input class="btn btn-primary" type="submit" value="Update" />
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
function edit_plan(id, plan_name, plan_amount, sponser_amount, upline_amount, regain_amount,service_amount, status) {
    $('#edit_plan_id').val(id);
    $('#plan_name_edit').val(plan_name);
    $('#plan_amount_edit').val(plan_amount);
    $('#sponser_amount_edit').val(sponser_amount);
    $('#upline_amount_edit').val(upline_amount);
    $('#regain_amount_edit').val(regain_amount);
    $('#service_amount_edit').val(service_amount);
    $('#status_edit').val(status);
    $('#editplan').modal('show');
}
</script>
@endsection