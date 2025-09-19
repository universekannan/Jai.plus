@extends('admin.layouts.app')
@section('admin/content')

<section class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>
        <h6 class="mb-0">Total Members
        </h6>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div id="membersTable">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>User ID</th>
                                    <th>User Phone</th>
                                    @if(auth()->user()->id == 1)
                                    <th>Reference Name</th>
                                    <th>Reference ID</th>
                                    <th>Reference Phone</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $key => $member)
                                @php
                                $referral = DB::table('users')->where('id', $member->referral_id)->first();
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->user_name }}</td>
                                    <td>{{ $member->phone }}</td>

                                    @if(auth()->user()->id == 1)
                                    <td>{{ $referral->name ?? 'Admin' }}</td>
                                    <td>{{ $referral->user_name ?? 'Admin' }}</td>
                                    <td>{{ $referral->phone ?? 'Admin' }}</td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@push('page_scripts')
@endpush