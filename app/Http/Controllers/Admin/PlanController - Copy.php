<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Artisan;
use Log;
use Auth;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
//  public function __construct()
//   {
//     $this->middleware( 'auth' );
//   }

  public function userActivatePlan()
  {
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

    return view("admin.plan.activate_plan", compact('plans', 'userPlans', 'nextPlanId'));
  }


    public function plans(){
        $plan = DB::table('plans')->where('status',1)->get();
        return view("admin.plan.plans", compact('plan'));
    }

    public function addplan( Request $request ) {

      $planid = DB::table( 'plans' )->insertGetId([
        
          'plan_name'         => $request->plan_name,
          'plan_amount'       => $request->plan_amount,
          'sponser_amount'    => $request->sponser_amount,
          'level_amount'      => $request->level_amount,
          'upline_amount'     => $request->upline_amount,
          'regain_amount'     => $request->regain_amount,
          'shib_coin'         => $request->shib_coin,
          'pepe_coin'         => $request->pepe_coin,
          'bonk_coin'         => $request->bonk_coin,
          'floki_coin'        => $request->floki_coin,
          'btt_coin'          => $request->btt_coin,
          'baby_doge_coin'    => $request->baby_doge_coin,
          'tfc_coin'          => $request->tfc_coin,
          'status'            => 1,
          'created_at'        => now(),
      ]);

      DB::table( 'user_plan' )->insert([
          'plan_id'           => $planid,
          'user_id'           => 1,
          'amount'       => $request->plan_amount,
          'created_by'        => auth()->user()->id,
          'created_at'        => now(),
      ]);

      return redirect()->back()->with( 'success', 'Plan Added Successfully ... !' );
  }

  public function editplan( Request $request ) {

    DB::table( 'plans' )->where('id',$request->id)->update( [
        'plan_name'         => $request->plan_name,
        'plan_amount'       => $request->plan_amount,
        'sponser_amount'    => $request->sponser_amount,
        'level_amount'      => $request->level_amount,
        'upline_amount'     => $request->upline_amount,
        'regain_amount'     => $request->regain_amount,
        'shib_coin'         => $request->shib_coin,
		'pepe_coin'         => $request->pepe_coin,
		'bonk_coin'         => $request->bonk_coin,
		'floki_coin'        => $request->floki_coin,
		'btt_coin'          => $request->btt_coin,
		'baby_doge_coin'    => $request->baby_doge_coin,
		'tfc_coin'          => $request->tfc_coin,
        'status'            => $request->status,
        'updated_at'        => now(),
    ] );

    return redirect()->back()->with( 'success', 'Plan Updated Successfully ... !' );
  }

  public function plan_payment($id, $userId){
    $plan = DB::table('plans')->where('id',$id)->where('status',1)->first();
    $adminwallet = DB::table('users')->where('id', 1)->first();
    $redata = DB::table('users')->where('id', $userId)->first();
    $refwallet = DB::table('users')->where('id', $redata->referral_id)->first();

    return view("admin.plan.plan_payment", compact('plan', 'userId', 'refwallet', 'adminwallet'));
  }



//   public static function storePayment($type, $planId, $fromId, $toId, $level, $reasonId, $amount, $paymentStatus, $message)
//   {
//     DB::table('payments')->insert([
//         'plan_id'        => $planId,
//         'from_id'        => $fromId,
//         'to_id'          => $toId,
//         'level'          => $level,
//         'pay_reason_id'  => $reasonId,
//         'amount'         => $amount,
//         'payment_status' => $paymentStatus,
//         'message'        => $message,
//         'log_id'         => auth()->id(),
//         'created_at'     => now(),
//     ]);

//     // if($type != 'Rebirth' && $type != 'PlanTree' &&  $type != 'RebirthSplitMain' &&  $type != 'RebirthSplitMain1' && $type != 'RebirthSplitMain2' && $type != 'RebirthSplitMainTravel' && $type != 'RebirthSplitMainTravel1' && $type != 'RebirthSplitMainTravel2' && $type != 'RebirthSplitMainTravel3' && $type != 'RebirthSplitMainTravel4' && $type != 'RebirthSplitMainTravel5'){
//     // $wallet = DB::table('users')->where('id', $toId)->value('wallet');
//     //   $newBalance = ($wallet ?? 0) + $amount;
//     //   DB::table('users')->where('id', $toId)->update([
//     //       'wallet'     => $newBalance,
//     //       'updated_at' => now(),
//     //   ]);
//     // }

//     if($type == 'RebirthIn'){
//         $wallet = DB::table('users')->where('id', $toId)->value('wallet');
//           $newBalance = ($wallet ?? 0) + $amount;
//           DB::table('users')->where('id', $toId)->update([
//               'wallet'     => $newBalance,
//               'updated_at' => now(),
//           ]);
//         }
    

//     if($type == 'PlanTree'){
//         $wallet = DB::table('users')->where('id', $toId)->value('global_rebirth_amount');
//         $rebBalance = ($global_rebirth_amount ?? 0) + $amount;
//         DB::table('users')->where('id', $toId)->update([
//             'global_rebirth_amount'  => $rebBalance,
//             'global_id'  => $toId,
//             'updated_at' => now(),
//         ]);
//       }

//       if($type == 'RebirthSplitMain'){
//         $travelBalance = ($travel_amount ?? 0) + $amount;
//         DB::table('users')->where('id', $toId)->update([
//             'travel_amount'  => $travelBalance,
//             'updated_at' => now(),
//         ]);
//       }

//       if($type == 'RebirthSplitMain1'){
//         $travelalloBalance = ($travel_allownace ?? 0) + $amount;
//         DB::table('users')->where('id', $toId)->update([
//             'travel_allownace'  => $travelalloBalance,
//             'updated_at' => now(),
//         ]);
//       }

//       if($type == 'RebirthSplitMain2'){
//         $upgradeBalance = ($upgrade ?? 0) + $amount;
//         DB::table('users')->where('id', $toId)->update([
//             'upgrade'  => $upgradeBalance,
//             'updated_at' => now(),
//         ]);
//       }

//       if($type == 'RebirthSplitMainTravel'){
//         $taintBalance = ($ta_international_tour ?? 0) + $amount;
//         DB::table('users')->where('id', $toId)->update([
//             'ta_international_tour'  => $taintBalance,
//             'updated_at' => now(),
//         ]);
//       }

//       if($type == 'RebirthSplitMainTravel1'){
//         $tanatBalance = ($ta_national_tour ?? 0) + $amount;
//         DB::table('users')->where('id', $toId)->update([
//             'ta_national_tour'  => $tanatBalance,
//             'updated_at' => now(),
//         ]);
//       }

//       if($type == 'RebirthSplitMainTravel2'){
//         $talocBalance = ($ta_local_tour ?? 0) + $amount;
//         DB::table('users')->where('id', $toId)->update([
//             'ta_local_tour'  => $talocBalance,
//             'updated_at' => now(),
//         ]);
//       }
//       if($type == 'RebirthSplitMainTravel3'){
//         $tintBalance = ($travel_international_tour ?? 0) + $amount;
//         DB::table('users')->where('id', $toId)->update([
//             'travel_international_tour'  => $tintBalance,
//             'updated_at' => now(),
//         ]);
//       }

//       if($type == 'RebirthSplitMainTravel4'){
//         $tnatBalance = ($travel_national_tour ?? 0) + $amount;
//         DB::table('users')->where('id', $toId)->update([
//             'travel_national_tour'  => $tnatBalance,
//             'updated_at' => now(),
//         ]);
//       }

//       if($type == 'RebirthSplitMainTravel5'){
//         $tlocBalance = ($travel_local_tour ?? 0) + $amount;
//         DB::table('users')->where('id', $toId)->update([
//             'travel_local_tour'  => $tlocBalance,
//             'updated_at' => now(),
//         ]);
//       }
    
//   }

  public static function storeSponserPayment($type, $planId, $fromId, $toId, $level, $reasonId, $amount, $paymentStatus, $message, $user_type_id)
  {
    DB::table('sponser_income')->insert([
        'plan_id'        => $planId,
        'from_id'        => $fromId,
        'to_id'          => $toId,
        'level'          => $level,
        'pay_reason_id'  => $reasonId,
        'amount'         => $amount,
        'payment_status' => $paymentStatus,
        'message'        => $message,
        'user_type_id'   => $user_type_id,
        'log_id'         => auth()->id(),
        'created_at'     => now(),
    ]);

    // if($type == 'Rebirth'){
    //     $upgradeBalance = ($upgrade ?? 0) + $amount;
    //     DB::table('users')->where('id', $toId)->update([
    //         'upgrade'  => $upgradeBalance,
    //         'updated_at' => now(),
    //     ]);
    // }
  }


  public static function storeLevelPayment($type, $planId, $fromId, $toId, $level, $reasonId, $amount, $paymentStatus, $message, $user_type_id)
  {
    DB::table('level_income')->insert([
        'plan_id'        => $planId,
        'from_id'        => $fromId,
        'to_id'          => $toId,
        'level'          => $level,
        'pay_reason_id'  => $reasonId,
        'amount'         => $amount,
        'payment_status' => $paymentStatus,
        'message'        => $message,
        'user_type_id'   => $user_type_id,
        'log_id'         => auth()->id(),
        'created_at'     => now(),
    ]);

    if($type == 'RebirthSplitMain'){
        $travel_amount = DB::table('users')->where('id', $toId)->value('travel_amount');
        $travelBalance = ($travel_amount ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_amount'  => $travelBalance,
            'updated_at' => now(),
        ]);
    }

    if($type == 'RebirthSplitMain1'){
        $travel_allownace = DB::table('users')->where('id', $toId)->value('travel_allownace');
        $travelalloBalance = ($travel_allownace ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_allownace'  => $travelalloBalance,
            'updated_at' => now(),
        ]);
    }

    if($type == 'RebirthSplitMain2'){
        $upgrade = DB::table('users')->where('id', $toId)->value('upgrade');
        $upgradeBalance = ($upgrade ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'upgrade'  => $upgradeBalance,
            'updated_at' => now(),
        ]);
    }

  }

  public static function storeUplinePayment($type, $planId, $fromId, $toId, $level, $reasonId, $amount, $paymentStatus, $message, $user_type_id)
  {
    DB::table('upline_income')->insert([
        'plan_id'        => $planId,
        'from_id'        => $fromId,
        'to_id'          => $toId,
        'level'          => $level,
        'pay_reason_id'  => $reasonId,
        'amount'         => $amount,
        'payment_status' => $paymentStatus,
        'message'        => $message,
        'user_type_id'   => $user_type_id,
        'log_id'         => auth()->id(),
        'created_at'     => now(),
    ]);


      if($type == 'RebirthSplitMain'){
        $travel_amount = DB::table('users')->where('id', $toId)->value('travel_amount');
        $travelBalance = ($travel_amount ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_amount'  => $travelBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMain1'){
        $travel_allownace = DB::table('users')->where('id', $toId)->value('travel_allownace');
        $travelalloBalance = ($travel_allownace ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_allownace'  => $travelalloBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMain2'){
        $upgrade = DB::table('users')->where('id', $toId)->value('upgrade');
        $upgradeBalance = ($upgrade ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'upgrade'  => $upgradeBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel3'){
        $travel_international_tour = DB::table('users')->where('id', $toId)->value('travel_international_tour');
        $tintBalance = ($travel_international_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_international_tour'  => $tintBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel4'){
        $travel_national_tour = DB::table('users')->where('id', $toId)->value('travel_national_tour');
        $tnatBalance = ($travel_national_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_national_tour'  => $tnatBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel5'){
        $travel_local_tour = DB::table('users')->where('id', $toId)->value('travel_local_tour');
        $tlocBalance = ($travel_local_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_local_tour'  => $tlocBalance,
            'updated_at' => now(),
        ]);
      }
  }

  public static function storeGlobalPayment($type, $planId, $fromId, $toId, $level, $reasonId, $amount, $paymentStatus, $message, $user_type_id)
  {
    DB::table('global_regain')->insert([
        'plan_id'        => $planId,
        'from_id'        => $fromId,
        'to_id'          => $toId,
        'level'          => $level,
        'pay_reason_id'  => $reasonId,
        'amount'         => $amount,
        'payment_status' => $paymentStatus,
        'message'        => $message,
        'user_type_id'   => $user_type_id,
        'log_id'         => auth()->id(),
        'created_at'     => now(),
    ]);

    if($type == 'PlanTree'){
        $global_rebirth_amount = DB::table('users')->where('id', $toId)->value('global_rebirth_amount');
        $rebBalance = ($global_rebirth_amount ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'global_rebirth_amount'  => $rebBalance,
            'global_id'  => $toId,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMain'){
        $travel_amount = DB::table('users')->where('id', $toId)->value('travel_amount');
        $travelBalance = ($travel_amount ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_amount'  => $travelBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMain1'){
        $travel_allownace = DB::table('users')->where('id', $toId)->value('travel_allownace');
        $travelalloBalance = ($travel_allownace ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_allownace'  => $travelalloBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMain2'){
        $upgrade = DB::table('users')->where('id', $toId)->value('upgrade');
        $upgradeBalance = ($upgrade ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'upgrade'  => $upgradeBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel'){
        $ta_international_tour = DB::table('users')->where('id', $toId)->value('ta_international_tour');
        $taintBalance = ($ta_international_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'ta_international_tour'  => $taintBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel1'){
        $ta_national_tour = DB::table('users')->where('id', $toId)->value('ta_national_tour');
        $tanatBalance = ($ta_national_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'ta_national_tour'  => $tanatBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel2'){
        $ta_local_tour = DB::table('users')->where('id', $toId)->value('ta_local_tour');
        $talocBalance = ($ta_local_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'ta_local_tour'  => $talocBalance,
            'updated_at' => now(),
        ]);
      }
      if($type == 'RebirthSplitMainTravel3'){
        $travel_international_tour = DB::table('users')->where('id', $toId)->value('travel_international_tour');
        $tintBalance = ($travel_international_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_international_tour'  => $tintBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel4'){
        $travel_national_tour = DB::table('users')->where('id', $toId)->value('travel_national_tour');
        $tnatBalance = ($travel_national_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_national_tour'  => $tnatBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel5'){
        $travel_local_tour = DB::table('users')->where('id', $toId)->value('travel_local_tour');
        $tlocBalance = ($travel_local_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_local_tour'  => $tlocBalance,
            'updated_at' => now(),
        ]);
      }
    
  }


  /**
   * Get the N-th level upline dynamically
   */
  private function getUpline($user, $level)
  {
    $current = $user;
    for ($i = 1; $i <= $level; $i++) {
        if (empty($current->referral_id)) {
            return null; // no more uplines
        }
        $current = DB::table('users')->where('id', $current->referral_id)->first();
    }
    return $current->id ?? null;
  }

  
    public function activatePlanPayment(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|integer',
            'user_id' => 'required|integer',
            'amount'  => 'required|numeric',
        ]);

        $userId = $request->user_id;
        $amount = $request->amount;
        $planId = $request->plan_id;
        $upgrade = $request->upgrade;
        $upgrade_status = $request->upgrade_status;
        $levels = 10;

        return DB::transaction(function () use ($userId, $amount, $planId, $levels, $upgrade, $upgrade_status) {

            // Store the activated plan (capture id for ordering if needed)
            DB::table('user_plan')->insert([
                'plan_id'    => $planId,
                'user_id'    => $userId,
                'amount'     => $amount,
                'created_by' => auth()->id(),
                'created_at' => now(),
            ]);

            $planData = DB::table('plans')->where('id',$planId)->first();

            if($upgrade_status == 1){
                $totup = $upgrade - $planData->plan_amount;
                DB::table('users')->where('id', $userId)->update([
                    'upgrade'        => $totup,
                ]);
            }

            // Update user to latest plan
            DB::table('users')->where('id', $userId)->update([
                'plan_id'    => $planId,
                'status'     => 1,
                'updated_at' => now(),
            ]);
            
            // Get current user details
            $currentUser = DB::table('users')->where('id', $userId)->first();

            // Increment coins separately
            $shib_coin = ($currentUser->shib_coin ?? 0) + $planData->shib_coin;
            $bonk_coin = ($currentUser->bonk_coin ?? 0) + $planData->bonk_coin;
            $pepe_coin = ($currentUser->pepe_coin ?? 0) + $planData->pepe_coin;
            $floki_coin = ($currentUser->floki_coin ?? 0) + $planData->floki_coin;
            $btt_coin = ($currentUser->btt_coin ?? 0) + $planData->btt_coin;
            $tfc_coin = ($currentUser->tfc_coin ?? 0) + $planData->tfc_coin;
            $baby_doge_coin = ($currentUser->baby_doge_coin ?? 0) + $planData->baby_doge_coin;
            DB::table('users')->where('id', $userId)->update([
                'shib_coin' => $shib_coin,
                'bonk_coin' => $bonk_coin,
                'pepe_coin' => $pepe_coin,
                'floki_coin' => $floki_coin,
                'btt_coin' => $btt_coin,
                'tfc_coin' => $tfc_coin,
                'baby_doge_coin' => $baby_doge_coin,
            ]);

            // Get ALL activated plans for this user (current and previous)
            $activatedPlans = DB::table('user_plan')
                ->join('plans', 'user_plan.plan_id', '=', 'plans.id')
                ->where('user_plan.user_id', $userId)
                ->select('plans.*', 'user_plan.amount as plan_amount')
                ->get();

            foreach ($activatedPlans as $plan) {

            
                // //////////////////////  1) Sponser Income //////////////////////////

                $refralupgradeCommission = ($plan->plan_amount * 5) / 100;
                $referrerCommission = ($plan->plan_amount * 50) / 100;
                $adminCommission = ($plan->plan_amount * 5) / 100;

                // Self bonus
                $this->storeSponserPayment('Rebirth', $plan->id, $userId, $currentUser->referral_id, 1, '5', $refralupgradeCommission, 1, "Referal Upgrade Bonus",'3');

              //  Referrer bonus
                if (!empty($currentUser->referral_id)) {
                    $this->storeSponserPayment('RebirthIn', $plan->id, $userId, $currentUser->referral_id, 1, '1', $referrerCommission, 1, "Referral Sponser Income",'3');
                } else {
                    $this->storeSponserPayment('RebirthIn', $plan->id, $userId, 1, 1, '1', $referrerCommission, 1, "Referral Sponser Income (Admin)",'3');
                }


                // Admin bonus (set to 0 if you want ONLY the rotating 20% path)
                if ($adminCommission > 0) {
                    $this->storeSponserPayment('Rebirth', $plan->id, $userId, 1, 1, '8', $adminCommission, 1, "Admin Bonus Upgrade",'3');
                }

                $upBalance = ($currentUser->upgrade ?? 0) + $refralupgradeCommission;
                DB::table('users')->where('id', $currentUser->referral_id)->update([
                    'upgrade' => $upBalance,
                ]);

                // ////////////////////////////////// 2) Global Regain /////////////////////////////////
                // // . ===== NEW: Rotating 20% commission per plan (Admin -> #1 -> #2 ... per 20 purchases) =====
                $rotatingPercent = $plan->regain_amount; 
                $purchaseCount = DB::table('user_plan')
                    ->where('plan_id', $planId)
                    ->count(); // includes this purchase because we inserted above

                // 0-based batch index: 0 for purchases 1–20, 1 for 21–40, etc.
                $batchNumber = intdiv(max($purchaseCount - 1, 0), 20);

                if ($batchNumber === 0) {
                    // First 20 purchases go to admin (id=1)
                    $beneficiaryId = 1;
                } else {
                    // Next batches go to the (batchNumber)th purchaser overall
                    $beneficiaryIndex = $batchNumber - 1; // 0-based index among earliest purchasers
                    $beneficiaryRow = DB::table('user_plan')
                        ->where('plan_id', $planId)
                        ->orderBy('id', 'asc')
                        ->skip($beneficiaryIndex)
                        ->take(1)
                        ->first();

                    $beneficiaryId = $beneficiaryRow->user_id ?? 1;
                }

                // Pay rotating commission on THIS purchase
                $rotatingCommissionAmount = ($amount * $rotatingPercent) / 100;

                // Check if this is the 20th, 40th, 60th... purchase
                if ($purchaseCount % 20 === 0) {
                    // Get total global_rebirth_amount for beneficiary
                    $rebirtAmount = DB::table('global_regain')
                        ->where('to_id', $beneficiaryId)
                        ->where('plan_id', $planId)
                        ->sum('amount') ?? 0;

                    if ($rebirtAmount > 0) {
                        $total = $rebirtAmount - $plan->plan_amount;

                        // plan amount is sponser admin after 20 person 
                        // $share25 = ($rebirtAmount * 25) / 100;
                        // $share75 = ($rebirtAmount * 75) / 100;

                        // $this->storeGlobalPayment('RebirthSplit',$planId,$userId,$beneficiaryId,1,'2',$share25,1,"25% Rebirth Split Bonus",'3');
                        // $this->storeGlobalPayment('RebirthSplit',$planId,$userId,1,1,'2',$share75,1,"75% Rebirth Split Bonus to Admin",'3');

                        $share40 = ($total * 40) / 100;
                        $share10 = ($total * 10) / 100;

                        $this->storeGlobalPayment('RebirthSplitMain',$planId,$userId,$beneficiaryId,1,'6',$share40,1,"Travel Amount",'3');
                        $this->storeGlobalPayment('RebirthSplitMain1',$planId,$userId,$beneficiaryId,1,'7',$share40,1,"Travel Allowance",'3');
                        $this->storeGlobalPayment('RebirthSplitMain2',$planId,$userId,$beneficiaryId,1,'5',$share40,1,"Upgrade",'3');
                        $this->storeGlobalPayment('RebirthSplit',$planId,$userId,1,1,'8',$share10,1,"Admin 10%",'3');

                        $share50travel = ($share40 * 50) / 100;
                        $share30travel = ($share30 * 40) / 100;
                        $share20travel = ($share20 * 10) / 100;

                        $this->storeGlobalPayment('RebirthSplitMainTravel3',$planId,$userId,$beneficiaryId,1,'12',$share50travel,1,"Travel International Tour",'3');
                        $this->storeGlobalPayment('RebirthSplitMainTravel4',$planId,$userId,$beneficiaryId,1,'13',$share30travel,1,"Travel National Tour",'3');
                        $this->storeGlobalPayment('RebirthSplitMainTravel5',$planId,$userId,$beneficiaryId,1,'14',$share20travel,1,"Travel Local Tour",'3');

                        $this->storeGlobalPayment('RebirthSplitMainTravel',$planId,$userId,$beneficiaryId,1,'9',$share50travel,1,"Travel Allowance International Tour",'3');
                        $this->storeGlobalPayment('RebirthSplitMainTravel1',$planId,$userId,$beneficiaryId,1,'10',$share30travel,1,"Travel Allowance National Tour",'3');
                        $this->storeGlobalPayment('RebirthSplitMainTravel2',$planId,$userId,$beneficiaryId,1,'11',$share20travel,1,"Travel Allowance Local Tour",'3');

                        // DB::table('users')->where('id', $beneficiaryId)->update(['global_rebirth_amount' => 0]);

                        $rebirthData = DB::table('users')->where('id', $beneficiaryId)->first();

                        if ($rebirthData) {

                            $dataToInsert = (array) $rebirthData;
                            unset($dataToInsert['id'], $dataToInsert['password']);
                        
                            $dataToInsert['name'] =  $plan->plan_name . '- Rebirth';
                            $dataToInsert['global_id'] =  '';
                            $dataToInsert['usertype_id'] =  '4';
                            $dataToInsert['created_at'] = now();
                            $dataToInsert['updated_at'] = now();
                        
                            $newId = DB::table('users')->insertGetId($dataToInsert);

                            $rebirthPlan = DB::table('user_paln')->insert([
                                'user_id' => $beneficiaryId,
                                'plan_id' => $plan->id,
                                'amount' => $plan->plan_amount,
                                'created_by' => auth()->user()->id,
                                'created_at' => now(),
                            ]);

                            $this->repeatPlanPayment($userId, $amount, $planId, $levels, $upgrade);
                        }                      
                    }
                    
                } else {
                    // Normal rotating commission
                    $this->storeGlobalPayment('PlanTree',$planId,$userId,$beneficiaryId,1,'2',$rotatingCommissionAmount,1,"Global regain Income",'3');
                }
                // // // // ===== END NEW BLOCK =====


                // // /**
                // //  * 1. LEVEL COMMISSION (split into 10 levels equally)
                // //  */
                $commissionPerLevel = ($plan->plan_amount * $plan->level_amount) / 100;
                $comAmount = $commissionPerLevel / $levels;

                 $referrerId = $currentUser->referral_id ?? null;
                for ($level = 1; $level <= $levels; $level++) {
                    if ($referrerId) {

                        $perc50 = ($comAmount * 50) / 100;
                        $perc30 = ($comAmount * 30) / 100;
                        $perc10 = ($comAmount * 10) / 100;

                        // $wallet = DB::table('users')->where('id', $referrerId)->value('wallet');
                        // $newBalance = ($wallet ?? 0) + $comAmount;
                        // DB::table('users')->where('id', $referrerId)->update([
                        //     'wallet'     => $newBalance,
                        //     'updated_at' => now(),
                        // ]);

                        $this->storeLevelPayment('Level', $plan->id, $userId, $referrerId, $level, '3', $comAmount, '1', "Level Income",'3');

                        $this->storeLevelPayment('RebirthSplitMain',$planId,$userId, $referrerId, $level, '6',$perc30, 1, "Travel Amount Level",'3');
                        $this->storeLevelPayment('RebirthSplitMain1',$planId,$userId,$referrerId,$level,'7',$perc50,1,"Travel Allowance",'3');
                        $this->storeLevelPayment('RebirthSplitMain2',$planId,$userId, $referrerId, $level, '5',$perc10, 1, "Upgrade Level",'3');
                        $this->storeLevelPayment('RebirthSplit',$planId,$userId, $referrerId, $level, '8',$perc10, 1, "Admin 10% Level Upgrade",'3');

                        $referrer = DB::table('users')->where('id', $referrerId)->first();
                        $referrerId = $referrer->referral_id ?? null;
                    } else {
                        // fallback to admin

                         $perc50 = ($comAmount * 50) / 100;
                        $perc30 = ($comAmount * 30) / 100;
                        $perc10 = ($comAmount * 10) / 100;

                        // $wallet = DB::table('users')->where('id', 1)->value('wallet');
                        // $newBalance = ($wallet ?? 0) + $comAmount;
                        // DB::table('users')->where('id', 1)->update([
                        //     'wallet'     => $newBalance,
                        //     'updated_at' => now(),
                        // ]);

                        $this->storeLevelPayment('Level', $plan->id, $userId, 1, $level, '3', $comAmount, '1', "Level Income",'3');

                        $this->storeLevelPayment('RebirthSplitMain',$planId,$userId, 1, $level, '6',$perc30, 1, "Travel Amount Level",'3');
                        $this->storeLevelPayment('RebirthSplitMain1',$planId,$userId, 1, $level,'7',$perc50,1,"Travel Allowance",'3');
                        $this->storeLevelPayment('RebirthSplitMain2',$planId,$userId, 1, $level, '5',$perc10, 1, "Upgrade Level",'3');
                        $this->storeLevelPayment('RebirthSplit',$planId,$userId, 1, $level, '8',$perc10, 1, "Admin 10% Level Upgrade",'3');

                    }
                }

                // // /**
                // //  * 4. UPLINE COMMISSION
                // //  */
                $commissionAmount = ($plan->plan_amount * $plan->upline_amount) / 100;
                $uplinerId = $this->getUpline($currentUser, $plan->id);

                if ($uplinerId) {
                    $hasPlan = DB::table('user_plan')
                        ->where('user_id', $uplinerId)
                        ->where('plan_id', $plan->id)
                        ->exists();

                    if (!$hasPlan) {
                        $uplinerId = 1; // admin fallback
                    }
                } else {
                    $uplinerId = 1; // admin fallback
                }

                $perca50 = ($commissionAmount * 50) / 100;
                $perca30 = ($commissionAmount * 30) / 100;
                $perca10 = ($commissionAmount * 10) / 100;

                //dd($perca50,$perca30,$perca10);

                $this->storeUplinePayment('Upline', $planId, $userId, $uplinerId, $planId, '4', $commissionAmount, 1, "Upline Sponser",'3');

                $this->storeUplinePayment('RebirthSplitMain',$planId,$userId, $uplinerId, $planId, '6',$perca30, 1, "Travel Amount Upline",'3');
                $this->storeUplinePayment('RebirthSplitMain1',$planId,$userId,$uplinerId,$planId,'7',$perca50,1,"Travel Allowance Upline",'3');
                $this->storeUplinePayment('RebirthSplitMain2',$planId,$userId, $uplinerId, $planId, '5',$perca10, 1, "Upline Sponser Income",'3');
                $this->storeUplinePayment('RebirthSplit',$planId,$userId, $uplinerId, $planId, '8',$perca10, 1, "Admin 10% Upline Upgrade",'3');

                $share15travel = ($perca30 * 15) / 100;
                $share10travel = ($perca30 * 10) / 100;
                $share5travel = ($perca30 * 5) / 100;

                $this->storeUplinePayment('RebirthSplitMainTravel3',$planId,$userId,$uplinerId,$planId,'12',$share15travel,1,"Travel International Tour Upline",'3');
                $this->storeUplinePayment('RebirthSplitMainTravel4',$planId,$userId,$uplinerId,$planId,'13',$share10travel,1,"Travel National Tour Upline",'3');
                $this->storeUplinePayment('RebirthSplitMainTravel5',$planId,$userId,$uplinerId,$planId,'14',$share5travel,1,"Travel Local Tour Upline",'3');
               
            }

            return response()->json(['success' => true]);
        });
    }


    // The reusable core activation logic
    protected function repeatPlanPayment($userId, $planId, $amount, $levels, $upgrade)
    {

        // Store the activated plan (capture id for ordering if needed)
        DB::table('user_plan')->insert([
            'plan_id'    => $planId,
            'user_id'    => $userId,
            'amount'     => $amount,
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);

        $planData = DB::table('plans')->where('id',$planId)->first();

        if($upgrade_status == 1){
            $totup = $upgrade - $planData->plan_amount;
            DB::table('users')->where('id', $userId)->update([
                'upgrade'        => $totup,
            ]);
        }

        // Update user to latest plan
        DB::table('users')->where('id', $userId)->update([
            'plan_id'    => $planId,
            'status'     => 1,
            'updated_at' => now(),
        ]);
        
        
        // Get current user details
        $currentUser = DB::table('users')->where('id', $userId)->first();

        // Increment coins separately
        $shib_coin = ($currentUser->shib_coin ?? 0) + $planData->shib_coin;
        $bonk_coin = ($currentUser->bonk_coin ?? 0) + $planData->bonk_coin;
        $pepe_coin = ($currentUser->pepe_coin ?? 0) + $planData->pepe_coin;
        $floki_coin = ($currentUser->floki_coin ?? 0) + $planData->floki_coin;
        $btt_coin = ($currentUser->btt_coin ?? 0) + $planData->btt_coin;
        $tfc_coin = ($currentUser->tfc_coin ?? 0) + $planData->tfc_coin;
        $baby_doge_coin = ($currentUser->baby_doge_coin ?? 0) + $planData->baby_doge_coin;
        DB::table('users')->where('id', $userId)->update([
            'shib_coin' => $shib_coin,
            'bonk_coin' => $bonk_coin,
            'pepe_coin' => $pepe_coin,
            'floki_coin' => $floki_coin,
            'btt_coin' => $btt_coin,
            'tfc_coin' => $tfc_coin,
            'baby_doge_coin' => $baby_doge_coin,
        ]);

        // Get ALL activated plans for this user (current and previous)
        $activatedPlans = DB::table('user_plan')
            ->join('plans', 'user_plan.plan_id', '=', 'plans.id')
            ->where('user_plan.user_id', $userId)
            ->select('plans.*', 'user_plan.amount as plan_amount')
            ->get();


        foreach ($activatedPlans as $plan) {

            // //////////////////////  1) Sponser Income //////////////////////////

            $refralupgradeCommission     = ($plan->plan_amount * 5) / 100;
            $referrerCommission = ($plan->plan_amount * 50) / 100;
            $adminCommission    = ($plan->plan_amount * 5) / 100;

            // Self bonus
            $this->storeSponserPayment('Rebirth', $plan->id, $userId, $currentUser->referral_id, 1, '5', $refralupgradeCommission, 1, "Referal Upgrade Bonus",'4');

          //  Referrer bonus
            if (!empty($currentUser->referral_id)) {
                $this->storeSponserPayment('RebirthIn', $plan->id, $userId, $currentUser->referral_id, 1, '1', $referrerCommission, 1, "Referral Sponser Income",'4');
            } else {
                $this->storeSponserPayment('RebirthIn', $plan->id, $userId, 1, 1, '1', $referrerCommission, 1, "Referral Sponser Income (Admin)",'4');
            }


            // Admin bonus (set to 0 if you want ONLY the rotating 20% path)
            if ($adminCommission > 0) {
                $this->storeSponserPayment('Rebirth', $plan->id, $userId, 1, 1, '8', $adminCommission, 1, "Admin Bonus Upgrade",'4');
            }

            $upBalance = ($currentUser->upgrade ?? 0) + $refralupgradeCommission;
            DB::table('users')->where('id', $currentUser->referral_id)->update([
                'upgrade' => $upBalance,
            ]);

            // ////////////////////////////////// 2) Global Regain /////////////////////////////////
            // // . ===== NEW: Rotating 20% commission per plan (Admin -> #1 -> #2 ... per 20 purchases) =====
            $rotatingPercent = $plan->regain_amount; 
            $purchaseCount = DB::table('user_plan')
                ->where('plan_id', $planId)
                ->count(); // includes this purchase because we inserted above

            // 0-based batch index: 0 for purchases 1–20, 1 for 21–40, etc.
            $batchNumber = intdiv(max($purchaseCount - 1, 0), 20);

            if ($batchNumber === 0) {
                // First 20 purchases go to admin (id=1)
                $beneficiaryId = 1;
            } else {
                // Next batches go to the (batchNumber)th purchaser overall
                $beneficiaryIndex = $batchNumber - 1; // 0-based index among earliest purchasers
                $beneficiaryRow = DB::table('user_plan')
                    ->where('plan_id', $planId)
                    ->orderBy('id', 'asc')
                    ->skip($beneficiaryIndex)
                    ->take(1)
                    ->first();

                $beneficiaryId = $beneficiaryRow->user_id ?? 1;
            }

            // Pay rotating commission on THIS purchase
            $rotatingCommissionAmount = ($amount * $rotatingPercent) / 100;

            // Check if this is the 20th, 40th, 60th... purchase
            if ($purchaseCount % 20 === 0) {
                // Get total global_rebirth_amount for beneficiary
                $rebirtAmount = DB::table('users')
                    ->where('id', $beneficiaryId)
                    ->value('global_rebirth_amount') ?? 0;

                if ($rebirtAmount > 0) {
                    $total = $rebirtAmount - $plan->plan_amount;

                    // plan amount is sponser admin after 20 person 
                    // $share25 = ($rebirtAmount * 25) / 100;
                    // $share75 = ($rebirtAmount * 75) / 100;

                    // $this->storeGlobalPayment('RebirthSplit',$planId,$userId,$beneficiaryId,1,'2',$share25,1,"25% Rebirth Split Bonus",'4');
                    // $this->storeGlobalPayment('RebirthSplit',$planId,$userId,1,1,'2',$share75,1,"75% Rebirth Split Bonus to Admin",'4');

                    $share40 = ($total * 40) / 100;
                    $share10 = ($total * 10) / 100;

                    $this->storeGlobalPayment('RebirthSplitMain',$planId,$userId,1,1,'6',$share40,1,"Travel Amount",'4');
                    $this->storeGlobalPayment('RebirthSplitMain1',$planId,$userId,1,1,'7',$share40,1,"Travel Allowance",'4');
                    $this->storeGlobalPayment('RebirthSplitMain2',$planId,$userId,1,1,'5',$share40,1,"Upgrade",'4');
                    $this->storeGlobalPayment('RebirthSplit',$planId,$userId,1,1,'8',$share10,1,"Admin 10%",'4');

                    $share50travel = ($share40 * 50) / 100;
                    $share30travel = ($share30 * 40) / 100;
                    $share20travel = ($share20 * 10) / 100;

                    $this->storeGlobalPayment('RebirthSplitMainTravel3',$planId,$userId,1,1,'12',$share50travel,1,"Travel International Tour",'4');
                    $this->storeGlobalPayment('RebirthSplitMainTravel4',$planId,$userId,1,1,'13',$share30travel,1,"Travel National Tour",'4');
                    $this->storeGlobalPayment('RebirthSplitMainTravel5',$planId,$userId,1,1,'14',$share20travel,1,"Travel Local Tour",'4');

                    $this->storeGlobalPayment('RebirthSplitMainTravel',$planId,$userId,1,1,'9',$share50travel,1,"Travel Allowance International Tour",'4');
                    $this->storeGlobalPayment('RebirthSplitMainTravel1',$planId,$userId,1,1,'10',$share30travel,1,"Travel Allowance National Tour",'4');
                    $this->storeGlobalPayment('RebirthSplitMainTravel2',$planId,$userId,1,1,'11',$share20travel,1,"Travel Allowance Local Tour",'4');

                    DB::table('users')->where('id', $beneficiaryId)->update(['global_rebirth_amount' => 0]);

                    $rebirthData = DB::table('users')->where('id', $beneficiaryId)->first();

                    if ($rebirthData) {

                        $dataToInsert = (array) $rebirthData;
                        unset($dataToInsert['id'], $dataToInsert['password']);
                    
                        $dataToInsert['name'] =  $plan->plan_name . '- Rebirth';
                        $dataToInsert['global_id'] =  '';
                        $dataToInsert['usertype_id'] =  '4';
                        $dataToInsert['created_at'] = now();
                        $dataToInsert['updated_at'] = now();
                    
                        $newId = DB::table('users')->insertGetId($dataToInsert);

                        $rebirthPlan = DB::table('user_paln')->insert([
                            'user_id' => $beneficiaryId,
                            'plan_id' => $plan->id,
                            'amount' => $plan->plan_amount,
                            'created_by' => auth()->user()->id,
                            'created_at' => now(),
                        ]);

                        $this->repeatPlanPayment($userId, $amount, $planId, $levels, $upgrade);
                    }                      
                }
                
            } else {
                // Normal rotating commission
                $this->storeGlobalPayment('PlanTree',$planId,$userId,$beneficiaryId,1,'2',$rotatingCommissionAmount,1,"Global regain Income",'4');
            }
            // // // // ===== END NEW BLOCK =====


            // // /**
            // //  * 1. LEVEL COMMISSION (split into 10 levels equally)
            // //  */
            $commissionPerLevel = ($plan->plan_amount * $plan->level_amount) / 100;
            $comAmount = $commissionPerLevel / $levels;

             $referrerId = $currentUser->referral_id ?? null;
            for ($level = 1; $level <= $levels; $level++) {
                if ($referrerId) {

                    $perc50 = ($comAmount * 50) / 100;
                    $perc30 = ($comAmount * 30) / 100;
                    $perc10 = ($comAmount * 10) / 100;

                    // $wallet = DB::table('users')->where('id', $referrerId)->value('wallet');
                    // $newBalance = ($wallet ?? 0) + $comAmount;
                    // DB::table('users')->where('id', $referrerId)->update([
                    //     'wallet'     => $newBalance,
                    //     'updated_at' => now(),
                    // ]);

                    $this->storeLevelPayment('Level', $plan->id, $userId, $referrerId, $level, '3', $comAmount, '1', "Level Income",'4');

                    $this->storeLevelPayment('RebirthSplitMain',$planId,$userId, $referrerId, $level, '6',$perc30, 1, "Travel Amount Level",'4');
                    $this->storeLevelPayment('RebirthSplitMain1',$planId,$userId,$referrerId,$level,'7',$perc50,1,"Travel Allowance",'4');
                    $this->storeLevelPayment('RebirthSplitMain2',$planId,$userId, $referrerId, $level, '5',$perc10, 1, "Upgrade Level",'4');
                    $this->storeLevelPayment('RebirthSplit',$planId,$userId, $referrerId, $level, '8',$perc10, 1, "Admin 10% Level Upgrade",'4');

                    $referrer = DB::table('users')->where('id', $referrerId)->first();
                    $referrerId = $referrer->referral_id ?? null;
                } else {
                    // fallback to admin

                     $perc50 = ($comAmount * 50) / 100;
                    $perc30 = ($comAmount * 30) / 100;
                    $perc10 = ($comAmount * 10) / 100;

                    // $wallet = DB::table('users')->where('id', 1)->value('wallet');
                    // $newBalance = ($wallet ?? 0) + $comAmount;
                    // DB::table('users')->where('id', 1)->update([
                    //     'wallet'     => $newBalance,
                    //     'updated_at' => now(),
                    // ]);

                    $this->storeLevelPayment('Level', $plan->id, $userId, 1, $level, '3', $comAmount, '1', "Level Income",'4');

                    $this->storeLevelPayment('RebirthSplitMain',$planId,$userId, 1, $level, '6',$perc30, 1, "Travel Amount Level",'4');
                    $this->storeLevelPayment('RebirthSplitMain1',$planId,$userId, 1, $level,'7',$perc50,1,"Travel Allowance",'4');
                    $this->storeLevelPayment('RebirthSplitMain2',$planId,$userId, 1, $level, '5',$perc10, 1, "Upgrade Level",'4');
                    $this->storeLevelPayment('RebirthSplit',$planId,$userId, 1, $level, '8',$perc10, 1, "Admin 10% Level Upgrade",'4');

                }
            }

            // // /**
            // //  * 4. UPLINE COMMISSION
            // //  */
            $commissionAmount = ($plan->plan_amount * $plan->upline_amount) / 100;
            $uplinerId = $this->getUpline($currentUser, $plan->id);

            if ($uplinerId) {
                $hasPlan = DB::table('user_plan')
                    ->where('user_id', $uplinerId)
                    ->where('plan_id', $plan->id)
                    ->exists();

                if (!$hasPlan) {
                    $uplinerId = 1; // admin fallback
                }
            } else {
                $uplinerId = 1; // admin fallback
            }

            $perca50 = ($commissionAmount * 50) / 100;
            $perca30 = ($commissionAmount * 30) / 100;
            $perca10 = ($commissionAmount * 10) / 100;

            //dd($perca50,$perca30,$perca10);

            $this->storeUplinePayment('Upline', $planId, $userId, $uplinerId, $planId, '4', $commissionAmount, 1, "Upline Sponser",'4');

            $this->storeUplinePayment('RebirthSplitMain',$planId,$userId, $uplinerId, $planId, '6',$perca30, 1, "Travel Amount Upline",'4');
            $this->storeUplinePayment('RebirthSplitMain1',$planId,$userId,$uplinerId,$planId,'7',$perca50,1,"Travel Allowance Upline",'4');
            $this->storeUplinePayment('RebirthSplitMain2',$planId,$userId, $uplinerId, $planId, '5',$perca10, 1, "Upline Sponser Income",'4');
            $this->storeUplinePayment('RebirthSplit',$planId,$userId, $uplinerId, $planId, '8',$perca10, 1, "Admin 10% Upline Upgrade",'4');

            $share15travel = ($perca30 * 15) / 100;
            $share10travel = ($perca30 * 10) / 100;
            $share5travel = ($perca30 * 5) / 100;

            $this->storeUplinePayment('RebirthSplitMainTravel3',$planId,$userId,$uplinerId,$planId,'12',$share15travel,1,"Travel International Tour Upline",'4');
            $this->storeUplinePayment('RebirthSplitMainTravel4',$planId,$userId,$uplinerId,$planId,'13',$share10travel,1,"Travel National Tour Upline",'4');
            $this->storeUplinePayment('RebirthSplitMainTravel5',$planId,$userId,$uplinerId,$planId,'14',$share5travel,1,"Travel Local Tour Upline",'4');

        }

        return response()->json(['success' => true]);

    }

   

}

