<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Mockery\Loader\RequireLoader;
use PhpParser\Node\Expr\FuncCall;



class PostController extends Controller
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
   
    public function save_add_cate_post(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['cate_post_name']= $request->cate_post_name;
        $data['cate_post_desc']= $request->cate_post_desc;
        $data['cate_post_status']= $request->cate_post_status;
        $data['cate_post_slug']= $request->cate_post_slug;
        DB::table('tbl_cate_post')->insert($data);
        Session::put('message','Thêm danh mục bài viết thành công !');
        return back();
    }
    public function view_cate_post()
    {
        $view_cate_post = DB::table('tbl_cate_post')->orderBy('cate_post_id','DESC')->paginate(6);
        return view('admin.view_cate_post')->with('view_cate_post',$view_cate_post);
    }
    public function edit_cate_post($catepostId)
    {
      $edit_cate_post =DB::table('tbl_cate_post')->where('cate_post_id',$catepostId)->get();
      return view('admin.edit_cate_post')->with('edit_cate_post',$edit_cate_post);
    }
    public function update_cate_post($catepostId , Request $request)
    {
        $data['cate_post_name']= $request->name_cate_post;
        $data['cate_post_desc']= $request->desc_cate_post;
        $data['cate_post_slug']= $request->slug_cate_post;
      DB::table('tbl_cate_post')->where('cate_post_id',$catepostId)->update($data);
      Session::put('message','cập nhật danh mục thành công !');
      return back();
    }
    public function delete_cate_post($catepostId)
    {
      $edit_cate_post =DB::table('tbl_cate_post')->where('cate_post_id',$catepostId)->delete();
      Session::put('message','Xoá danh mục thành công !');
      return back();
    }
    public function unactive_cate_post($catepostId)
    {
      $edit_cate_post =DB::table('tbl_cate_post')->where('cate_post_id',$catepostId)->update(['cate_post_status' => 0]);
      Session::put('message','Đã ẩn danh mục bài viết !');
      return back();
    }
    public function active_cate_post($catepostId)
    {
      $edit_cate_post =DB::table('tbl_cate_post')->where('cate_post_id',$catepostId)->update(['cate_post_status' => 1]);
      Session::put('message','Đã hiện danh mục bài viết !');
      return back();
    }
    public function add_post()
    {
        $add_post = DB::table('tbl_cate_post')->get();
        return view('admin.add_post')->with('add_post',$add_post);
    }
    public function save_add_post(Request $request)
    { $this->AuthLogin();
         $data = array();
         $data['post_tittle']= $request->post_name;
         $data['cate_post_id']= $request->post_cate;
         $data['post_slug']= $request->post_slug;
         $data['post_desc']= $request->post_desc;
         $data['post_content']= $request->post_content;
         $data['post_meta_keyword']= $request->post_meta_key;
         $data['post_meta_desc']= $request->post_content_meta;
         $data['post_status']= $request->post_status;
         $get_image = $request->file('post_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post', $new_image);
            $data['post_image'] = $new_image;
        }
        DB::table('tbl_post')->insert($data);
        Session::put('message','Thêm bài viết thành công !');
        return Redirect()->back();




    }
    public function view_post()
    {
      $view_post =  DB::table('tbl_post')->join('tbl_cate_post','tbl_cate_post.cate_post_id','=','tbl_post.cate_post_id')
        ->orderBy('tbl_post.post_id','desc')->paginate(10);
        return view('admin.view_post')->with('view_post',$view_post);
    }
    public function edit_post($postId)
    {
      $edit_post =  DB::table('tbl_post')->join('tbl_cate_post','tbl_cate_post.cate_post_id','=','tbl_post.cate_post_id')
        ->where('post_id',$postId)->get();
        $list_cate_post = DB::table('tbl_cate_post')->get();
        return view('admin.edit_post')->with('edit_post',$edit_post)->with('list_cate_post',$list_cate_post);
    }
    public function update_post(Request $request ,$postId)
    { $this->AuthLogin();
         $data = array();
         $data['post_tittle']= $request->new_post_name;
         $data['cate_post_id']= $request->new_post_cate;
         $data['post_slug']= $request->new_post_slug;
         $data['post_desc']= $request->new_post_desc;
         $data['post_content']= $request->new_post_content;
         $data['post_meta_keyword']= $request->new_post_meta_key;
         $data['post_meta_desc']= $request->new_post_content_meta;
         $data['post_status']= $request->new_post_status;
         $get_image = $request->file('new_post_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post', $new_image);
            $data['post_image'] = $new_image;
        }
        DB::table('tbl_post')->where('post_id',$postId)->update($data);
        Session::put('message','Sửa bài viết thành công !');
        return Redirect()->back();




    }
    public function delete_post($postId)
    {
      $a =  DB::table('tbl_post')->where('post_id',$postId)->get();
        foreach($a as $item){
 $b = $item->post_image;
        }
        unlink('public/uploads/post/'.$b);
       DB::table('tbl_post')->where('post_id',$postId)->delete();
       Session::put('message','Đã xoá tin tức !');
     return  Redirect()->back();
    }
    public function unactive_post($postId)
    {
      $edit_cate_post =DB::table('tbl_post')->where('post_id',$postId)->update(['post_status' => 0]);
      Session::put('message','Đã ẩn bài viết !');
      return back();
    }
    public function active_post($postId)
    {
      $edit_cate_post =DB::table('tbl_post')->where('post_id',$postId)->update(['post_status' => 1]);
      Session::put('message','Đã hiện bài viết !');
      return back();
    }
    
    // end admin

    public function view_news()
    {
    $get_cate_post =  DB::table('tbl_cate_post')->orderBy('cate_post_id','desc')->get();
      $get_post =DB::table('tbl_post')->orderBy('post_id','desc')->paginate(5);
      return view('pages.different.view_news')->with('get_cate_post',$get_cate_post)->with('get_post',$get_post);
    }
    public function post_detail($postId)
    {
    $get_cate_post =  DB::table('tbl_cate_post')->orderBy('cate_post_id','desc')->get();
    $list_post =DB::table('tbl_post')->orderBy('post_id','desc')->paginate(5);
      $get_post =DB::table('tbl_post')->where('post_id',$postId)->get();
      return view('pages.different.detail_news')->with('get_cate_post',$get_cate_post)->with('get_post',$get_post)->with('list_post',$list_post);
    }
    public function post_cate_detail($postcateId)
    {
    $get_cate_post =  DB::table('tbl_cate_post')->orderBy('cate_post_id','desc')->get();
      $get_post =DB::table('tbl_post')->where('cate_post_id',$postcateId)->paginate(5);
      return view('pages.different.view_news')->with('get_cate_post',$get_cate_post)->with('get_post',$get_post);
    }

    // slider


    public function edit_slider()
    {
    $edit_slider =  DB::table('tbl_slider_content')->get();
      return view('admin.edit_website_image')->with('edit_slider',$edit_slider);
    }
    public function update_slider(Request $request)
    {
    //  $update_header_image = $request->update_header_image;
     $get_image = $request->file('update_header_image');

     if ($get_image) {
         $get_name_image = $get_image->getClientOriginalExtension();
        //  $name_image = current(explode('.', $get_name_image));
        //  $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        //  $get_image->move('public/uploads/post', $new_image);
        //  $data['post_image'] = $new_image;
        if($get_name_image !="PNG" && $get_name_image !="png" && $get_name_image!=NULL){
          Session::put('message','Yêu cầu ảnh định dạng png !');
          return Redirect()->back();
        }
        elseif($get_name_image =="PNG" || $get_name_image =="png"){
          unlink('public/frontend/assets/img/hero/h1_hero.png');
       $get_image->move('public/frontend/assets/img/hero', "h1_hero.png");
        }
     
     
      }
     
      $get_imagee = $request->file('update_other_image');
      if ($get_imagee) {
        $get_name_imagee = $get_imagee->getClientOriginalExtension();
       //  $name_image = current(explode('.', $get_name_image));
       //  $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
       //  $get_image->move('public/uploads/post', $new_image);
       //  $data['post_image'] = $new_image;
       if($get_name_imagee !="PNG" && $get_name_imagee !="png" && $get_name_imagee!=NULL){
        Session::put('message','Yêu cầu ảnh định dạng png !');
        return Redirect()->back();
      $get_imagee->move('public/frontend/assets/img/hero', "h2_hero.png");
       }  elseif($get_name_imagee =="PNG" || $get_name_imagee =="png"){
        unlink('public/frontend/assets/img/hero/h2_hero1.png');
        $get_imagee->move('public/frontend/assets/img/hero', "h2_hero1.png");
       }
    
    
     }
     $get_imageee = $request->file('update_footer_image');
     if ($get_imageee) {
       $get_name_imageee = $get_imageee->getClientOriginalExtension();
      //  $name_image = current(explode('.', $get_name_image));
      //  $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
      //  $get_image->move('public/uploads/post', $new_image);
      //  $data['post_image'] = $new_image;
      if($get_name_imageee !="PNG" && $get_name_imageee !="png" && $get_name_imageee!=NULL){
       Session::put('message','Yêu cầu ảnh định dạng png !');
       return Redirect()->back();
     $get_imageee->move('public/frontend/assets/img/gallery', "visit_bg.png");
      }  elseif($get_name_imageee =="PNG" || $get_name_imageee =="png"){
       unlink('public/frontend/assets/img/gallery/visit_bg.png');
       $get_imageee->move('public/frontend/assets/img/gallery', "visit_bg.png");
      }
   
   
    }
    //  else{
    //   Session::put('message','Yêu cầu ảnh định dạng png !');
    //   return Redirect()->back();
    // }
    
     $data['content_header_index'] = $request->content_header;
     $data['content_footer_index'] = $request->content_footer;
     $data['intro_product'] = $request->intro_product;
     DB::table('tbl_slider_content')->update($data);
     Session::put('message','cập nhật slider trang web thành công !');
     return Redirect()->back();
     
    }
    
}
