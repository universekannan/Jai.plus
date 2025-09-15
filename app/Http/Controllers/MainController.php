<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;


use App\Models\Core\Setting;
use App\Models\Admin\Admin;
use App\Models\Core\Order;
use App\Models\Core\Customers;
use App\Models\Core\Drivers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Exception;
use App\Models\Core\Images;
use Validator;
use ZipArchive;
use File;
use Carbon\Carbon;
use DateTime;
use Carbon\CarbonPeriod;
use PDF;
use DateInterval;


class MainController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


        public function welcome(){
			
            return view("index");

        }

        public function about(){
			
            return view("web/about");

        }

        public function plan(){
			
            return view("web/plan");

        }

        public function marketingtool(){
			
            return view("marketingtool");

        }

        public function admin(){
			
            return view("web/login");

        }

        public function contact(){
			
            return view("web/contact");

        }

        public function roadmap(){
			
            return view("web/roadmap");

        }

        public function terms_condition(){
			
            return view("web/terms_condition");

        }

        public function sponsor_income(){
			
            return view("web/sponsor_income");

        }

        public function globalregain_income(){
			
            return view("web/globalregain_income");

        }

        public function level_income(){
			
            return view("web/level_income");     

        }


        public function uplinesponsor_bonus(){
			
            return view("web/uplinesponsor_bonus");     

        }
		
        public function the_team(){
			
            return view("the_team");

        }
		
        public function faq(){
			
            return view("faq");

        }
		
        public function services(){
			
            return view("services");
        }

		public function blog(){
			
			return view("blog");
        }
		
		
}
