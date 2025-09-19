<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;

Auth::routes();
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordController;


Route::get('/', [App\Http\Controllers\MainController::class, 'welcome'])->name('welcome');
Route::get('/home', [App\Http\Controllers\MainController::class, 'welcome'])->name('welcome');
Route::get('/about',[App\Http\Controllers\MainController::class, 'about'])->name('about');
Route::get('/marketingtool', [App\Http\Controllers\MainController::class, 'marketingtool'])->name('marketingtool');
Route::get('/plans', [App\Http\Controllers\MainController::class, 'plan'])->name('plan');
Route::get('/sponsor_income', [App\Http\Controllers\MainController::class, 'sponsor_income'])->name('sponsor_income');
Route::get('/globalregain_income', [App\Http\Controllers\MainController::class, 'globalregain_income'])->name('globalregain_income');
Route::get('/level_income', [App\Http\Controllers\MainController::class, 'level_income'])->name('level_income');
Route::get('/uplinesponsor_bonus', [App\Http\Controllers\MainController::class, 'uplinesponsor_bonus'])->name('uplinesponsor_bonus');
Route::get('/contact', [App\Http\Controllers\MainController::class, 'contact'])->name('contact');
Route::get('/roadmap', [App\Http\Controllers\MainController::class, 'roadmap'])->name('roadmap');
Route::get('/terms_condition', [App\Http\Controllers\MainController::class, 'terms_condition'])->name('terms_condition');  
Route::get('/faq',[App\Http\Controllers\MainController::class, 'faq'])->name('faq');
Route::get('/services', [App\Http\Controllers\MainController::class, 'services'])->name('services');
Route::get('/blog', [App\Http\Controllers\MainController::class, 'blog'])->name('blog');

Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'userlogin'])->name('login');
Route::get('admin', [App\Http\Controllers\Auth\LoginController::class, 'userlogin'])->name('userlogin');
Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::get('register/{referral}', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register.referral');
Route::post('newregister', [App\Http\Controllers\Auth\RegisterController::class, 'adminregister'])->name('newregister');


//admin

Route::get('admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('admin/setting',[App\Http\Controllers\Admin\SettingsController::class, 'setting'])->name('setting');
Route::post('admin/setting_update',[App\Http\Controllers\Admin\SettingsController::class, 'setting_update'])->name('setting_update');

ROUTE::get('/admin/backup', [App\Http\Controllers\Admin\BackupController::class, 'backup'])->name('backup');
ROUTE::get('/admin/backup/create', [App\Http\Controllers\Admin\BackupController::class, 'create'])->name('create');
ROUTE::get('/admin/backup/download/{file_name}', [App\Http\Controllers\Admin\BackupController::class, 'download'])->name('download');
ROUTE::get('/admin/backup/delete/{file_name}', [App\Http\Controllers\Admin\BackupController::class, 'delete'])->name('delete');
Route::get('/admin/download_zip', [App\Http\Controllers\Admin\BackupController::class, 'downloadZip']);


Route::get('admin/users', [App\Http\Controllers\Admin\UsersController::class, 'users'])->name('users');
Route::get('admin/profile', [App\Http\Controllers\Admin\UsersController::class, 'profile'])->name('profile');
Route::post('/updateprofile', [App\Http\Controllers\Admin\UsersController::class, 'updateprofile'])->name('updateprofile');
Route::get('admin/changepassword',[App\Http\Controllers\Admin\UsersController::class, 'changepassword'])->name('changepassword');
Route::post("/updatepassword", [App\Http\Controllers\Admin\UsersController::class, 'updatepassword'])->name('updatepassword');
Route::post('/user_update_theme', [App\Http\Controllers\Admin\UsersController::class, 'updateTheme'])->name('user.updateTheme');
Route::get('admin/user_type', [App\Http\Controllers\Admin\UsersController::class, 'user_type'])->name('user_type');
Route::post('/adduser_type', [App\Http\Controllers\Admin\UsersController::class, 'adduser_type'])->name('adduser_type');
Route::post('/updateuser_type', [App\Http\Controllers\Admin\UsersController::class, 'updateuser_type'])->name('updateuser_type');

Route::post('checkemailreg', [App\Http\Controllers\Auth\RegisterController::class, 'checkemailreg'])->name('checkemailreg');
Route::post('checkwalletreg', [App\Http\Controllers\Auth\RegisterController::class, 'checkwalletreg'])->name('checkwalletreg');
Route::post('checkphoneuserreg', [App\Http\Controllers\Auth\RegisterController::class, 'checkphoneuserreg'])->name('checkphoneuserreg');
Route::post('checkwhatsapp_numberuserreg', [App\Http\Controllers\Auth\RegisterController::class, 'checkwhatsapp_numberuserreg'])->name('checkwhatsapp_numberuserreg');

Route::get('admin/members/{id}', [App\Http\Controllers\Admin\UsersController::class, 'members'])->name('members');
Route::get('/customerpagination/fetch_data', [App\Http\Controllers\Admin\UsersController::class, 'fetchData'])->name('customer.fetch');

Route::get('admin/geneology', [App\Http\Controllers\Admin\UsersController::class, 'geneology'])->name('geneology');
Route::post('updatemember', [App\Http\Controllers\Admin\UsersController::class, 'updatemember'])->name('updatemember');

Route::get('admin/plans', [App\Http\Controllers\Admin\PlanController::class, 'plans'])->name('plans');
Route::get('admin/user_activate_plan', [App\Http\Controllers\Admin\PlanController::class, 'userActivatePlan'])->name('user_activate_plan');
Route::get('admin/plan_activation_request', [App\Http\Controllers\Admin\PlanController::class, 'planActivationrequest'])->name('plan_activation_request');
Route::post('update_plan_activation_request', [App\Http\Controllers\Admin\PlanController::class, 'update_plan_activation_request'])->name('update_plan_activation_request');
Route::post('addplan', [App\Http\Controllers\Admin\PlanController::class, 'addplan'])->name('addplan');
Route::post('editplan', [App\Http\Controllers\Admin\PlanController::class, 'editplan'])->name('editplan');
Route::get('admin/activate_plan/{id}', [App\Http\Controllers\Admin\PlanController::class, 'activatePlan'])->name('activate_plan');
Route::post('admin/activate_plan_payment', [App\Http\Controllers\Admin\PlanController::class, 'activatePlanPayment'])->name('activate_plan_payment');
Route::get('admin/plan_payment/{id}/{usrid}', [App\Http\Controllers\Admin\PlanController::class, 'plan_payment'])->name('plan_payment');

Route::post('admin/plan_payment_request', [App\Http\Controllers\Admin\PlanController::class, 'plan_payment_request']);


Route::get('admin/withdrawal/{id}', [App\Http\Controllers\Admin\PaymentController::class, 'withdrawal'])->name('withdrawal');
Route::post('addwithdrawal', [App\Http\Controllers\Admin\PaymentController::class, 'addWithdrawal'])->name('addwithdrawal');
Route::post('updatewithdrawal', [App\Http\Controllers\Admin\PaymentController::class, 'updateWithdrawal'])->name('updatewithdrawal');

Route::get('admin/spornser', [App\Http\Controllers\Admin\PaymentController::class, 'sponserlist'])->name('sponserlist');
Route::get('admin/global_rebirth', [App\Http\Controllers\Admin\PaymentController::class, 'global_rebirth_list'])->name('global_rebirth_list');
Route::get('admin/level', [App\Http\Controllers\Admin\PaymentController::class, 'level'])->name('level');
Route::get('admin/upline_spornser', [App\Http\Controllers\Admin\PaymentController::class, 'upline_spornser'])->name('upline_spornser');
Route::get('admin/wallet', [App\Http\Controllers\Admin\PaymentController::class, 'wallet'])->name('wallet');
Route::post('admin/updatewallet_level', [App\Http\Controllers\Admin\PaymentController::class, 'updatewallet_level'])->name('updatewallet_level');

Route::post('admin/updatewallet_sponser', [App\Http\Controllers\Admin\PaymentController::class, 'updatewallet_sponser'])->name('updatewallet_sponser');
Route::get('admin/upgrade', [App\Http\Controllers\Admin\PaymentController::class, 'upgrade'])->name('upgrade');
Route::get('admin/travel_amount', [App\Http\Controllers\Admin\PaymentController::class, 'travel_amount'])->name('travel_amount');
Route::get('admin/travel_allowance', [App\Http\Controllers\Admin\PaymentController::class, 'travel_allowance'])->name('travel_allowance');


Route::get('/admin/get_data', [App\Http\Controllers\Admin\PaymentController::class, 'getData'])->name('get_data');
Route::get('/admin/admin_payment', [App\Http\Controllers\Admin\PaymentController::class, 'adminPayment'])->name('admin_payment');

Route::post('/save_fcm_token', [App\Http\Controllers\Admin\PlanController::class, 'save_fcm_token'])->name('save_fcm_token');
Route::get('/send_push_notification', [App\Http\Controllers\Admin\PlanController::class, 'send_push_notification'])->name('send_push_notification');


Route::get('/admin/kannan', [App\Http\Controllers\Admin\PlanController::class, 'kannan'])->name('get_data');

Route::post('/updateprofiletemp', [App\Http\Controllers\Admin\UsersController::class, 'updateprofiletemp'])->name('updateprofiletemp');
Route::post('checkphoneuserregtemp', [App\Http\Controllers\Admin\UsersController::class, 'checkphoneuserregtemp'])->name('checkphoneuserregtemp');

Route::get('/admin/manual_activation/{id}', [App\Http\Controllers\Admin\PlanController::class, 'manual_activation'])->name('manual_activation');




Route::get('/forgot-password', [PasswordController::class, 'showForgotForm'])->name('forgot.password');
Route::post('/forgot-password', [PasswordController::class, 'sendResetLink'])->name('forgotpassword.send');

Route::get('/change-password/{username}', [PasswordController::class, 'showChangeForm'])->name('password.change');
Route::post('/change-password/{username}', [PasswordController::class, 'updatePassword'])->name('password.update');


Route::post('admin/transaction_history', [App\Http\Controllers\Admin\PlanController::class, 'transaction_history'])->name('transaction_history');


Route::get('admin/total_members', [App\Http\Controllers\Admin\UsersController::class, 'total_members'])->name('total_members');


Route::get('logout', [App\Http\Controllers\Admin\UsersController::class, 'logout'])->name('logout');