<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;

class MainLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'login_action', 'check_login', 'coba', 'refreshCaptcha']);
        $this->middleware('prevent-back-history');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()==true) {
            return redirect()->route('home.dashboard');
        } else {
            return view('welcome');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('index');
    }

    public function login_action(Request $request)
    {
        $response = array(
            'status' => 'failed', 'errors' => 'login', 'msg' => 'Failed to login. check your identity first', 'item' => ''
        );
        /** VALIDATION */
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:100',
            'password' => 'required|max:100',
            'captcha' => 'required|captcha'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'failed', 'errors'=>$validator->errors()->all(), 'msg' => 'Gagal Login. Cek kembali data anda', 'item' => '']);
        } else {
            // LOGIN ATTEMP
            $credentials = ['username' => $request->username, 'password' => $request->password];
            if(Auth::attempt($credentials)){
                $sess = Helper::checkAuth(auth()->user()->id);
                Session::put('group', @$sess[0]->group_id);
                Session::put('users_id', @$sess[0]->id_users);
                Session::put('username', @$sess[0]->username);
                Session::put('nama_role', @$sess[0]->nama_role);
                $response = array(
                    'status' => 'success', 'errors' => '', 'msg' => 'Success to login', 'item' => ''
                );
            } else {
                $response = array(
                    'status' => 'failed', 'errors' => 'login', 'msg' => 'Failed to login. check your identity first', 'item' => ''
                );
            }
        } /** END OF VALIDATION */
        return response()->json($response);
    }

    public function check_login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $data = DB::select("SELECT * FROM users WHERE username = '$username'");
        if (!isset($data[0])) {
            $arr = ['response' => 0];
        } else if (Hash::check($password, $data[0]->password)) {
            $arr = ['response' => (int)$data[0]->id];
        } else {
            $arr = ['response' => 0];
        }
        return response()->json($arr);
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('mini')]);
    }

}
