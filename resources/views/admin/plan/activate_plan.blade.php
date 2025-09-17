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
                                    <i class="fas fa-rupee-sign"></i>
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

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pay with QR Code</h5>
                <button type="button" class="btn-close" data-dismiss="modal">X</button>
            </div>
            <div class="modal-body text-center">
            <p><strong>Name:</strong> <span>Women Holistic Empowerment Trust</span></p>
                <p><strong>Account Number:</strong> <span>612405019943</span></p>  
                <p><strong>Bank:</strong> <span>ICICI</span></p>
                <p><strong>Branch:</strong> <span>Sivagangai</span></p>
                <p><strong>IFSC Code:</strong> <span>ICIC0006124</span></p>
                
                <p><strong>Payable Amount:</strong> <span id="payAmount"></span></p>
                <div id="qrCodeBox">
                    <img id="qrCodeImage" src="" alt="QR Code" style="width:200px;height:200px;">
                </div>
                <br>
                <div class="mb-3">
                    <label for="paymentProof" class="form-label">Upload Payment Proof</label>
                    <input type="file" class="form-control" id="paymentProof" accept="image/*">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitPayment">Submit</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).on("click", ".activate-plan", function(e) {
    e.preventDefault();

    const planId = $(this).data("planid");
    const amount = parseFloat($(this).data("amount"));
    const userId = $(this).data("userid");
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
        // Save planId & userId into modal
        $("#paymentModal").data("planid", planId);
        $("#paymentModal").data("userid", userId);
        $("#paymentModal").data("amount", amount);

        // Show modal with QR code + amount
        $("#payAmount").text(amount.toFixed(2) + " INR");
        $("#qrCodeImage").attr("src", "{{ asset('qr.png') }}");
        $("#paymentModal").modal("show");

        // Handle submit
        $("#submitPayment").off("click").on("click", function() {
            const formData = new FormData();
            formData.append("plan_id", $("#paymentModal").data("planid"));
            formData.append("user_id", $("#paymentModal").data("userid"));
            formData.append("amount", $("#paymentModal").data("amount"));
            formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

            const file = $("#paymentProof")[0].files[0];
            if (file) {
                formData.append("image", file);
            }

            $.ajax({
                url: "{{ url('admin/plan_payment_request') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        alert("Payment request submitted successfully!");
                        $("#paymentModal").modal("hide");
                        window.location.reload();
                    } else {
                        alert("Error: " + data.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert("An error occurred while submitting payment request.");
                }
            });
        });
    }
});
</script>



@endsection