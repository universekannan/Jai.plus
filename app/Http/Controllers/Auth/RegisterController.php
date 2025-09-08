<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm($referral = null)
    {
        return view('admin.auth.register', [
            'referral_id' => $referral
        ]);
    }

    public function adminregister(Request $request)
    {

    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required',
        'phone'    => 'required',
        'whatsapp_number'    => 'required',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $latestId = User::max('id') ?? 0; 
    $new = $latestId - 1; 
    $newId = $new + 1001; 
    $formattedId = str_pad($newId, 4, '0', STR_PAD_LEFT); 
    $username = "TFC" . $formattedId; 
//print_r($username);die;
    $referralId = strtoupper(substr($request->name, 0, 3)) . rand(1000, 9999);


    if ($request->filled('referral_id')) {
        $referrer = User::where('user_name', $request->referral_id)->first();
        if ($referrer) {
            $referrerId = $referrer->id; 
        } else {
            return redirect()->back()->with('error', 'Referral ID is invalid');
        }
    }
    else{
        $referrerId = 1;
    }

    $user = User::insert([
        'name'             => $request->name,
        'email'            => $request->email,
        'phone'            => $request->country_code.''.$request->phone,
        'whatsapp_number'  => $request->country_code.''.$request->whatsapp_number,
        'password'         => Hash::make($request->password),
        'cpassword'        => $request->password,
        'user_name'        => $username,
        'referral_id'      => $referrerId,
        'wallet_address'   => $request->wallet_address,
        'user_type_id'     => 3,
        'status'        => 1,
        'created_at'       => now(),
    ]);

    $email = array("email" => $request->email, "password" => $request->password);
    if(Auth::attempt($email)) {
        Auth::loginUsingId(Auth::user()->id);
        $usertype_id = Auth::user()->usertype_id;
        return redirect('/admin/dashboard')->with('success','Register Successfully');
    }else{
        $message = 'Login Failed';
        return redirect('/admin')->with('message',$message);
    }

    return redirect('/dashboard');
}
    public function checkemailreg(Request $request)
    {
        $email = $request->email;
        $exists = DB::table('users')->where('email', $email)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function checkphoneuserreg(Request $request)
    {
        $phone = $request->phone;
        $exists = DB::table('users')->where('phone', $phone)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function checkwhatsapp_numberuserreg(Request $request)
    {
        $whatsapp_number = $request->whatsapp_number;
        $exists = DB::table('users')->where('whatsapp_number', $whatsapp_number)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function checkwalletreg(Request $request)
    {
        $wallet = $request->wallet;
        $exists = DB::table('users')->where('wallet_address', $wallet)->exists();
        return response()->json(['exists' => $exists]);
    }
}