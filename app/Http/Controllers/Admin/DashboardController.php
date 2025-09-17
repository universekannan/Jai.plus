<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\User;
use Jenssegers\Agent\Agent;
use App\FCM;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'auth' );
    }

    public function dashboard()
    {
        $referral_id = Auth::id();
        $userId = auth()->id();

        $weekStart = date('Y-m-d', strtotime('last sunday', strtotime('tomorrow')));
        $weekEnd = date('Y-m-d', strtotime('next saturday', strtotime($weekStart)));

        if (Auth::user()->user_type_id == 1) {
            $ActiveMembers = DB::table('users')->where('plan_id','>', 0)->count();
            $InactiveMembers = DB::table('users')->where('plan_id', 0)->count();
            $TotalMembers = $ActiveMembers + $InactiveMembers;

        } else {
            $ActiveMembers = DB::table('users')->where('plan_id','>', 0)->where('referral_id', $referral_id)->count();
            $InactiveMembers = DB::table('users')->where('plan_id', 0)->where('referral_id', $referral_id)->count();
            $TotalMembers = $ActiveMembers + $InactiveMembers;
        }

        // if (Auth::user()->user_type_id == 1) {
		// 	$LastWeekActiveMembers = DB::table('users')
		// 		->where('status', 1)
		// 		->whereBetween(DB::raw('DATE(created_at)'), [$weekStart, $weekEnd])
		// 		->count();
		// 	$LastWeekInactiveMembers = DB::table('users')
		// 		->where('status', 2)
		// 		->whereBetween(DB::raw('DATE(created_at)'), [$weekStart, $weekEnd])
		// 		->count();
        // } else {
		// 	$LastWeekActiveMembers = DB::table('users')
		// 		->where('status', 1)
        //         ->where('referral_id', $referral_id)
		// 		->whereBetween(DB::raw('DATE(created_at)'), [$weekStart, $weekEnd])
		// 		->count();
		// 	$LastWeekInactiveMembers = DB::table('users')
		// 		->where('status', 2)
        //          ->where('referral_id', $referral_id)
		// 		->whereBetween(DB::raw('DATE(created_at)'), [$weekStart, $weekEnd])
		// 		->count();
        // }

        $userPlans = DB::table('user_plan')
            ->where('user_id', $userId)
            ->pluck('plan_id');
        
        if ($userPlans->isEmpty()) {
            $nextPlan = DB::table('plans')
                ->where('status', 1)
                ->orderBy('id', 'ASC') 
                ->first();

            $remainingPlansCount = DB::table('plans')
                ->where('status', 1)
                ->count();
        } else {
            $nextPlan = DB::table('plans')
                ->where('status', 1)
                ->whereNotIn('id', $userPlans)
                ->orderBy('id', 'ASC')
                ->first();

            $remainingPlansCount = DB::table('plans')
            ->where('status', 1)
            ->whereNotIn('id', $userPlans)
            ->count();
        }
            
        $nextPlanName = $nextPlan ? $nextPlan->plan_name : 'All plan activated';

        // $LastWeekwalletIncome = DB::table('users')->where('id', auth()->user()->id)->whereBetween(DB::raw('DATE(updated_at)'), [$weekStart, $weekEnd])
        // ->sum('wallet');

        $sponserIncome = DB::table('sponser_income')->where('to_id', auth()->user()->id)->where('pay_reason_id', '1')->sum('amount');
        // $LastWeeksponserIncome = DB::table('sponser_income')
        // ->where('pay_reason_id', '1')
        // ->where('to_id', auth()->user()->id)
        // ->whereDate('created_at','>=', $weekStart)->whereDate('created_at','<=', $weekEnd)
        // ->sum('amount');

        // $LastWeekrebirthIncome = DB::table('global_regain')
        // ->where('pay_reason_id', '2')
        // ->where('from_id', auth()->user()->id)
        // ->count();

        

        $uplineIncome = DB::table('upline_income')->where('to_id', auth()->user()->id)->where('pay_reason_id', '3')->sum('amount');
        // $LastWeekInuplineIncome = DB::table('upline_income')
        // ->where('pay_reason_id', '3')
        // ->where('to_id', auth()->user()->id)
        // ->whereDate('created_at','>=', $weekStart)->whereDate('created_at','<=', $weekEnd)
        // ->sum('amount');
        $TotalAmount = $sponserIncome + $uplineIncome;
		if (Auth::user()->user_type_id == 1) {
			$Withdrawal = DB::table('withdrawal')
				->where('status', 1)
				->count();
			// $LastWeekWithdrawal = DB::table('withdrawal')
			// 	->where('status', 2)
			// 	->whereBetween(DB::raw('DATE(created_at)'), [$weekStart, $weekEnd])
			// 	->count();
        } else {
			$Withdrawal = DB::table('withdrawal')
				->where('status', 1)
				->count();
			// $LastWeekWithdrawal = DB::table('withdrawal')
			// 	->where('status', 2)
            //     ->where('to_id', $referral_id)
			// 	->whereBetween(DB::raw('DATE(created_at)'), [$weekStart, $weekEnd])
			// 	->count();
        }

       
        
       
        // $GRUpgrade = DB::table('global_regain')->where('pay_reason_id', 2)->where('from_id', auth()->user()->id)->sum('amount');
        // $GRAdmin = DB::table('global_regain')->where('pay_reason_id', 5)->where('from_id', auth()->user()->id)->sum('amount');
        // $GRTotal = $GRUpgrade + $GRAdmin;

        $rebirthIncome = DB::table('global_regain')->where('pay_reason_id', 2)->where('from_id', auth()->user()->id)->where('to_id','!=',1)->sum('amount');

       
        $UPUpgrade = DB::table('upline_income')->where('pay_reason_id', 4)->where('to_id', auth()->user()->id)->sum('amount');
        $UPAdmin = DB::table('upline_income')->where('pay_reason_id', 5)->where('to_id', auth()->user()->id)->sum('amount');
        $UPTotal = $UPUpgrade + $UPAdmin;

        // $rebirthIncome = $GRTotal;


        $userId = auth()->id();
        $plans = DB::table('plans')->where('status', 1)->orderBy('id', 'ASC')->get();
        $userPlans = DB::table('user_plan')->where('user_id', $userId)->pluck('plan_id')->toArray();
        $nextPlanId = null;
        foreach ($plans as $plan) {
            if (!in_array($plan->id, $userPlans)) {
                $nextPlanId = $plan->id;
                break;
            }
        }


        $totalAdminAmount = DB::table('admin_income')
        ->where('to_id', 1)
        ->sum('amount');


        return view('admin.dashboard', compact('ActiveMembers','TotalMembers','TotalAmount', 'InactiveMembers', 'nextPlanName', 'remainingPlansCount', 'uplineIncome', 'sponserIncome', 'rebirthIncome','Withdrawal','UPUpgrade','UPAdmin','UPTotal','plans','userPlans','nextPlanId', 'totalAdminAmount'));
    }
	


}