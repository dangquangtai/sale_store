<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;


class UserController extends Controller
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
    public function manage_user()
    {
        $this->AuthLogin();
        $user = DB::table('tbl_customer')->paginate(10);
        return view('admin.list_user')->with('list_user', $user);
    }
    public function edit_user($id_user)
    {
        $edit = DB::table('tbl_customer')->where('customer_id', $id_user)->get();
        return view('admin.edit_user')->with('user_edit', $edit);
        //    echo '<pre>';
        //    echo $id_user;
        //    echo '</pre>';
    }
    public function update_user($id_user, Request $request)
    {
        $this->AuthLogin();
        $data['customer_name'] = $request->user_name;
        $data['customer_email'] = $request->user_email;
        $edit = DB::table('tbl_customer')->where('customer_id', $id_user)->update($data);
        Session::put('message', 'Cập nhật thông tin thành công !');
        return Redirect::to('/manage-user');
        //    echo '<pre>';
        //    echo $id_user;
        //    echo '</pre>';
    }
    public function delete_user($id_user, Request $request)
    {
        $this->AuthLogin();

        DB::table('tbl_customer')->where('customer_id', $id_user)->delete();
        Session::put('message', 'đã xoá user !');
        return Redirect::to('/manage-user');
        //    echo '<pre>';
        //    echo $id_user;
        //    echo '</pre>';
    }
    public function lock_user($id_user)
    {
        $this->AuthLogin();
        $user = DB::table('tbl_customer')->where('customer_id', $id_user)->update(['lock_customer' => '1']);
        return Redirect()->back();
    }
    public function unlock_user($id_user)
    {
        $this->AuthLogin();
        $user = DB::table('tbl_customer')->where('customer_id', $id_user)->update(['lock_customer' => '0']);
        return Redirect()->back();
    }



    // phan quyen

    public function index()
    {

        $admin = Admin::with('roles')->orderBy('admin_id', 'DESC')->paginate(5);
        return view('admin.list_admin')->with(compact('admin'));
    }
    public function assign_roles(Request $request)
    {
        if(Auth::id()==$request->admin_id){
            return Redirect()->back()->with('message', 'Không được phân quyền chính mình'); 
        }
        $data = $request->all();
        $user = Admin::where('admin_email', $data['admin_email'])->first();
        $user->roles()->detach();
        if ($request['author_role']) {
            $user->roles()->attach(Roles::where('name', 'author')->first());
        }
        if ($request['user_role']) {
            $user->roles()->attach(Roles::where('name', 'user')->first());
        }
        if ($request['admin_role']) {
            $user->roles()->attach(Roles::where('name', 'admin')->first());
        }
        return redirect()->back();
    }
    public function add_admin()
    {
        return view('admin.add_admin');
    }
    public function save_add_admin(Request $request)
    {
        $data['admin_name'] = $request->admin_name;
        $data['admin_phone'] = $request->admin_phone;
        $data['admin_password'] = md5($request->admin_password);
        $data['admin_email'] = $request->admin_email;
        $get_email =   DB::table('tbl_admin')->select('admin_email')->where('admin_email', $request->admin_email)->first();
        if ($get_email != null) {
            Session::put('message', 'Email đã có admin khác sử dụng!');
            return Redirect()->back();
        } else {
            Session::put('message', 'Thêm thành công !');
            DB::table('tbl_admin')->insert($data);
            return Redirect()->back();
        }
        // print_r($get_email);
    }
    public function delete_admin($adminId)
    {

        if (Auth::id() == $adminId) {
            return Redirect()->back()->with('message', 'Không được xoá chính mình');
        }
        $admin = Admin::find($adminId);
      if($admin){
          $admin->roles()->detach();
          $admin->delete();
      }
      return Redirect()->back()->with('message','Xoá thành công !');
       
    }
}
