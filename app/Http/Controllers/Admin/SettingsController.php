<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Artisan;
use Log;
use Auth;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
 public function __construct()
  {
    $this->middleware( 'auth' );
  }


    public function setting(){
      $setting = DB::table('settings')->get()->keyBy('name');
      return view("admin.settings", compact('setting'));
    }

    public function setting_update(Request $request)
    {
      $inputs = $request->all();

      foreach ($inputs as $key => $value) {

        if (in_array($key, ['favicon', 'logo', 'share_image']) && $request->hasFile($key)) {
          $file = $request->file($key);
          $filename = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
          $destinationPath = public_path('upload/settings');

          // Create folder if it doesn't exist
          if (!file_exists($destinationPath)) {
              mkdir($destinationPath, 0755, true);
          }

          // Delete old image if it exists
          $existing = DB::table('settings')->where('name', $key)->first();
          if ($existing && !empty($existing->value)) {
              $oldFile = public_path($existing->value);
              if (file_exists($oldFile)) {
                  unlink($oldFile);
              }
          }

          // Move new file and save path
          $file->move($destinationPath, $filename);
          $value = 'upload/settings/' . $filename;
        }

        DB::table('settings')->where('name', $key)
            ->update(
                ['value' => $value, 'created_at' => now()]
            );
      }
      return redirect()->back()->with('success','Settings Update Successfully');
    }

}
