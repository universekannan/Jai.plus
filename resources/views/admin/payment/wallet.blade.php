@extends('admin.layouts.app')
@section('admin/content')
@php

    $date = $from ?? date('Y-m-01');
    $to = $to ?? date('Y-m-d');
@endphp


    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>
            <!-- Optional withdrawal button -->
            <!--
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addwithdrawal">
                <i class="fa fa-plus"></i> Withdrawal
            </button>
            -->
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Wallet Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Wallet</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead class="thead">
                                <tr>
                                    <th>#</th>
                                    <th>Income Name</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td>1</td>
                                    <td>Sponsor Income</td>
                                    <td>{{ date('d-m-Y') }}</td>
                                    <td>{{ $sponserIncome }} </td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#paymentModal1">
                                            <i class="fa fa-arrow-right"></i> Move to Wallet
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Withdrawal Available Amount</td>
                                    <td>{{ date('d-m-Y') }}</td>
                                    <td>{{ Auth::user()->wallet }} </td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addwithdrawal">
                                            <i class="fa fa-wallet"></i> Withdraw
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

           

            <!-- Sponsor Income Modal -->
            <div class="modal fade" id="paymentModal1" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <form action="{{ route('updatewallet_sponser') }}" method="POST">
                            @csrf
                            <div class="modal-header bg-info">
                                <h5 class="modal-title" id="paymentModalLabel1">Confirm Transfer</h5>
                                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body text-center">
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="amount" value="{{ $sponserIncome }}">
                                <p>Are you sure you want to transfer <b>{{ $sponserIncome }} </b> to your wallet?</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Yes, Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Withdrawal Modal -->
            <div class="modal fade" id="addwithdrawal" tabindex="-1" role="dialog" aria-labelledby="addWithdrawalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <form action="{{ url('/addwithdrawal') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h4 class="modal-title" id="addWithdrawalLabel">Withdrawal Request</h4>
                                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="wallet" class="col-sm-4 col-form-label">Wallet Amount</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="wallet" id="wallet" value="{{ Auth::user()->wallet }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="withdrawal_amount" class="col-sm-4 col-form-label">Withdrawal Amount</label>
                                    <div class="col-sm-8">
                                        <input required type="number" class="form-control" name="withdrawal_amount" id="withdrawal_amount" placeholder="Enter amount">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="new_balance" class="col-sm-4 col-form-label">Balance After Withdrawal</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="new_balance" id="new_balance" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="message" class="col-sm-4 col-form-label">Message</label>
                                    <div class="col-sm-8">
                                        <textarea required class="form-control" name="message" id="message" rows="3" placeholder="Enter message"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input class="btn btn-primary" type="submit" value="Request Withdrawal" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>


<!-- JS Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $("#withdrawal_amount").on("keyup change", function() {
        let wallet = parseFloat($("#wallet").val()) || 0;
        let withdrawal = parseFloat($(this).val()) || 0;
        let balance = wallet - withdrawal;
        if (balance < 0) balance = 0;
        $("#new_balance").val(balance);
    });
</script>
@endsection

