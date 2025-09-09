<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use Jenssegers\Agent\Agent;
use App\Models\User;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware( 'auth' );
    }


    public function members(Request $request, $status)
    {
        $referral_id = Auth::user()->id;
        $query = DB::table('users');

        
        if ($status == 1) {
            $query->where('plan_id', '>', 0);
        } else {
            $query->where('plan_id', 0);
        }

        if (Auth::user()->user_type_id != 1) {
            $query->where('referral_id', $referral_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('user_name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $perPage = $request->get('pageper', 25);
        $members = $query->paginate($perPage);

        $members->appends($request->all());

        return view('admin.users.members', compact('members'));
    }

    // public function geneology( Request $request ) {
    //     $data = [];
    //     if ( Auth::user()->id == 1 ) {
    //         $r = $request->input( 'r', Auth::user()->id );
    //         $data[ 'primarymember' ] = User::find( $r );
    //         $members = [];
    //         $users = User::where( 'referral_id', $r )->where( 'id', '!=', Auth::user()->id )->get();
    //         $members[ 'u'.$r ] = $users;
    //         foreach ( $users as $user ) {
    //             $u = User::where( 'referral_id', $user->id )->get();
    //             $members[ 'u'.$user->id ] = $u;
    //             foreach ( $u as $i ) {
    //                 $v = User::where( 'referral_id', $i->id )->get();
    //                 $members[ 'u'.$i->id ] = $v;
    //             }
    //         }
    //     } else {
    //         $r = $request->input( 'r', Auth::user()->id );
    //         $data[ 'primarymember' ] = User::find( $r );
    //         $members = [];
    //         $users = User::where( 'referral_id', $r )->get();
    //         $members[ 'u'.$r ] = $users;
    //         foreach ( $users as $user ) {
    //             $u = User::where( 'referral_id', $user->id )->get();
    //             $members[ 'u'.$user->id ] = $u;
    //             foreach ( $u as $i ) {
    //                 $v = User::where( 'referral_id', $i->id )->get();
    //                 $members[ 'u'.$i->id ] = $v;
    //             }
    //         }
    //     }
    //     $data[ 'members' ] = json_encode( $members, true );
    //     $data[ 'members' ] = json_decode( $data[ 'members' ], true );
    //     $primaryuse = $data[ 'primarymember' ];
    //     $members = $data[ 'members' ];

    //     return view( 'admin/users/geneology', compact( 'members', 'primaryuse' ) );
    // }

    public function geneology(Request $request)
    {
        $r = $request->input('r', Auth::user()->id);
        $primary = User::find($r);

        // Recursive function with depth control
        function getChildren($userId, $level = 1, $maxLevel = 3) {
            if ($level > $maxLevel) {
                return []; // stop recursion after 3 levels
            }

            $children = User::where('referral_id', $userId)->get();
            $tree = [];

            foreach ($children as $child) {
                $tree[] = [
                    'id' => $child->id,
                    'name' => $child->name,
                    'photo' => $child->photo,
                    'referral_id' => $child->referral_id,
                    'children' => getChildren($child->id, $level + 1, $maxLevel) // recursion with depth
                ];
            }

            return $tree;
        }

        $tree = [
            'id' => $primary->id,
            'name' => $primary->name,
            'photo' => $primary->photo,
            'referral_id' => $primary->referral_id,
            'children' => getChildren($primary->id, 1, 3) // start recursion at level 1
        ];

        return view('admin.users.geneology', compact('tree'));
    }


    public function users() {
	
		$users = DB::table( 'users' )->get();

        $user_type_id = DB::table( 'user_type' )->orderBy( 'id', 'Asc' )->get();
        return view( 'admin/users/index', compact( 'users','user_type_id') );
    }

    public function user_type() 
    {
	
        $user_type = DB::table( 'user_type' )->orderBy( 'id', 'Asc' )->get();

        return view( 'admin/users/user_type', compact('user_type') );
    }

    public function adduser_type(Request $request)
    {

        DB::table('user_type')->insert([
            'usertype_name'    => $request->usertype_name,
            'status'           => 1,
        ]);

        return redirect()->back()->with('success', 'User Type Added successfully!');
    }

    public function updateuser_type(Request $request)
    {

        DB::table('user_type')->where('id', $request->user_id)->update([
            'usertype_name'    => $request->usertype_name,
            'status'           => $request->status,
        ]);

        return redirect()->back()->with('success', 'User Type updated successfully!');
    }

    public function profile()
    {
        $userid = Auth::user()->id; 
        $profile = DB::table('users')->where('id', $userid)->first(); 

        return view('admin.users.profile', compact('profile')); 
    }

    public function updateprofile(Request $request)
    {
        $userid = Auth::user()->id;

        DB::table('users')->where('id', $userid)->update([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'address' => $request->address,
            'wallet_address' => $request->wallet_address,
        ]);
        if ($request->hasFile('photo')) {
            $photo = $request->userid . '.' . $request->file('photo')->extension();
            $imagePath = public_path('upload/profile_photo');
            $request->file('photo')->move($imagePath, $photo);
            $fileName = 'upload/profile_photo/'.$photo;
            DB::table('users')->where('id', $request->userid)->update([
                'photo' => $fileName,
            ]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function adduser( Request $request ) {
        //dd($request->all());
        $userid = DB::table( 'users' )->insertGetId( [
            'name' => $request->name,
            'aadhar_no' => $request->aadhar_no,
            'phone' => $request->phone,
            'email' => $request->email,
            'password'=>   Hash::make( $request->password ),
            'cpassword' => $request->password,
            'address' => $request->address,
            'store_id' => $request->store_id,
            'usertype_id' => $request->usertype,
            'referral_id' => Auth::user()->id,
        ] );

        if ( $request->has( 'deliverable_location' ) ) {
            foreach ( $request->input( 'deliverable_location' ) as $key => $loc ) {
                DB::table( 'deliverable_location' )->insert( [
                    'store_id'          =>   $userid,
                    'deliverable_id'    =>   $loc,
                    'created_at'        =>   date( 'Y-m-d H:i:s' ),
                ] );
            }

        }
        return redirect()->back()->with( 'success', 'Users Added Successfully ... !' );
    }

   public function edituser( $id ) {

        $stores = DB::table( 'users' )->where( 'id', $id )->orderBy( 'id', 'Asc' )->get();
        $usertype = DB::table( 'user_type' )->orderBy( 'id', 'Asc' )->get();
		$shop = DB::table( 'users' )->where( 'usertype_id', 5 )->orderBy( 'id', 'Asc' )->get();
        $stores = json_decode( json_encode( $stores ), true );
        $location = array();
        foreach ( $stores as $key => $store ) {
            $stores[ $key ][ 'deliverable_location' ] = array();
            $store_id = $store[ 'id' ];
            $sql = "select deliverable_id from deliverable_location where store_id=$store_id order by id desc";
            $result = DB::select( $sql );

            $stores[ $key ][ 'deliverable_location' ] = $result;

        }
        $stores = json_decode( json_encode( $stores ) );
        $sql = "select * from location where id not in (select distinct(deliverable_id) from deliverable_location where store_id <> $store_id)";
        $location = DB::select( $sql );

        return view( 'admin/users/edit', compact( 'stores', 'location','usertype','shop' ) );
    }

    public function updateuser( Request $request ) {
        //dd( $request->all() );
        $userid = $request->row_id;
        DB::table( 'users' )->where( 'id', $userid )->update( [
            'name'        => $request->name,
            'email'       => $request->email,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'store_id'    => $request->store_id,
            'usertype_id' => $request->usertype_id,
            'address'     => $request->address,
            'location'    => $request->location,
            'leavescound' => $request->leavescound,
            'salery'      => $request->salery,
            'status'      => $request->status,
        ] );

        if ($request->has( 'deliverable_location' ) != '' ) {
            DB::table( 'deliverable_location' )->where( 'store_id', $userid )->delete();
            foreach ( $request->input( 'deliverable_location' ) as $key => $loc ) {
                DB::table( 'deliverable_location' )->insert( [
                    'store_id'          =>   $userid,
                    'deliverable_id'    =>   $loc,
                    'created_at'        =>   date( 'Y-m-d H:i:s' ),

                ] );
            }
        }

        $qrcode = '';
        if ( $request->photo != null ) {
            $qrcode = $userid.'.'.$request->file( 'photo' )->extension();

            $filepath = public_path( 'upload'.DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $filepath.$qrcode );
            $sql = "update users set photo='$qrcode' where id = $userid";
            DB::update( DB::raw( $sql ) );
        }
        return redirect( 'admin/users/'.$request->usertype_id );
    }

    public function changepassword()
    {
        return view('admin.users.changepassword'); 
    }

    public function updatepassword(Request $request){
        $userid = Auth::user()->id;
        $old_password = trim($request->get("oldpassword"));
        $currentPassword = auth()->user()->password;
        if(Hash::check($old_password, $currentPassword)){
            $new_password = trim($request->get("new_password"));
            $confirm_password = trim($request->get("confirm_password"));
            if($new_password != $confirm_password){
                return redirect()->back()->with('error', 'Passwords does not match');
            }else{
                $updatepass = DB::table('users')->where('id', '=', $userid)->update([
                    'password'  => Hash::make($new_password),
                    'cpassword'  => $new_password,
                ]);
                return redirect()->back()->with('success', 'Passwords Change Succesfully');
            }
        }else{
            return redirect()->back()->with('error', 'Sorry, your current password was not recognised');
        }
    }

    public function updateTheme(Request $request)
    { 
        $user = auth()->user()->id;
        $role = DB::table('users')->where('id',$user)->update([
            'theme' => $request->theme
        ]);
        return response()->json(['status' => 'success']);
    }

    public function updatemember( Request $request ) {

        DB::table( 'users' )->where( 'id', $request->user_id )->update( [
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'status'      => $request->status,
        ] );

        return redirect()->back()->with( 'success', 'Members Updated Successfully ... !' );
    }
	
    public function logout(){
        Auth::guard()->logout();
        return redirect('/userlogin');
    }



    public function updateprofiletemp(Request $request)
    {
        $userid = Auth::user()->id;

        DB::table('users')->where('id', $userid)->update([
            'name'    => $request->name,
            'phone'   => $request->country_code.''.$request->phone,
            'email'   => $request->email,
            'password' => Hash::make($request->password),
            'cpassword' => $request->password,
            'wallet_address' => $request->wallet_address,
            'pop_status' => 1,
        ]);
        if ($request->hasFile('photo')) {
            $photo = $request->userid . '.' . $request->file('photo')->extension();
            $imagePath = public_path('upload/profile_photo');
            $request->file('photo')->move($imagePath, $photo);
            $fileName = 'upload/profile_photo/'.$photo;
            DB::table('users')->where('id', $request->userid)->update([
                'photo' => $fileName,
            ]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }


    public function checkphoneuserregtemp(Request $request)
{
    $phone    = trim((string) $request->input('phone'));
    $ignoreId = $request->input('ignore_id');          // id of the record being edited

    if (empty($ignoreId) && auth()->check()) {
        $ignoreId = auth()->id();
    }

    $exists = DB::table('users')
        ->where('phone', $phone)
        ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
        ->exists();

    return response()->json(['exists' => $exists]);
}



}