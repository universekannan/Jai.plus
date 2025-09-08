@extends('admin.layouts.app')
@section('content')
<div class="page-wrapper">
	<div class="page-content">
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

                <a href="javascript:void(0);"
                @if($clickable)
                    class="activate-plan"
                    data-planid="{{ $plan->id }}"
                    data-amount="{{ $plan->plan_amount }}"
                    data-userid="{{ auth()->user()->id }}"
                    data-upgradeamount="{{ auth()->user()->upgrade ?? 0 }}"
                @endif
                >
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
                                        <i class="bx bxs-trophy"></i>
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

    const planId   = $(this).data("planid");
    const amount   = parseFloat($(this).data("amount"));
    const userId   = $(this).data("userid");
    const upgrade  = parseFloat($(this).data("upgradeamount"));

    // ✅ If upgrade amount matches plan amount → show confirmation
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
                        alert("Plan Activated successfully using Upgrade Amount!");
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
        // ✅ Else go to payment gateway (MetaMask / USDT flow)
        const dappUrl = `{{ url('admin/plan_payment') }}/${encodeURIComponent(planId)}/${encodeURIComponent(userId)}`;
        if (typeof window.ethereum === 'undefined') {
            window.location.href = `https://metamask.app.link/dapp/${dappUrl}`;
        } else {
            window.location.href = dappUrl;
        }
    }
});
</script>




    {{-- <script>
        async function sendUSDT(amount, planid, userid) {
            // ✅ Clean URL with slashes
            const dappUrl = `{{ url('admin/plan_payment') }}/${encodeURIComponent(planid)}/${encodeURIComponent(userid)}`;

            if (typeof window.ethereum === 'undefined') {
                // Open inside MetaMask app on mobile
                window.location.href = `https://metamask.app.link/dapp/${dappUrl}`;
                return;
            }

            // If MetaMask available on desktop
            window.location.href = dappUrl;
        }

        document.addEventListener("click", function(e) {
            if (e.target.closest(".activate-plan")) {
                const btn = e.target.closest(".activate-plan");
                const amount = btn.dataset.amount;
                const planid = btn.dataset.planid;
                const userid = btn.dataset.userid;
                sendUSDT(amount, planid, userid);
            }
        });
    </script> --}}

    
    


@endsection
