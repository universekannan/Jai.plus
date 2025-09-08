<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Artisan;
use Auth;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlanController extends Controller
{
//  public function __construct()
//   {
//     $this->middleware( 'auth' );
//   }

	public function kannan() {

		$globalregainsssar = DB::table('global_regain')
			->where('plan_id', 1)
			->where('status', 0)
			->orderby('id','ASC')
			->first();

		$globalregain = DB::table('global_regain')
			->where('plan_id', 1)
			->where('status', 0)
			->where('from_id', $globalregainsssar->to_id)
			->orderby('id','DESC')
			->count();

		$parentId = $globalregainsssar->to_id;

		if($globalregain == 3) {
			DB::table('global_regain')->insert([
				'plan_id'        => 1,
				'from_id'        => $parentId,
				'to_id'          => 7,
				'level'          => 1,
				'pay_reason_id'  => 2,
				'amount'         => 5,
				'payment_status' => 1,
				'message'        => 'Global Regain',
				'user_type_id'   => 3,
				'log_id'         => auth()->id(),
				'created_at'     => now(),
			]);
			
			DB::table('global_regain')->where('to_id',$parentId)->update([
				'status'        => 1,
			]);
			
		} else {

			DB::table('global_regain')->insert([
				'plan_id'        => 1,
				'from_id'        => $parentId,
				'to_id'          => 7,
				'level'          => 1,
				'pay_reason_id'  => 2,
				'amount'         => 5,
				'payment_status' => 1,
				'message'        => 'Global Regain',
				'user_type_id'   => 3,
				'log_id'         => auth()->id(),
				'created_at'     => now(),
			]);
		}
	}

public function kannanaaaaa() {

    $globalregainsssar = DB::table('global_regain')
    ->where('plan_id', 1)
    ->where('status', 0)
    ->orderby('id','DESC')
    ->first();

    $globalregainsss = DB::table('global_regain')
    ->where('plan_id', 1)
    ->where('status', 0)
    ->where('from_id', $globalregainsssar->to_id)
    ->orderby('id','ASC')
    ->first();
            
    $globalregain = DB::table('global_regain')
                    ->where('plan_id', 1)
                    ->where('status', 0)
                    // ->where('from_id', $parentId)
                    ->orderby('id','ASC')
                    ->count();

                   
                    if($globalregain < 3) {

                        
    
        $parentId =  2;

                        DB::table('global_regain')->insert([
                            'plan_id'        => 1,
                            'from_id'        => $parentId,
                            'to_id'          => 7,
                            'level'          => 1,
                            'pay_reason_id'  => 2,
                            'amount'         => 5,
                            'payment_status' => 1,
                            'message'        => 'Global Regain',
                            'user_type_id'   => 3,
                            'log_id'         => auth()->id(),
                            'created_at'     => now(),
                        ]);
                    } else {

                        $parentId = $globalregainsss->to_id;

                        DB::table('global_regain')->insert([
                            'plan_id'        => 1,
                            'from_id'        => $parentId,
                            'to_id'          => 7,
                            'level'          => 1,
                            'pay_reason_id'  => 2,
                            'amount'         => 5,
                            'payment_status' => 1,
                            'message'        => 'Global Regain',
                            'user_type_id'   => 3,
                            'log_id'         => auth()->id(),
                            'created_at'     => now(),
                        ]);

                        DB::table('global_regain')->where('to_id',$parentId)->update([
                            'status'        => 1,
                        ]);

                    }
                
}

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
          'upline_amount'     => $request->upline_amount,
          'regain_amount'     => $request->regain_amount,
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
        'upline_amount'     => $request->upline_amount,
        'regain_amount'     => $request->regain_amount,
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


  public function send_push_notification($userid, $title,$body)
  {
      $user = DB::table('users')->where('id',$userid)->first();
      $fcmToken = $user->fcm_token;
      // Load the service account JSON file
      $credentialsPath = env('FIREBASE_CREDENTIALS');

      // Authenticate with Google API
      $client = new \Google\Client();
      $client->setAuthConfig($credentialsPath);
      $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
      $client->useApplicationDefaultCredentials();

      // Get OAuth2 access token
      $token = $client->fetchAccessTokenWithAssertion()['access_token'];

      // Get your Firebase project ID
      $projectId = env('FIREBASE_PROJECT_ID'); // Replace this

      // Build the message payload
      $payload = [
          'message' => [
              'token' => $fcmToken,
              'notification' => [
                  'title' => $title,
                  'body' => $body,
              ],
              'data' => [
                  'customKey1' => 'value1',
                  'customKey2' => 'value2'
              ],
          ]
      ];

      // Send the message using FCM v1 endpoint
      $response = Http::withToken($token)->post(
          "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send",
          $payload
      );

      return response()->json([
          'status' => $response->status(),
          'response' => $response->json()
      ]);
  }

  public function save_fcm_token(Request $request)
  {
      $request->validate([
          'token' => 'required|string'
      ]);

      $user = DB::table('users')->where('id',auth()->user()->id)->update([
          'fcm_token' => $request->token,
      ]);

      return response()->json(['message' => 'Token saved successfully']);
  }


  public function manual_activation($userID){

    $plans = DB::table('plans')->where('status', 1)->orderBy('id', 'ASC')->get();
    $user = DB::table('users')->where('id',$userID)->get();  
    $userPlans = DB::table('user_plan')->where('user_id', $userID)->pluck('plan_id')->toArray();

    $nextPlanId = null;
    foreach ($plans as $plan) {
        if (!in_array($plan->id, $userPlans)) {
            $nextPlanId = $plan->id;
            break;
        }
    }

    return view("admin.plan.manual_activate_plan", compact('plans', 'userPlans', 'nextPlanId', 'userID' ,'user'));
  }


  public function transaction_history(Request $request)
  {
      try {
          $userId   = $request->user_id;
          $amount   = $request->amount;
          $planId   = $request->plan_id;
          $admin    = $request->admin;
          $referral = $request->referral;
  
          $existing = DB::table('transaction_history')
              ->where('user_id', $userId)
              ->where('plan_id', $planId)
              ->first();
  
          if ($existing) {
              // Update existing record
              DB::table('transaction_history')
                  ->where('id', $existing->id)
                  ->update([
                      'referral'   => $referral,
                  ]);
          } else {
              // Insert new record
              DB::table('transaction_history')->insert([
                  'plan_id'    => $planId,
                  'user_id'    => $userId,
                  'amount'     => $amount,
                  'admin'      => $admin,
                  'referral'   => $referral,
                  'created_at' => now(),
              ]);
          }
  
          return response()->json(['success' => true]);
      } catch (\Exception $e) {
          return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
      }
  }
  

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

     if($type == 'Rebirth'){
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


      

      if($type == 'RebirthSplitMain2'){
        $upgrade = DB::table('users')->where('id', $toId)->value('upgrade');
        $upgradeBalance = ($upgrade ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'upgrade'  => $upgradeBalance,
            'updated_at' => now(),
        ]);
      }

  }

  public static function storeGlobalPayment($type, $planId, $fromId, $toId, $level, $reasonId, $amount, $paymentStatus, $message, $user_type_id, $gbAmount)
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
        'global_regain_amount' => $gbAmount
    ]);

    if($type == 'PlanTree'){
        $global_rebirth_amount = DB::table('users')->where('id', $fromId)->value('global_rebirth_amount');
        $rebBalance = ($global_rebirth_amount ?? 0) + $amount;
        DB::table('users')->where('id', $fromId)->update([
            'global_rebirth_amount'  => $rebBalance,
            'global_id'  => $fromId,
            'updated_at' => now(),
        ]);
      }


      if($type == 'RebirthSplitMain2'){
        $upgrade = DB::table('users')->where('id', $fromId)->value('upgrade');
        $upgradeBalance = ($upgrade ?? 0) + $amount;
        DB::table('users')->where('id', $fromId)->update([
            'upgrade'  => $upgradeBalance,
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

    $userId         = $request->user_id;
    $amount         = $request->amount;
    $planId         = $request->plan_id;
    $upgrade        = $request->upgrade;
    $upgrade_status = $request->upgrade_status;

    return DB::transaction(function () use ($userId, $amount, $planId, $upgrade, $upgrade_status) {

        // Store the activated plan
        DB::table('user_plan')->insert([
            'plan_id'    => $planId,
            'user_id'    => $userId,
            'amount'     => $amount,
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);

        $planData = DB::table('plans')->where('id', $planId)->first();

        if ($upgrade_status == 1) {
            $totup = $upgrade - $planData->plan_amount;
            DB::table('users')->where('id', $userId)->update([
                'upgrade' => $totup,
            ]);
        }

        // Update user to latest plan
        DB::table('users')->where('id', $userId)->update([
            'plan_id'    => $planId,
            'status'     => 1,
            'updated_at' => now(),
        ]);

        $currentUser = DB::table('users')->where('id', $userId)->first();

        /**
         * 1) SPONSOR COMMISSION
         */
        $refralupgradeCommission = ($amount * 5) / 100;
        $referrerCommission      = ($amount * 50) / 100;
        $adminCommission         = ($amount * 5) / 100;

        // Self bonus
        $this->storeSponserPayment(
            'Rebirth',
            $planId,
            $userId,
            $currentUser->referral_id,
            1,
            '4',
            $refralupgradeCommission,
            1,
            "Referral Upgrade Bonus",
            '3'
        );

        // Referrer bonus
        if (!empty($currentUser->referral_id)) {
            $this->storeSponserPayment(
                'RebirthIn',
                $planId,
                $userId,
                $currentUser->referral_id,
                1,
                '1',
                $referrerCommission,
                1,
                "Referral Sponsor Income",
                '3'
            );
        } else {
            $this->storeSponserPayment(
                'RebirthIn',
                $planId,
                $userId,
                1,
                1,
                '1',
                $referrerCommission,
                1,
                "Referral Sponsor Income (Admin)",
                '3'
            );
        }

        // Admin bonus
        if ($adminCommission > 0) {
            $this->storeSponserPayment(
                'Rebirth',
                $planId,
                $userId,
                1,
                1,
                '5',
                $adminCommission,
                1,
                "Admin Bonus Upgrade",
                '3'
            );
        }

        /**
         * 2) UPLINE COMMISSION
         */
        $commissionAmount = ($amount * $planData->upline_amount) / 100;
        $uplinerId        = $this->getUpline($currentUser, $planId) ?: 1;

        $perca10 = ($commissionAmount * 10) / 100;

        $this->storeUplinePayment(
            'Upline',
            $planId,
            $userId,
            $uplinerId,
            $planId,
            '3',
            $commissionAmount,
            1,
            "Upline Sponsor",
            '3'
        );
        $this->storeUplinePayment(
            'RebirthSplitMain2',
            $planId,
            $userId,
            $uplinerId,
            $planId,
            '3',
            $perca10,
            1,
            "Upline Sponsor Income",
            '3'
        );
        $this->storeUplinePayment(
            'RebirthSplit',
            $planId,
            $userId,
            $uplinerId,
            $planId,
            '5',
            $perca10,
            1,
            "Admin 10% Upline Upgrade",
            '3'
        );

        /**
         * 3) GLOBAL REGAIN
         */
        $rotatingCommissionAmount = ($amount * $planData->regain_amount) / 100;

        $globalregainsssar = DB::table('global_regain')
            ->where('plan_id', $planId)
            ->where('status', 0)
            ->where('pay_reason_id', '2')
            ->orderby('id', 'ASC')
            ->first();

        if ($globalregainsssar) {
            $parentId     = $globalregainsssar->to_id;
            $globalregain = DB::table('global_regain')
                ->where('plan_id', $planId)
                ->where('status', 0)
                ->where('from_id', $parentId)
                ->where('pay_reason_id', '2')
                ->count();

            if ($globalregain == 4) {
                if ($userId != '2') {
                    $this->storeGlobalPayment(
                        'PlanTree',
                        $planId,
                        $parentId,
                        $userId,
                        1,
                        '2',
                        $rotatingCommissionAmount,
                        1,
                        "Global Regain Income",
                        '3',
                        0
                    );
                }

                DB::table('global_regain')
                    ->where('plan_id', $planId)
                    ->where('to_id', $parentId)
                    ->update(['status' => 1]);

                $total   = ((($amount * 20) / 100) * 5) - $amount;
                $share10 = ($total * 10) / 100;

                $this->storeGlobalPayment(
                    'RebirthSplitMain2',
                    $planId,
                    $parentId,
                    $userId,
                    1,
                    '4',
                    $share10,
                    1,
                    "Upgrade Global Rebirth Income",
                    '3',
                    1
                );
                $this->storeGlobalPayment(
                    'RebirthSplit',
                    $planId,
                    $parentId,
                    1,
                    1,
                    '5',
                    $share10,
                    1,
                    "Admin 10% Global Rebirth Income",
                    '3',
                    1
                );

                // Reset beneficiary's global rebirth amount
                $GBA        = DB::table('users')->where('id', $parentId)->value('global_rebirth_amount');
                $newBalance = $GBA - $amount;
                DB::table('users')->where('id', $parentId)->update(['global_rebirth_amount' => $newBalance]);

                $rebirthData = DB::table('users')->where('id', $parentId)->first();

                if ($rebirthData && $parentId != 1) {
                    $latestId = DB::table('users')->max('id') ?? 0;
                    $newId    = 1000 + ($latestId + 1);
                    $username = "TFC" . str_pad($newId, 4, '0', STR_PAD_LEFT);

                    if ($planId == 1) {
                        // Create new rebirth user
                        $newUId = DB::table('users')->insertGetId([
                            'referral_id'  => $parentId,
                            'user_type_id' => 4,
                            'plan_id'      => $planId,
                            'user_name'    => $username,
                            'name'         => 'Global - Rebirth',
                            'email'        => $rebirthData->email,
                            'phone'        => $rebirthData->phone,
                            'created_at'   => now(),
                            'updated_at'   => now(),
                        ]);

                        DB::table('user_plan')->insert([
                            'user_id'    => $newUId,
                            'plan_id'    => $planId,
                            'amount'     => $amount,
                            'created_by' => auth()->user()->id,
                            'created_at' => now(),
                        ]);

                        $this->repeatPlanPayment($newUId, $amount, $planId, $upgrade);
                    } else {
                        $rebirthUser = DB::table('users')
                            ->where('referral_id', $parentId)
                            ->where('user_type_id', 4)
                            ->first();

                        if ($rebirthUser) {
                            DB::table('user_plan')->insert([
                                'user_id'    => $rebirthUser->id,
                                'plan_id'    => $planId,
                                'amount'     => $amount,
                                'created_by' => auth()->user()->id,
                                'created_at' => now(),
                            ]);

                            $this->repeatPlanPayment($rebirthUser->id, $amount, $planId, $upgrade);
                        }
                    }
                }
            } else {
                if ($userId != '2') {
                    $this->storeGlobalPayment(
                        'PlanTree',
                        $planId,
                        $parentId,
                        $userId,
                        1,
                        '2',
                        $rotatingCommissionAmount,
                        1,
                        "Global Regain Income",
                        '3',
                        0
                    );
                }
            }
        } else {
            // fallback if no global_regain record exists
            \Log::warning("No global_regain entry found for plan_id {$planId}");
            $this->storeGlobalPayment(
                'PlanTree',
                $planId,
                1,
                $userId,
                1,
                '2',
                $rotatingCommissionAmount,
                1,
                "Global Regain Income (Admin fallback)",
                '3',
                0
            );
        }

        return response()->json(['success' => true]);
    });
}

protected function repeatPlanPayment($userId, $amount, $planId, $upgrade)
{
    $planData = DB::table('plans')->where('id', $planId)->first();
    $currentUser = DB::table('users')->where('id', $userId)->first();

    if (!$currentUser) {
        \Log::error("repeatPlanPayment: User not found for user_id {$userId}");
        return;
    }

    return DB::transaction(function () use ($userId, $amount, $planId, $upgrade, $planData, $currentUser) {

        // Store activated plan
        DB::table('user_plan')->insert([
            'plan_id'    => $planId,
            'user_id'    => $userId,
            'amount'     => $amount,
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);

        // Update user plan
        DB::table('users')->where('id', $userId)->update([
            'plan_id'    => $planId,
            'status'     => 1,
            'updated_at' => now(),
        ]);

        /**
         * 1) SPONSOR COMMISSION
         */
        $refralupgradeCommission = ($amount * 5) / 100;
        $referrerCommission      = ($amount * 50) / 100;
        $adminCommission         = ($amount * 5) / 100;

        // Self bonus
        $this->storeSponserPayment(
            'Rebirth',
            $planId,
            $userId,
            $currentUser->referral_id,
            1,
            '4',
            $refralupgradeCommission,
            1,
            "Referral Upgrade Bonus",
            '3'
        );

        // Referrer bonus
        if (!empty($currentUser->referral_id)) {
            $this->storeSponserPayment(
                'RebirthIn',
                $planId,
                $userId,
                $currentUser->referral_id,
                1,
                '1',
                $referrerCommission,
                1,
                "Referral Sponsor Income",
                '3'
            );
        } else {
            $this->storeSponserPayment(
                'RebirthIn',
                $planId,
                $userId,
                1,
                1,
                '1',
                $referrerCommission,
                1,
                "Referral Sponsor Income (Admin)",
                '3'
            );
        }

        // Admin bonus
        if ($adminCommission > 0) {
            $this->storeSponserPayment(
                'Rebirth',
                $planId,
                $userId,
                1,
                1,
                '5',
                $adminCommission,
                1,
                "Admin Bonus Upgrade",
                '3'
            );
        }

        /**
         * 2) UPLINE COMMISSION
         */
        $commissionAmount = ($amount * $planData->upline_amount) / 100;
        $uplinerId        = $this->getUpline($currentUser, $planId) ?: 1;

        $perca10 = ($commissionAmount * 10) / 100;

        $this->storeUplinePayment(
            'Upline',
            $planId,
            $userId,
            $uplinerId,
            $planId,
            '3',
            $commissionAmount,
            1,
            "Upline Sponsor",
            '3'
        );
        $this->storeUplinePayment(
            'RebirthSplitMain2',
            $planId,
            $userId,
            $uplinerId,
            $planId,
            '3',
            $perca10,
            1,
            "Upline Sponsor Income",
            '3'
        );
        $this->storeUplinePayment(
            'RebirthSplit',
            $planId,
            $userId,
            $uplinerId,
            $planId,
            '5',
            $perca10,
            1,
            "Admin 10% Upline Upgrade",
            '3'
        );

        /**
         * 3) GLOBAL REGAIN
         */
        $rotatingCommissionAmount = ($amount * $planData->regain_amount) / 100;

        $globalregainsssar = DB::table('global_regain')
            ->where('plan_id', $planId)
            ->where('status', 0)
            ->where('pay_reason_id', '2')
            ->orderby('id', 'ASC')
            ->first();

        if ($globalregainsssar) {
            $parentId     = $globalregainsssar->to_id;
            $globalregain = DB::table('global_regain')
                ->where('plan_id', $planId)
                ->where('status', 0)
                ->where('from_id', $parentId)
                ->where('pay_reason_id', '2')
                ->count();

            if ($globalregain == 4) {
                if ($userId != '2') {
                    $this->storeGlobalPayment(
                        'PlanTree',
                        $planId,
                        $parentId,
                        $userId,
                        1,
                        '2',
                        $rotatingCommissionAmount,
                        1,
                        "Global Regain Income",
                        '3',
                        0
                    );
                }

                DB::table('global_regain')
                    ->where('plan_id', $planId)
                    ->where('to_id', $parentId)
                    ->update(['status' => 1]);

                $total   = ((($amount * 20) / 100) * 5) - $amount;
                $share10 = ($total * 10) / 100;

                $this->storeGlobalPayment(
                    'RebirthSplitMain2',
                    $planId,
                    $parentId,
                    $userId,
                    1,
                    '4',
                    $share10,
                    1,
                    "Upgrade Global Rebirth Income",
                    '3',
                    1
                );
                $this->storeGlobalPayment(
                    'RebirthSplit',
                    $planId,
                    $parentId,
                    1,
                    1,
                    '5',
                    $share10,
                    1,
                    "Admin 10% Global Rebirth Income",
                    '3',
                    1
                );

                // Reset beneficiary's global rebirth amount
                $GBA        = DB::table('users')->where('id', $parentId)->value('global_rebirth_amount');
                $newBalance = $GBA - $amount;
                DB::table('users')->where('id', $parentId)->update(['global_rebirth_amount' => $newBalance]);

                $rebirthData = DB::table('users')->where('id', $parentId)->first();

                if ($rebirthData && $parentId != 1) {
                    $latestId = DB::table('users')->max('id') ?? 0;
                    $newId    = 1000 + ($latestId + 1);
                    $username = "TFC" . str_pad($newId, 4, '0', STR_PAD_LEFT);

                    if ($planId == 1) {
                        // Create new rebirth user
                        $newUId = DB::table('users')->insertGetId([
                            'referral_id'  => $parentId,
                            'user_type_id' => 4,
                            'plan_id'      => $planId,
                            'user_name'    => $username,
                            'name'         => 'Global - Rebirth',
                            'email'        => $rebirthData->email,
                            'phone'        => $rebirthData->phone,
                            'created_at'   => now(),
                            'updated_at'   => now(),
                        ]);

                        DB::table('user_plan')->insert([
                            'user_id'    => $newUId,
                            'plan_id'    => $planId,
                            'amount'     => $amount,
                            'created_by' => auth()->user()->id,
                            'created_at' => now(),
                        ]);

                        $this->repeatPlanPayment($newUId, $amount, $planId, $upgrade);
                    } else {
                        $rebirthUser = DB::table('users')
                            ->where('referral_id', $parentId)
                            ->where('user_type_id', 4)
                            ->first();

                        if ($rebirthUser) {
                            DB::table('user_plan')->insert([
                                'user_id'    => $rebirthUser->id,
                                'plan_id'    => $planId,
                                'amount'     => $amount,
                                'created_by' => auth()->user()->id,
                                'created_at' => now(),
                            ]);

                            $this->repeatPlanPayment($rebirthUser->id, $amount, $planId, $upgrade);
                        }
                    }
                }
            } else {
                if ($userId != '2') {
                    $this->storeGlobalPayment(
                        'PlanTree',
                        $planId,
                        $parentId,
                        $userId,
                        1,
                        '2',
                        $rotatingCommissionAmount,
                        1,
                        "Global Regain Income",
                        '3',
                        0
                    );
                }
            }
        } else {
            // fallback if no global_regain record exists
            \Log::warning("No global_regain entry found for plan_id {$planId}");
            $this->storeGlobalPayment(
                'PlanTree',
                $planId,
                1,
                $userId,
                1,
                '2',
                $rotatingCommissionAmount,
                1,
                "Global Regain Income (Admin fallback)",
                '3',
                0
            );
        }

        return true;
    });
}

   
}