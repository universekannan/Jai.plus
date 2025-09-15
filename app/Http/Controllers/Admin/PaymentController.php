<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Artisan;
use Log;
use Auth;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
 public function __construct()
  {
    $this->middleware( 'auth' );
  }


  public function adminPayment()
  {
    $adminQuery = DB::table('admin_income')
        ->join('users as from_users', 'from_users.id', '=', 'admin_income.from_id')
        ->select(
            'admin_income.*',
            'from_users.user_name as from_username',
            'from_users.name',
        )
        ->orderBy('admin_income.id', 'desc')
        ->get();


    return view('admin.payment.admin_payment', [
        'adminQuery' => $adminQuery,
    ]);
  }



  public function sponserlist(Request $request)
    {
        $from = $request->input('from');   
        $to = $request->input('to');       
        $search = $request->input('search', '');
        $pageper = $request->input('pageper', 25);

        $spornsers = DB::table('sponser_income')
            ->join('payment_reason', 'sponser_income.pay_reason_id', '=', 'payment_reason.id')
            ->join('users as from_users', 'from_users.id', '=', 'sponser_income.from_id')
            ->join('plans', 'plans.id', '=', 'sponser_income.plan_id')
            ->select(
                'sponser_income.*',
                'payment_reason.name as reason_name',
                'from_users.user_name as from_username',
                'from_users.name as from_name',
                'plans.plan_amount',
            )
            ->where('sponser_income.pay_reason_id', 1) 
            ->when(auth()->user()->id != 1, function ($query) {
                $query->where('sponser_income.to_id', auth()->user()->id);
            })
            ->when($from, function ($query) use ($from) {
                $query->whereDate('sponser_income.created_at', '>=', $from);
            })
            ->when($to, function ($query) use ($to) {
                $query->whereDate('sponser_income.created_at', '<=', $to);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('sponser_income.from_id', 'like', "%$search%")
                    ->orWhere('sponser_income.to_id', 'like', "%$search%")
                    ->orWhere('sponser_income.amount', 'like', "%$search%")
                    ->orWhere('payment_reason.name', 'like', "%$search%")
                    ->orWhere('from_users.name', 'like', "%$search%")
                    ->orWhere('to_users.name', 'like', "%$search%");
                });
            })
            ->orderBy('sponser_income.id', 'desc')
            ->paginate($pageper);

        $plans = DB::table('plans')->orderBy('id', 'asc')->get();

        return view('admin.payment.spornser', compact('spornsers', 'from', 'to', 'search', 'pageper', 'plans'));
    }

  

public function global_rebirth_list(Request $request)
{
    $login = Auth::user()->id;
    $from = $request->input('from', date('Y-m-01'));
    $to = $request->input('to', date('Y-m-d'));
    $search = $request->input('search', '');
    $pageper = $request->input('pageper', 25);

    $wallet = DB::table('global_regain')
        ->join('payment_reason', 'global_regain.pay_reason_id', '=', 'payment_reason.id')
        ->join('users as from_users', 'from_users.id', '=', 'global_regain.from_id')
        ->join('users as to_users', 'to_users.id', '=', 'global_regain.to_id')
        ->select(
            'global_regain.*',
            'payment_reason.name as reason_name',
            'from_users.user_name as from_username',
            'to_users.user_name as to_username'
        )
        ->where('global_regain.pay_reason_id', 2)
        ->when(auth()->user()->id != 1, function ($query) {
            $query->where('global_regain.to_id', auth()->user()->id);
        })
        ->when($from, function ($query) use ($from) {
            $query->whereDate('global_regain.created_at', '>=', $from);
        })
        ->when($to, function ($query) use ($to) {
            $query->whereDate('global_regain.created_at', '<=', $to);
        })
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('global_regain.from_id', 'like', "%$search%")
                  ->orWhere('global_regain.to_id', 'like', "%$search%")
                  ->orWhere('global_regain.amount', 'like', "%$search%")
                  ->orWhere('payment_reason.name', 'like', "%$search%")
                  ->orWhere('from_users.name', 'like', "%$search%")
                  ->orWhere('to_users.name', 'like', "%$search%");
            });
        })
        ->where('global_regain.pay_reason_id', 2)
        ->orderBy('global_regain.id', 'desc')
        ->paginate($pageper);
		
        $plans = DB::table('plans')->orderBy('id', 'asc')->get();
		
            $Userplans = DB::table( 'user_plan' )->select( 'user_plan.*', 'plans.*', 'plans.id as plansId', 'plans.plan_name', 'plans.plan_amount')
            ->Join( 'plans', 'plans.id', '=', 'user_plan.plan_id' )
            ->where( 'user_plan.user_id', $login )
			->orderBy( 'user_plan.id', 'ASC' )->get();
			
    return view('admin.payment.global_rebirth', compact('Userplans','wallet', 'from', 'to', 'search', 'pageper','plans'));
}

public function getData(Request $request)
{
    $planId = $request->plan_id;

    $data = DB::table('global_regain')
        ->select('users.name','users.user_name','global_regain.amount','global_regain.created_at')
        ->join('users','users.id','=','global_regain.to_id')
        ->where('global_regain.pay_reason_id', 2)
        ->where('global_regain.plan_id', $planId)
        ->get();

    return response()->json($data);
}

  
 
  

  public function upline_spornser(Request $request)
{
    $from = $request->input('from', date('Y-m-01'));
    $to = $request->input('to', date('Y-m-d'));
    $search = $request->input('search', '');
    $pageper = $request->input('pageper', 25);

    $query = DB::table('upline_income')
        ->join('payment_reason', 'payment_reason.id', '=', 'upline_income.pay_reason_id')
        ->join('users as from_users', 'from_users.id', '=', 'upline_income.from_id')
        ->select(
            'upline_income.*',
            'payment_reason.name as reasonname',
            'from_users.user_name as from_username',
        )
        ->where('upline_income.pay_reason_id', 3)
        ->when($from, function ($q) use ($from) {
            $q->whereDate('upline_income.created_at', '>=', $from);
        })
        ->when($to, function ($q) use ($to) {
            $q->whereDate('upline_income.created_at', '<=', $to);
        })
        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('upline_income.from_id', 'like', "%$search%")
                    ->orWhere('upline_income.to_id', 'like', "%$search%")
                    ->orWhere('upline_income.amount', 'like', "%$search%")
                    ->orWhere('from_users.name', 'like', "%$search%")
                    ->orWhere('to_users.name', 'like', "%$search%")
                    ->orWhere('payment_reason.name', 'like', "%$search%");
            });
        });

    if (auth()->user()->id != 1) {
        $query->where('upline_income.to_id', auth()->user()->id);
    }

    $upline_spornsers = $query->orderBy('upline_income.id', 'desc')->paginate($pageper);
        $plans = DB::table('plans')->orderBy('id', 'asc')->get();

    return view('admin.payment.upline_spornser', compact('upline_spornsers', 'from', 'to', 'search', 'pageper','plans'));
}

  

	public function wallet(Request $request)
	{
		$globalregain = DB::table('global_regain')
			->where('pay_reason_id', '2')
            ->where('widtdrawal_status', '0')
			->where('to_id', auth()->user()->id)
			->sum('amount');
			
			
		  return view('admin.payment.wallet', compact( 'globalregain'));
	}



public function updatewallet_sponser(Request $request)
{
   
    $userId = auth()->id();

    $globalregain = DB::table('global_regain')
        ->where('to_id', $userId)
        ->where('widtdrawal_status', '0')
        ->where('pay_reason_id', '2')
        ->sum('amount');

    if ($globalregain > 0) {
     
        DB::table('users')
            ->where('id', $userId)
            ->increment('wallet', $globalregain);

      
        DB::table('global_regain')
            ->where('to_id', $userId)
            ->where('widtdrawal_status', '0')
            ->where('pay_reason_id', '2')
            ->update(['widtdrawal_status' => '1']);
    }


    DB::table('wallet')->insert([
        'user_id'           => auth()->user()->id,
        'wallet_amount'     => $request->amount,
        'type'              => 'global_regain',
        'status'            => 1,
        'created_at'        => now(),
    ]);


    return redirect()->back()->with('success', 'Globalregain income moved successfully!');
}


  
  public function withdrawal($status)
  {
      $user_id = Auth::id();
  
      $query = DB::table('withdrawal')
          ->join('users', 'withdrawal.from_id', '=', 'users.id')
          ->select('withdrawal.*', 'users.name as from_name') 
          ->where('withdrawal.status', $status)
          ->orderBy('withdrawal.id', 'asc');
  
      if (Auth::user()->user_type_id != 1) {
          $query->where('withdrawal.from_id', $user_id);
      }
  
      $withdrawal = $query->paginate(25);
  
      return view("admin.payment.withdrawal", compact('withdrawal'));
  }
  

    public function addWithdrawal(Request $request)
    {
        $user = Auth::user();
        $adminId = 1; 
        if ($request->withdrawal_amount > $user->wallet) {
            return back()->withErrors(['withdrawal_amount' => 'Insufficient wallet balance.']);
        }



        DB::table('withdrawal')->insert([
            'from_id'           => $user->id,
            'to_id'             => $adminId,
            'withdrawal_amount' => $request->withdrawal_amount,
            'status'            => 1,
            'message'           => $request->message,
            'created_at'        => now(),
        ]);

        

        return redirect()->back()->with('success', 'Withdrawal request submitted successfully.');
    }

    public function updateWithdrawal(Request $request)
{
    $withdrawal = DB::table('withdrawal')->where('id', $request->withdrawal_id)->first();

    if (!$withdrawal) {
        return redirect()->back()->with('error', 'Withdrawal request not found.');
    }

    $user = DB::table('users')->where('id', $withdrawal->from_id)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    $newBalance = $user->wallet; // Default balance (unchanged)

    // If approved, deduct balance
    if ($request->status == 2) {
        if ($user->wallet >= $withdrawal->withdrawal_amount) {
            $newBalance = $user->wallet - $withdrawal->withdrawal_amount;

            // Update user's wallet
            DB::table('users')->where('id', $user->id)->update([
                'wallet'     => $newBalance,
                'updated_at' => now(),
            ]);
        } else {
            return redirect()->back()->with('error', 'Insufficient balance.');
        }
    }

    // Update withdrawal record
    DB::table('withdrawal')->where('id', $request->withdrawal_id)->update([
        'status'      => $request->status,
        'new_balance' => $newBalance,
        'updated_at'  => now(),
    ]);

    return redirect()->back()->with('success', 'Withdrawal status updated successfully.');
}



public function upgrade(Request $request)
{
    $from = $request->input('from', date('Y-m-01'));
    $to = $request->input('to', date('Y-m-d'));
    $search = $request->input('search', '');

    
    $sponserQuery = DB::table('sponser_income')
        ->leftjoin('users as from_users', 'from_users.id', '=', 'sponser_income.from_id')
        ->leftjoin('payment_reason', 'payment_reason.id', '=', 'sponser_income.pay_reason_id')
        ->select(
            'sponser_income.*',
            'from_users.user_name as from_username',
            'from_users.name',
            'payment_reason.name as reasonname'
        )
        ->where('sponser_income.pay_reason_id', 4) 
        ->when(auth()->user()->id != 1, function ($query) {
            $query->where('sponser_income.to_id', auth()->user()->id);
        })
        ->orderBy('sponser_income.id', 'desc')
        ->get();

    $uplineQuery = DB::table('upline_income')
        ->join('users as from_users', 'from_users.id', '=', 'upline_income.from_id')
        ->join('payment_reason', 'payment_reason.id', '=', 'upline_income.pay_reason_id')
        ->select(
            'upline_income.*',
            'from_users.user_name as from_username',
            'from_users.name',
            'payment_reason.name as reasonname'
        )
        ->where('upline_income.pay_reason_id', 3) 
        ->when(auth()->user()->id != 1, function ($query) {
            $query->where('upline_income.to_id', auth()->user()->id);
        })
        ->when($from, function ($query) use ($from) {
            $query->whereDate('upline_income.created_at', '>=', $from);
        })
        ->when($to, function ($query) use ($to) {
            $query->whereDate('upline_income.created_at', '<=', $to);
        })
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('upline_income.from_id', 'like', "%$search%")
                ->orWhere('upline_income.to_id', 'like', "%$search%")
                ->orWhere('upline_income.amount', 'like', "%$search%")
                ->orWhere('from_users.name', 'like', "%$search%")
                ->orWhere('to_users.name', 'like', "%$search%")
                ->orWhere('payment_reason.name', 'like', "%$search%");
            });
        })
        ->orderBy('upline_income.id', 'desc')
        ->get();

    $globalQuery = DB::table('global_regain')
        ->join('users as from_users', 'from_users.id', '=', 'global_regain.from_id')
        ->join('payment_reason', 'payment_reason.id', '=', 'global_regain.pay_reason_id')
        ->select(
            'global_regain.*',
            'from_users.user_name as from_username',
            'from_users.name',
            'payment_reason.name as reasonname'
        )
        ->where('global_regain.pay_reason_id', 4) 
        ->when(auth()->user()->id != 1, function ($query) {
            $query->where('global_regain.to_id', auth()->user()->id);
        })
        ->when($from, function ($query) use ($from) {
            $query->whereDate('global_regain.created_at', '>=', $from);
        })
        ->when($to, function ($query) use ($to) {
            $query->whereDate('global_regain.created_at', '<=', $to);
        })
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('global_regain.from_id', 'like', "%$search%")
                ->orWhere('global_regain.to_id', 'like', "%$search%")
                ->orWhere('global_regain.amount', 'like', "%$search%")
                ->orWhere('from_users.name', 'like', "%$search%")
                ->orWhere('to_users.name', 'like', "%$search%")
                ->orWhere('payment_reason.name', 'like', "%$search%");
            });
        })
        ->orderBy('global_regain.id', 'desc')
        ->get();

    return view('admin.payment.upgrade', [
        'sponserQuery' => $sponserQuery,
        'uplineQuery' => $uplineQuery,
        'globalQuery' => $globalQuery,
        'from' => $from,
        'to' => $to,
        'search' => $search
    ]);
}


}