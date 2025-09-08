<?php
namespace App\Http\Controllers\Admin;
use Auth;
use Hash;
use App\WalletHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'auth' );
    }

    public function index( $from, $to)
    {
        $balance =  Auth::user()->wallet;
        $login = Auth::user()->id;
        $referral_id = Auth::user()->referral_id;
        $user_id = Auth::user()->id;

            $wallet = DB::table( 'payment' )->select( 'payment.*', 'users.*', 'payment.id as paymentId')
            ->Join( 'users', 'users.id', '=', 'payment.to_id' )
            ->where( 'payment.from_id', $login )
            ->where( 'paydate', '>=', $from )->where( 'paydate', '<=', $to )
			->orderBy( 'payment.paydate', 'Desc' )->paginate(10);
			
        $sql = "Select * from `users` where `id` = 1 order by `id` desc limit 1 ";
    $referencedata = DB::select( DB::raw( $sql ) );

    if ( Auth::user()->user_type_id == 1 ) {
        $sql = 'Select * from `users`';
    } else if ( Auth::user()->user_type_id == 2 ){
        $nav_id = Auth::user()->nav_id;
        $sql = "select * from users where nav_id= $nav_id";
    } else {
        $sql = "Select * from `users` where `referral_id` = $user_id";
    }
    $userpayment = DB::select( DB::raw( $sql ) );

    $sql = "select status from request_payment where from_id=$login and status='Pending'";
    $paymentrequest =  DB::select( DB::raw( $sql ));
    $status ="";
    if(count($paymentrequest) > 0){
        $status = $paymentrequest[0]->status;
    }
    return view( 'wallet/index', compact( 'wallet', 'referencedata', 'userpayment', 'from', 'to', 'status','balance' ) );
}

public function walletamount()
{
    if ( Auth::user()->user_type_id == 1 ) {
        $walletamount = DB::table( 'users' )->select('users.full_name','users.phone','users.id','wallet_users.wallet','wallet_users.deposit','wallet_users.commission')->join('wallet_users','wallet_users.username','users.username')->orderBy( 'wallet_users.wallet', 'Desc' )->get();
    }
        //dd($walletamount);
    return view( 'wallet/walletamount', compact('walletamount') );
}

public function allwallet( $from, $to)
{
    $login = Auth::user()->id;
    $user_id = Auth::user()->id;
    if ( Auth::user()->user_type_id == 1 ) {
        $wallet = DB::table( 'payment' )->orderBy( 'paydate', 'Desc' )->where( 'paydate', '>=', $from )->where( 'paydate', '<=', $to )->get();
    }

    return view( 'wallet/allwallet', compact( 'wallet', 'from', 'to' ) );
}

public function superadminaddwallet( Request $request )
{
    $from = date('Y-m-d' ,strtotime('-1 days'));
    $to =  date('Y-m-d');
    $amount = $request->fundamount;
    $login_id = Auth::user()->id;
    $old_balanse = Auth::user()->wallet;
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $ad_info = 'Fund Transfer';
    $service_status = 'IN Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,old_balanse,project_id) values ('$login_id','$login_id','$login_id','$amount','$ad_info', '$service_status','$time','$date','$old_balanse','1')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $amount where id = '1'";
    DB::update( DB::raw( $sql ) );
    return redirect( "wallet/$from/$to" );
}

public function addwallet( Request $request )
{
    $from = date('Y-m-d' ,strtotime('-1 days'));
    $to =  date('Y-m-d');
    $to_user = $request->user_id;
    $amount = $request->transfer_payment;
    $login_id = Auth::user()->id;
    $old_balanse = Auth::user()->wallet;
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $ad_info = 'Fund Transfer';
    $ad_info2 = "FundTransfer";
    $service_status = 'Out Payment';
    $message = 'Fund Transfer';
    $sql = "select * from users where id='$to_user'";
    $result =  DB::select( DB::raw( $sql ));
    $user_wallet = $result[0]->wallet;
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,ad_info2,message,old_balanse,project_id) values ('$login_id','$login_id','$to_user','$amount','$ad_info', '$service_status','$time','$date','$ad_info2','$message','$old_balanse','1')";
    DB::insert( DB::raw( $sql ) );
    $insertid = DB::getPdo()->lastInsertId();
    $sql = "update payment set pay_id = $insertid where id = $insertid";
    DB::update( DB::raw( $sql ) );
    $sql = "update users set wallet=wallet+$amount where id='$to_user'";
    DB::update($sql);
    $service_status = 'IN Payment';
    $ad_info2 = "FundTransfer";
    $message = "Fund Transfer";
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,ad_info2,message,old_balanse,project_id) values ('$login_id','$to_user','$login_id','$amount','$ad_info', '$service_status','$time','$date','$insertid','$ad_info2','$message','$user_wallet','1')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $amount where id = $login_id";
    DB::update( DB::raw( $sql ) );
    return redirect( "wallet/$from/$to" );
}

public function servicepaymentdelete( $payid ) {
    $from = date('Y-m-d' ,strtotime('-1 days'));
    $to =  date('Y-m-d');
    $sql = "select * from payment where pay_id='$payid' and ad_info2='ServicePayment'";
    $result =  DB::select( DB::raw( $sql ));
    $service_status = $result[0]->service_status;
    $amount = $result[0]->amount;
    $from_user = $result[0]->from_id;
    $to_user = $result[0]->to_id;
    $sql1 = "select sum(amount) as sumamount from payment where pay_id='$payid' and ad_info2='ServicePayment'";
    $result =  DB::select( DB::raw( $sql1 ));
    $sumamount = $result[0]->sumamount;
    $sql = "update users set wallet = wallet + $sumamount where id = $from_user";
    DB::update( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $amount where id = $to_user";
    DB::update( DB::raw( $sql ) );
    $sql = "delete from payment where pay_id=$payid";
    DB::delete( DB::raw( $sql ) );
    $sql = "delete from payments where id=$payid";
    DB::delete( DB::raw( $sql ) );
    return redirect( "wallet/$from/$to" )->with( 'success', 'Payment Deleted Successfully' );
}

public function transferpaymentdelete( $payid ) {
    $from = date('Y-m-d' ,strtotime('-1 days'));
    $to =  date('Y-m-d');
    $sql = "select * from payment where pay_id='$payid' and ad_info2='FundTransfer'";
    $result =  DB::select( DB::raw( $sql ));
    $service_status = $result[0]->service_status;
    $amount = $result[0]->amount;
    $from_user = $result[0]->from_id;
    $to_user = $result[0]->to_id;
    $sql = "update users set wallet = wallet + $amount where id = $from_user";
    DB::update( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $amount where id = $to_user";
    DB::update( DB::raw( $sql ) );
    $sql = "delete from payment where pay_id=$payid";
    DB::delete( DB::raw( $sql ) );
    return redirect( "wallet/$from/$to" )->with( 'success', 'Payment Deleted Successfully' );
}


public function requestamount(Request $request) {

    $amount = $request->amount;
    $login_id = Auth::user()->id;
    $device_id = "";
    if ( Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 3) {
       $to_user = 1;
       $device_token = DB::table( 'users' )->where( 'id', '=', $to_user )->get();
       $device_id = $device_token[0]->device_id;
   } else {
       $to_user = Auth::user()->referral_id;
       $device_token = DB::table( 'users' )->where( 'id', '=', $to_user )->get();
       $device_id = $device_token[0]->device_id;
   }

   $date = date( 'Y-m-d' );
   $time = date( 'H:i:s' );
   $ad_info = 'Fund Transfer';
   $ad_info2 = "FundTransfer";
   $service_status = 'RequestAmount';
   $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,ad_info2,project_id) values ('$login_id','$login_id','$to_user','$amount','$ad_info', '$service_status','$time','$date','$ad_info2','1')";
   DB::insert( DB::raw( $sql ) );

   $insertid = DB::getPdo()->lastInsertId();
   $paid_image ="";
   if($request->paid_image != null){
       $paid_image = $insertid.'.'.$request->file('paid_image')->extension();
       $filepath = public_path('upload'.DIRECTORY_SEPARATOR.'paidimage'.DIRECTORY_SEPARATOR);
       move_uploaded_file($_FILES['paid_image']['tmp_name'], $filepath.$paid_image);
       $sql = "update payment set paid_image='$paid_image' where id = $insertid";
       DB::update(DB::raw($sql));
   }
   $url = 'https://fcm.googleapis.com/fcm/send';
   //'to' for single user
   //'registration_ids' for multiple users
   $weburl =  '';
   //base_url( 'payments/pending' );
   $message = "You Have a Request of Amount"." ". $amount;

   $title = 'Nalavaryam';
   $body = $message;
   $icon = 'Nalavaryam';
   $click_action = $weburl;

   if ( isset( $title ) && !empty( $title ) )
   {
     $fields = array(
         'to'=>$device_id,
         'notification'=>array(
             'body'=>$body,
             'title'=>$title,
             'icon'=>$icon,
             'click_action'=>$click_action
         )
     );
       //print_r( $fields );
       //exit;

     $headers = array(
         'Authorization: key=AAAABIWWI_c:APA91bGf79FDnwnPw1FgpFkVlryHBvf3F1hhi0uwfRPuZRV7jEKu4Hggezwbl61FBxpkeauYs13Gbmsu5xzZxQcGVKRs7k8LJOUZoUI7fw2QkZGBrzNW_r7192r6DrzV2X269LEzz27M',
         'Content-Type:application/json'
     );

     $ch = curl_init();
     curl_setopt( $ch, CURLOPT_URL, $url );
     curl_setopt( $ch, CURLOPT_POST, true );
     curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
     $result = curl_exec( $ch );
     curl_close( $ch );

     dd( $result );
 }


 return redirect( "viewrequestamount" )->with( 'success', 'Request Amount  Successfully' );
}




public function viewrequestamount()
{
    $balance =  Auth::user()->wallet;
    $login = Auth::user()->id;
    $referral_id = Auth::user()->referral_id;
    $service_status = 'RequestAmount';
	if(Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2){
       $sql = "select a.*, b.full_name from request_payment a, users b where (a.from_id=$login or a.to_id = $login ) and a.from_id = b.id order by a.status desc";
	} else {
       $sql = "select a.*, b.full_name from request_payment a, users b where (a.from_id=$login or a.to_id = $login ) and a.to_id = b.id order by a.status desc";
    }
    //$sql = "select * from request_payment where from_id=$login or to_id = $login order by `status` desc";
    //$sql = "select *, b.full_name as from_name, c.full_name as to_name from request_payment a, users b, users c where a.from_id=b.id and a.to_id = c.id and a.from_id=$login or a.to_id = $login";

    $paymentrequest =  DB::select( DB::raw( $sql ));

    if(Auth::user()->user_type_id == 1 ){
        $sql = "Select * from `users` where `id` = 1 order by `id` desc limit 1 ";
    }elseif(Auth::user()->user_type_id == 2){
        $sql = "Select * from `users` where `id` = $login order by `id` desc limit 1 ";
    }else{
        $sql = "Select * from `users` where `id` = $referral_id order by `id` desc limit 1 ";
    }
    $referencedata = DB::select( DB::raw( $sql ) );

    return view( 'wallet.viewrequestamount', compact( 'paymentrequest','referencedata','balance') );
}

public function requestamount_approve(Request $request) {
    $amount = $request->amount;
    $from_id = $request->from_id;
    $row_id = $request->row_id;
    $login_id = Auth::user()->id;
    $old_balanse = Auth::user()->wallet;
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $status = 'Approved';
	$user = DB::table('users')->where('id', $from_id)->first();

	if ($user) {
		$user_wallet = $user->wallet;
	}
	
	DB::table('request_payment')
		->where('id', $row_id)
		->update(['status' => $status]);
		
    $service_status = 'Out Payment';
    $ad_info = 'Fund Transfer';
	
	DB::table('payment')->insert([
		'log_id'        => $login_id,
		'from_id'       => $login_id,
		'to_id'         => $from_id,
		'amount'        => $amount,
		'ad_info'       => $ad_info,
		'service_status'=> $service_status,
		'time'          => $time,
		'paydate'       => $date,
		'pay_id'        => $row_id,
		'old_balanse'   => $old_balanse,
		'project_id'    => 1, // Integer value
	]);

	DB::table('users')
		->where('id', $from_id)
		->increment('wallet', $amount);
		
    $service_status = 'IN Payment';
    $ad_info = 'Fund Transfer';
	
	DB::table('payment')->insert([
		'log_id'        => $login_id,
		'from_id'       => $from_id,
		'to_id'         => $login_id,
		'amount'        => $amount,
		'ad_info'       => $ad_info,
		'service_status'=> $service_status,
		'time'          => $time,
		'paydate'       => $date,
		'pay_id'        => $row_id,
		'old_balanse'   => $user_wallet,
		'project_id'    => 1, // Integer value
	]);

	DB::table('users')
		->where('id', $login_id)
		->decrement('wallet', $amount);
		
    $device_id = "";
    $device_token = DB::table( 'users' )->where( 'id', '=', $from_id )->get();
    $device_id = $device_token[0]->device_id;

    $url = 'https://fcm.googleapis.com/fcm/send';
   //'to' for single user
   //'registration_ids' for multiple users
    $weburl =  '';
   //base_url( 'payments/pending' );
    $message = "You Have Received Amount"." ". $amount." . ".'Please Check Your Wallet.';

    $title = 'Nalavaryam';
    $body = $message;
    $icon = 'Nalavaryam';
    $click_action = $weburl;

    if ( isset( $title ) && !empty( $title ) )
    {
     $fields = array(
         'to'=>$device_id,
         'notification'=>array(
             'body'=>$body,
             'title'=>$title,
             'icon'=>$icon,
             'click_action'=>$click_action
         )
     );
       //print_r( $fields );
       //exit;

     $headers = array(
         'Authorization: key=AAAABIWWI_c:APA91bGf79FDnwnPw1FgpFkVlryHBvf3F1hhi0uwfRPuZRV7jEKu4Hggezwbl61FBxpkeauYs13Gbmsu5xzZxQcGVKRs7k8LJOUZoUI7fw2QkZGBrzNW_r7192r6DrzV2X269LEzz27M',
         'Content-Type:application/json'
     );

     $ch = curl_init();
     curl_setopt( $ch, CURLOPT_URL, $url );
     curl_setopt( $ch, CURLOPT_POST, true );
     curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
     $result = curl_exec( $ch );
     curl_close( $ch );

       //print_r( $registrationIds );
 }
 return redirect( "viewrequestamount" )->with( 'success', 'Request Amount  Successfully' );
}

public function declinerequest_payment($toid) {

    $sql = "update request_payment set status = 'Declined' where id = $toid";
    DB::update( DB::raw( $sql ) );

    return redirect( "viewrequestamount" )->with('success', 'Request Amount Declined  Successfully');
}

public function paymentrequest(Request $request){
    $nav_id = Auth::user()->nav_id;
    $from_id = Auth::user()->id;
    $wallet = Auth::user()->wallet;
      $amount=$request->amount;  
      $confirm = DB::table('request_payment')->insert([
          'nav_id' => $nav_id,
          'from_id' => $from_id,
          'to_id' => $request->to_id,
          'amount' => $amount,
          'status' => 'Pending',
          'req_date' => date("Y-m-d"),
          'req_time' => date("Y-m-d H:i:s"),
      ]);
      $insertid = DB::getPdo()->lastInsertId();

      $paid_image = "";
      if ($request->paid_image != null) {
          $paid_image = $insertid.'.'.$request->file('paid_image')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'paidimage' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['paid_image']['tmp_name'], $filepath . $paid_image);
      }
      $image = DB::table('request_payment')->where('id', $insertid)->update([
          'req_image' => $paid_image,
      ]);

      $device_id = "";
      if ( Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 3) {
       $to_user = 1;
       $device_token = DB::table( 'users' )->where( 'id', '=', $to_user )->get();
       $device_id = $device_token[0]->device_id;
   } else {
       $to_user = Auth::user()->referral_id;
       $device_token = DB::table( 'users' )->where( 'id', '=', $to_user )->get();
       $device_id = $device_token[0]->device_id;
   } 
   
   $url = 'https://fcm.googleapis.com/fcm/send';
   $title = 'Nalavaryam';
   $body = "You Have a Request of Amount ". $amount;
   $icon = 'Nalavaryam';
   $click_action = "https://nalavariyam.com/viewrequestamount";

   $fields = array(
     'to'=>$device_id,
     'notification'=>array(
         'body'=>$body,
         'title'=>$title,
         'icon'=>$icon,
         'click_action'=>$click_action
     )
 );
   $headers = array(
     'Authorization: key=AAAABIWWI_c:APA91bGf79FDnwnPw1FgpFkVlryHBvf3F1hhi0uwfRPuZRV7jEKu4Hggezwbl61FBxpkeauYs13Gbmsu5xzZxQcGVKRs7k8LJOUZoUI7fw2QkZGBrzNW_r7192r6DrzV2X269LEzz27M',
     'Content-Type:application/json'
 );
   $ch = curl_init();
   curl_setopt( $ch, CURLOPT_URL, $url );
   curl_setopt( $ch, CURLOPT_POST, true );
   curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
   curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
   curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
   $result = curl_exec( $ch );
   /*if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    }
    if (isset($error_msg)) {
        echo $error_msg;
        print_r($error_msg);
    }
    print_r( $result );die;*/
curl_close( $ch );



if($request->redireact_id == '1'){
	$child_id = $request->child_id;
	$customer_id = $request->customer_id;
	$service_id = $request->service_id;
return redirect( "/viewchildservice/$service_id/$customer_id/$child_id" );
} else {
return redirect( "/viewrequestamount" );
}
}

public function software_pay_request(Request $request){
    $nav_id = Auth::user()->nav_id;
    $from_id = Auth::user()->id;
    $wallet = Auth::user()->wallet;
      $amount = $request->amount;  
	  $planvaluesplit = $request->plan_amount;
	  
		$plan_value = explode(" - ", $planvaluesplit[0]);
		$months = isset($plan_value[0]) ? (int)trim($plan_value[0]) : 0;
		$to_date = date('Y-m-d', strtotime("+$months months"));
		
      $confirm = DB::table('software_payment')->insert([
          'nav_id' => $nav_id,
          'from_id' => $from_id,
          'to_id' => $request->to_id,
          'plan_value' => $plan_value[0],
          'amount' => $amount,
          'status' => 'Pending',
          'req_date' => date("Y-m-d"),
          'req_time' => date("Y-m-d H:i:s"),
          'activation_date' => $to_date,
      ]);
      $insertid = DB::getPdo()->lastInsertId();

      $paid_image = "";
      if ($request->paid_image != null) {
          $paid_image = $insertid.'.'.$request->file('paid_image')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'paidimage' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['paid_image']['tmp_name'], $filepath . $paid_image);
      }
      $image = DB::table('software_payment')->where('id', $insertid)->update([
          'req_image' => $paid_image,
      ]);
	  
return redirect( "dashboard" );
}

public function software_payment()
{
    $balance =  Auth::user()->wallet;
    $login = Auth::user()->id;
    $referral_id = Auth::user()->referral_id;
    $service_status = 'RequestAmount';
       $sql = "select a.*, b.full_name from software_payment a, users b where (a.from_id=$login or a.to_id = $login ) and a.from_id = b.id and a.status = 'Pending' order by a.status desc";
	
    $softwarepayment =  DB::select( DB::raw( $sql ));

    return view( 'wallet.software_payment', compact( 'softwarepayment') );
}


public function software_payment_approve(Request $request) {
    $log_id = Auth::user()->id;
    $amount = $request->amount;
    $from_id = $request->from_id;
    $activation_date = $request->activation_date;
    $row_id = $request->row_id;
    $login_id = Auth::user()->id;
    $old_balanse = Auth::user()->wallet;
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $status = 'Approved';
    $sql = "select * from users where id='$from_id'";
    $result =  DB::select( DB::raw( $sql ));
    $user_wallet = $result[0]->wallet;
	
    $service_status = 'IN Payment';
    $ad_info = 'Software Activation';
	   DB::table('payment')->insert([
		'log_id'        => $login_id,
		'from_id'       => $from_id,
		'to_id'         => $login_id,
		'amount'        => $amount,
		'ad_info'       => $ad_info,
		'service_status'=> $service_status,
		'time'          => $time,
		'paydate'       => $date,
		'pay_id'        => $row_id,
		'old_balanse'   => $user_wallet,
		'project_id'    => 1
	]);

	// Update `software_payment` table
	DB::table('software_payment')
		->where('id', $row_id)
		->update(['status' => $status]);

	// Update `users` wallet balance
	DB::table('users')
		->where('id', 1)
		->increment('wallet', $amount);

	// Update `useras` activation date
	DB::table('users')
		->where('id', $from_id)
		->update(['activation_date' => $activation_date]);
		
 return redirect( "software_payment" )->with( 'success', 'Software Activation  Successfully'); 
}

public function withdrawal()
{
    $balance =  WalletHelper::wallet_balance(Auth::user()->username);

    $userid= Auth::user()->id;
    if(Auth::user()->user_type_id == 1){
       $withdrawal = DB::table( 'withdrawal' )->orderBy('id','desc')->get();
   }else{
       $withdrawal = DB::table( 'withdrawal' )->where( 'userid', $userid)->get();
   }

   $wallet = DB::table( 'wallet_users' )->select('commission')->where( 'id', $userid)->first();
   $sql = "select status from withdrawal where userid=$userid and status='Pending'";
   $paymentrequest =  DB::select( DB::raw( $sql ));
   $status = "";
   if(count($paymentrequest) > 0){
    $status = $paymentrequest[0]->status;
}
return view( 'wallet.withdrawal', compact( 'withdrawal','wallet','status','balance') );
}

public function withdrawalrequest(Request $request){
    $from_id = Auth::user()->id;
    $sql = "select status from withdrawal where userid=$from_id and status='Pending'";
    $paymentrequest =  DB::select( DB::raw( $sql ));
    $status = "";
    if(count($paymentrequest) > 0){
        $status = $paymentrequest[0]->status;
    }
    $amount = $request->amount;

    if($status != 'Pending'){
        $sql = "select username from users where id=$from_id ";
        $result =  DB::select( DB::raw( $sql ));
        $username = $result[0]->username;
        $sql = "update wallet_users set wallet = wallet - $amount,commission = commission - $amount where username = '$username'";
        DB::update( DB::raw( $sql ) );

        DB::table('withdrawal')->insert([
          'userid'          => $from_id,
          'amount'          => $amount,
          'remarks'         => $request->remarks,
          'account_name'    => $request->account_name,
          'ifsc_code'       => $request->ifsc_code,
          'account_no'      => $request->account_no,
          'status'          => 'Pending',
          'withdrawal_date' => date("Y-m-d"),
          'withdrawal_time' => date("H:i:s"),
      ]);

    }

    return redirect( "/withdrawal" )->with('success','Withdrawal Request submitted successfully.');
}

public function rejectwithdrawal($id)
{
    $reject = DB::table( 'withdrawal' )->select('amount','userid')->where( 'id', $id)->first();
    $sql = "select username from users where id=$reject->userid ";
    $result =  DB::select( DB::raw( $sql ));
    $username = $result[0]->username;
    $sql = "update wallet_users set wallet = wallet + $reject->amount,commission = commission + $reject->amount where username = '$username'";
    DB::update( DB::raw( $sql ) );

    DB::table( 'withdrawal' )->where( 'id', $id)->delete();
    return redirect( "/withdrawal" )->with('success','Withdrawal Request Rejected successfully.');
}

public function acceptwithdrawal(Request $request){
    $userid = $request->id;
    DB::table('withdrawal')->where('id', $userid)->update([
      'status' => 'Completed',
      'txnid' => $request->txnid,
      'completed_date' => date("Y-m-d"),
      'completed_time' => date("H:i:s"),
  ]);

    return redirect( "/withdrawal" )->with('success','Withdrawal Request Approved successfully.');

}


}
