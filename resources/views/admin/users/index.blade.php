@extends('admin.layouts.app')
@section('admin/content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-flex align-items-center justify-content-between mb-3">
            <div class="mb-0">
                <h6>All Users List</h6>
            </div>
            <button type="button" class="btn btn-sm btn-secondary float-right" data-toggle="modal"
                data-target="#addcenter"><i class="fa fa-plus"> </i> Add Users</button>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>User ID</th>
                                        <th>Email</th>
                                        <th>Mobile No</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $centerslist)
                                    <tr>
                                        <td>{{ $centerslist->name }}</td>
                                        <td>{{ $centerslist->user_name }}</td>
                                        <td>{{ $centerslist->email }}</td>
                                        <td>{{ $centerslist->phone }}</td>
                                        @if ($centerslist->status == 1)
                                        <td>Active</td>
                                        @else
                                        <td>Inactive</td>
                                        @endif
                                        <td width="10%" style="white-space: nowrap">
                                            <a onclick="edit_center('{{ $centerslist->id }}','{{ $centerslist->name }}','{{ $centerslist->email }}','{{ $centerslist->phone }}','{{ $centerslist->status }}')"
                                                href="#" class="btn btn-light editmemberBtn"><i class="bx bx-edit"></i>
                                            </a>
                                            <a onclick="return confirm('Do you want to Confirm delete operation?')"
                                                href="{{ url('/deletecenterslist', $centerslist->id) }}"
                                                class="btn btn-danger btn-sm deletememberBtn"><i
                                                    class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="addcenter">
                        <form action="{{ url('/addcenters') }}" method="post">
                            {{ csrf_field() }}
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add User list</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row mb-3">
                                                    <label for="name" class="col-sm-4 col-form-label"><span
                                                            style="color:red">*</span>Full Name</label>
                                                    <div class="col-sm-8">
                                                        <input required="required" type="text" class="form-control"
                                                            name="name" maxlength="50" placeholder="Full Name">
                                                    </div>
                                                </div>

                                                <div class="form-group row  mb-3">
                                                    <label for="email" class="col-sm-4 col-form-label"><span
                                                            style="color:red">*</span>Email</label>
                                                    <div class="col-sm-8">
                                                        <input required="required" type="email" class="form-control"
                                                            name="email" maxlength="30" placeholder="Email">
                                                    </div>
                                                </div>

                                                <div class="form-group row  mb-3">
                                                    <label for="password" class="col-sm-4 col-form-label"><span
                                                            style="color:red">*</span>Password</label>
                                                    <div class="col-sm-8">
                                                        <input required="required" type="password" class="form-control"
                                                            name="password" maxlength="20" placeholder="Password">
                                                    </div>
                                                </div>

                                                <div class="form-group row  mb-3">
                                                    <label for="mobile" class="col-sm-4 col-form-label"><span
                                                            style="color:red">*</span>Mobile No</label>
                                                    <div class="col-sm-8">
                                                        <input required="required" type="text" class="form-control"
                                                            name="mobile" maxlength="20" placeholder="Mobile Number">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <input class="btn btn-primary" type="submit" value="Submit" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal fade" id="editcenters" tabindex="-1" aria-hidden="true">
                        <form action="{{ url('/updatecenter') }}" method="post">
                            {{ csrf_field() }}
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollable">Edit centerslist</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row mb-3">
                                                    <input type="hidden" name="user_id" id="user_id">
                                                    <label for="name" class="col-sm-4 col-form-label"><span
                                                            style="color:red">*</span>Full Name</label>
                                                    <div class="col-sm-8">
                                                        <input required="required" type="text" class="form-control"
                                                            name="name" maxlength="50" placeholder="Full Name"
                                                            id="centerslistname">
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label for="email" class="col-sm-4 col-form-label"><span
                                                            style="color:red">*</span>Email</label>
                                                    <div class="col-sm-8">
                                                        <input required="required" type="email" class="form-control"
                                                            name="email" maxlength="30" placeholder="Email"
                                                            id="centerslistemail">
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label for="phone" class="col-sm-4 col-form-label"><span
                                                            style="color:red">*</span>Mobile No</label>
                                                    <div class="col-sm-8">
                                                        <input required="required" type="text" class="form-control"
                                                            name="mobile" maxlength="20" placeholder="Mobile Number"
                                                            id="centerslistmobile">
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label for="email" class="col-sm-4 col-form-label"><span
                                                            style="color:red">*</span>Status</label>
                                                    <div class="col-sm-8">
                                                        <select id="editstatus" name="status" class="form-control">
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                            <input class="btn btn-primary" type="submit" value="Submit" />
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
<script>
function edit_center(id, name, email, mobile, status) {
    $("#centerslistname").val(name);
    $("#centerslistemail").val(email);
    $("#centerslistmobile").val(mobile);
    $("#editstatus").val(status);
    $('#user_id').val(id);
    $("#editcenters").modal("show");
}
</script>
@endsection