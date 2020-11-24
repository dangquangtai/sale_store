<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    public function AuthLogin()
    {
        $login = Session::get('admin_id');
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
   $edit = DB::table('tbl_customer')->where('customer_id',$id_user)->get();
   return view('admin.edit_user')->with('user_edit', $edit);
//    echo '<pre>';
//    echo $id_user;
//    echo '</pre>';
    }
    public function update_user($id_user , Request $request)
    {
        $this->AuthLogin();
        $data['customer_name']= $request->user_name;
        $data['customer_email']= $request->user_email;
   $edit = DB::table('tbl_customer')->where('customer_id',$id_user)->update($data);
   Session::put('message','Cập nhật thông tin thành công !');
   return Redirect::to('/manage-user');
//    echo '<pre>';
//    echo $id_user;
//    echo '</pre>';
    }
    public function delete_user($id_user , Request $request)
    {
        $this->AuthLogin();
       
    DB::table('tbl_customer')->where('customer_id',$id_user)->delete();
   Session::put('message','đã xoá user !');
   return Redirect::to('/manage-user');
//    echo '<pre>';
//    echo $id_user;
//    echo '</pre>';
    }
}
