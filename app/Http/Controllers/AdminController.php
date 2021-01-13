<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Social; //sử dụng model Social
use Laravel\Socialite\Facades\Socialite; //sử dụng Socialite
use App\Models\Login; //sử dụng model Login
use File;


session_start();

class AdminController extends Controller
{
    public function AuthLogin()
    {
        $login = Auth::id();
        if ($login) {
            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('/admin')->send();
        }
    }
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider', 'facebook')->where('provider_id', $provider->getId())->first();
        if ($account) {
            //login in vao trang quan tri  
            $account_name = Login::where('customer_id', $account->user)->first();
            Session::put('customer_name', $account_name->customer_name);
            Session::put('customer_id', $account_name->customer_id);
            return redirect('/trang-chu')->with('message', 'Đăng nhập thành công');
        } else {

            $hieu = new Social([
                'provider_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('customer_email', $provider->getEmail())->first();

            if (!$orang) {
                $orang = new Login();
                $orang->customer_name = $provider->getName();
                $orang->customer_email = $provider->getEmail();
                $orang->customer_phone = '0000000001';
                $orang->customer_password = md5(mt_rand());
                $orang->lock_customer = '0';


                $fileContents = file_get_contents($provider->getAvatar());
                $orang->customer_avt= $provider->getId() . ".jpg";
                File::put(public_path() . '/uploads/avatar/' . $provider->getId() . ".jpg", $fileContents);
                $orang->save();
                // $orang = Login::create([
                //     'admin_name' => $provider->getName(),
                //     'admin_email' => $provider->getEmail(),
                //     'admin_password' => '',
                //     'admin_phone' => ''
                // ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = Login::where('customer_id', $hieu->user)->first();

            Session::put('customer_name', $account_name->customer_name);
            Session::put('customer_id', $account_name->customer_id);
            return redirect('/trang-chu')->with('message', 'Đăng nhập Admin thành công');
        }
    }

    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback_google()
    {
        $provider = Socialite::driver('google')->user();
        $account = Social::where('provider', 'google')->where('provider_id', $provider->getId())->first();
        if ($account) {
            //login in vao trang quan tri  
            $account_name = Login::where('customer_id', $account->user)->first();
            Session::put('customer_name', $account_name->customer_name);
            Session::put('customer_id', $account_name->customer_id);
            return redirect('/trang-chu')->with('message', 'Đăng nhập thành công');
        } else {

            $hieu = new Social([
                'provider_id' => $provider->getId(),
                'provider' => 'GOOGLE'
            ]);

            $orang = Login::where('customer_email', $provider->getEmail())->first();

            if (!$orang) {
                $orang = new Login();
                $orang->customer_name = $provider->name;
                $orang->customer_email = $provider->email;
                $orang->customer_phone = '0000000001';
                $orang->customer_password = md5(mt_rand());
                $orang->lock_customer = '0';
                $fileContents = file_get_contents($provider->avatar);
                $orang->customer_avt= $provider->id . ".jpg";
                File::put(public_path() . '/uploads/avatar/' . $provider->getId() . ".jpg", $fileContents);
                $orang->save();
                // $orang = Login::create([
                //     'admin_name' => $provider->getName(),
                //     'admin_email' => $provider->getEmail(),
                //     'admin_password' => '',
                //     'admin_phone' => ''
                // ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = Login::where('customer_id', $hieu->user)->first();

            Session::put('customer_name', $account_name->customer_name);
            Session::put('customer_id', $account_name->customer_id);
            return redirect('/trang-chu')->with('message', 'Đăng nhập Admin thành công');
        }
    }
    public function findOrCreateUser($users, $provider)
    {
        $authUser = Social::where('provider_id', $users->id)->first();
        // if($authUser){

        //     return $authUser;
        // }
        if (!$authUser) {


            $hieu = new Social([
                'provider_id' => $users->id,
                'provider' => strtoupper($provider)
            ]);
        }

        $orang = Login::where('customer_email', $users->email)->first();

        if (!$orang) {
            $orang = Login::create([
                'customer_name' => $users->name,
                'customer_email' => $users->email,
                'customer_password' => md5(mt_rand()),

                'customer_phone' => '0000000002',
                'lock_customer' => 0
            ]);
        }
        $hieu->login()->associate($orang);
        $hieu->save();

        $account_name = Login::where('customer_id', $hieu->user)->first();
        Session::put('customer_name', $account_name->customer_name);
        Session::put('customer_id', $account_name->customer_id);
        return redirect('/trang-chu')->send('');
    }


    public function index()
    {
        return view('admin_login');
    }

    public function show_dashboard()
    {
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;

        // $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if (Auth::attempt(['admin_email' => $admin_email, 'admin_password' => $admin_password])) {
            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('/admin');
        }
    }
    public function logout()
    {
        $this->AuthLogin();
        Auth::logout();
        return Redirect::to('/admin');
    }
    public function manage_user()
    {
        $this->AuthLogin();
        $user = DB::table('users')->get();
        return view('admin.list_user')->with('list_user', $user);
    }
    public function filter_by_day(Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $get = DB::table('tbl_statistical')->whereBetween('order_date', [$date_from, $date_to])->orderBy('order_date', 'asc')->get();
        foreach ($get as $item) {
            $chart_data[] = array(
                'period' => $item->order_date,
                'order' => $item->total_order,
                'sales' => $item->sales,
                'quantity' => $item->quantity,

            );
        }
        echo $data = json_encode($chart_data);
    }
    public function dasboard_filter(Request $request)
    {
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDay(7)->toDateString();
        $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDay(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $dasboard_fill = $request->select_fil;
        if ($dasboard_fill == '7ngay') {
            $get = DB::table('tbl_statistical')->whereBetween('order_date', [$sub7ngay, $now])->orderBy('order_date', 'asc')->get();
        } elseif ($dasboard_fill == 'thangtruoc') {
            $get = DB::table('tbl_statistical')->whereBetween('order_date', [$dauthangtruoc, $cuoithangtruoc])->orderBy('order_date', 'asc')->get();
        } elseif ($dasboard_fill == 'thangnay') {
            $get = DB::table('tbl_statistical')->whereBetween('order_date', [$dauthangnay, $now])->orderBy('order_date', 'asc')->get();
        } else {
            $get = DB::table('tbl_statistical')->whereBetween('order_date', [$sub365ngay, $now])->orderBy('order_date', 'asc')->get();
        }
        foreach ($get as $item) {
            $chart_data[] = array(
                'period' => $item->order_date,
                'order' => $item->total_order,
                'sales' => $item->sales,


                'quantity' => $item->quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function dasboard_filter_30day()
    {
        $sub30ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDay(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();



        $get = DB::table('tbl_statistical')->whereBetween('order_date', [$sub30ngay, $now])->orderBy('order_date', 'asc')->get();



        foreach ($get as $item) {
            $chart_data[] = array(
                'period' => $item->order_date,
                'order' => $item->total_order,
                'sales' => $item->sales,

                'quantity' => $item->quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function get_info_by_day(Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $sales = 0;
        $order = 0;
        $get = DB::table('tbl_statistical')->whereBetween('order_date', [$date_from, $date_to])->orderBy('order_date', 'asc')->get();
        foreach ($get as $item) {


            $sales +=  $item->sales;
            $order += $item->total_order;
        }
        // $dataa =array_sum($data['sales']);
        $data['sales'] = $sales;
        $data['order'] = $order;
        return json_encode($data);
    }
    public function get_info_dasboard_filter(Request $request)
    {
        $sales = 0;
        $order = 0;
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDay(7)->toDateString();
        $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDay(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $dasboard_fill = $request->select_fil;
        if ($dasboard_fill == '7ngay') {
            $get = DB::table('tbl_statistical')->whereBetween('order_date', [$sub7ngay, $now])->orderBy('order_date', 'asc')->get();
        } elseif ($dasboard_fill == 'thangtruoc') {
            $get = DB::table('tbl_statistical')->whereBetween('order_date', [$dauthangtruoc, $cuoithangtruoc])->orderBy('order_date', 'asc')->get();
        } elseif ($dasboard_fill == 'thangnay') {
            $get = DB::table('tbl_statistical')->whereBetween('order_date', [$dauthangnay, $now])->orderBy('order_date', 'asc')->get();
        } else {
            $get = DB::table('tbl_statistical')->whereBetween('order_date', [$sub365ngay, $now])->orderBy('order_date', 'asc')->get();
        }
        foreach ($get as $item) {


            $sales +=  $item->sales;
            $order += $item->total_order;
        }
        $data['sales'] = $sales;
        $data['order'] = $order;
        return json_encode($data);
    }
    public function load_info_30day()
    {
        $sub30ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDay(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();



        $get = DB::table('tbl_statistical')->whereBetween('order_date', [$sub30ngay, $now])->orderBy('order_date', 'asc')->get();
        $get_today = DB::table('tbl_statistical')->where('order_date', $now)->orderBy('order_date', 'asc')->get();
        $sales = 0;
        $order = 0;
        $sales_today = 0;
        $order_today = 0;

        foreach ($get as $item) {


            $sales +=  $item->sales;
            $order += $item->total_order;
        }
        $data['sales'] = $sales;
        $data['order'] = $order;
        foreach ($get_today as $item) {


            $sales_today +=  $item->sales;
            $order_today += $item->total_order;
        }
        $data['sales_today'] = $sales_today;
        $data['order_today'] = $order_today;
        return json_encode($data);
    }
}
