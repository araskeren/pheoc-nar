<?php
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()==true) {
        return redirect()->route('home.dashboard');
    } else {
        return view('welcome');
    }
});
Route::get('/notify',function(){
    \App\User::find(2)->notify(new \App\Notifications\NotifyUser());
    return 'done';
});
Route::get('/my-ip', function(){
    return request()->ip();
});
Auth::routes();
Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
});
Route::post('api/auth','MainLoginController@check_login')->name('Login.Check');
Route::post('login-action', 'MainLoginController@login_action');
Route::post('refresh_captcha', 'MainLoginController@refreshCaptcha')->name('refresh_captcha');
// Route::get('coba', 'MainLoginController@coba');
