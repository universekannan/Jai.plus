@extends('admin.layouts.app')
@section('admin/content')
<div class="page-wrapper">
    <div class="page-content">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>

        <div class="page-breadcrumb d-flex align-items-center justify-content-between mb-3">
            <div class="mb-0 text-uppercase">
                <h6>Plan List</h6>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
            @foreach ($plans as $plan)
            @php
            if (in_array($plan->id, $userPlans)) {
            $colorClass = 'bg-info text-white';
            $statusText = 'Activated';
            $clickable = false;
            } elseif ($plan->id == $nextPlanId) {
            $colorClass = 'bg-warning text-dark';
            $statusText = 'Next to activate';
            $clickable = true;
            } else {
            $colorClass = 'bg-gray text-white';
            $statusText = 'Remaining plan';
            $clickable = false;
            }
            @endphp

            <a href="javascript:void(0);" @if($clickable) class="activate-plan" data-planid="{{ $plan->id }}"
                data-amount="{{ $plan->plan_amount }}" data-userid="{{ auth()->user()->id }}"
                data-upgradeamount="{{ auth()->user()->upgrade }}" @endif>
                <div class="col">
                    <div class="card radius-10 {{ $colorClass }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0">{{ $plan->plan_name }}</p>
                                    <h4 class="my-1">{{ $plan->plan_amount }} </h4>
                                    <p class="mb-0 font-13">{{ $statusText }}</p>
                                </div>
                                <div class="widgets-icons bg-light-transparent ms-auto">
                                    <i class="fas fa-trophy"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on("click", ".activate-plan", function(e) {
        e.preventDefault();
    
        const planId  = $(this).data("planid");
        const amount  = parseFloat($(this).data("amount"));
        const userId  = $(this).data("userid");
        const upgrade = parseFloat($(this).data("upgradeamount"));
    
        if (amount <= upgrade) {
            if (confirm("Are you sure you want to use your Upgrade Amount?")) {
                $.ajax({
                    url: "{{ url('admin/activate_plan_payment') }}",
                    type: "POST",
                    data: {
                        plan_id: planId,
                        amount: amount,
                        user_id: userId,
                        upgrade: upgrade,
                        upgrade_status: 1,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            alert("Plan Activated successfully!");
                            window.location.reload();
                        } else {
                            alert("Error saving plan");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert("An error occurred while saving the plan.");
                    }
                });
            }
        } else {
            // Show modal with QR code + amount
            $("#payAmount").text(amount.toFixed(2) + " INR");
            $("#qrCodeImage").attr("src", "/images/payment_qr.png");
            $("#paymentModal").modal("show");
    
            // Handle submit
            $("#submitPayment").off("click").on("click", function() {
                const formData = new FormData();
                formData.append("plan_id", planId);
                formData.append("amount", amount);
                formData.append("user_id", userId);
                formData.append("upgrade", upgrade);
                formData.append("upgrade_status", 0); // using QR payment
                formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
    
                const file = $("#paymentProof")[0].files[0];
                if (file) {
                    formData.append("payment_proof", file);
                }
    
                // $.ajax({
                //     url: "{{ url('admin/activate_plan_payment') }}",
                //     type: "POST",
                //     data: formData,
                //     processData: false,
                //     contentType: false,
                //     success: function(data) {
                //         if (data.success) {
                //             alert("Plan Activated successfully!");
                //             $("#paymentModal").modal("hide");
                //             window.location.reload();
                //         } else {
                //             alert("Error saving plan");
                //         }
                //     },
                //     error: function(xhr, status, error) {
                //         console.error(error);
                //         alert("An error occurred while saving the plan.");
                //     }
                // });
            });
        }
    });
    </script>
    

@endsection