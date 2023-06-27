<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\blog;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ShowBlog(){
        $data = blog::paginate(1);
        return view('admin.blog.blog-pages', compact('data'));
    }
    public function ShowAddForm(){
        return view('admin.blog.add-blog');
    }
    public function AddBlog(Request $request){
        $file = $request->image;

        $new_blog = new blog();
        $new_blog->title = $request->title;
        if(!empty($file)){
            $new_blog->image = $file->getClientOriginalName();
            $file->move('upload/blog/images', $file->getClientOriginalName());
        }
        $new_blog->description = $request->input('description');
        $new_blog->content = $request->input('content');
        $new_blog->save();
        return redirect('/admin/blog.html');
    }
    public function ShowEditForm($id){
        $data = blog::where('id',$id)->get();
        return view('admin.blog.edit-blog', compact('data'));
    }
    public function EditBlog($id, request $request){
        $file = $request->image;
        blog::where('id',$id)->update(
            ['title'=>$request->title,
            'image'=>$file->getClientOriginalName(),
            'description'=>$request->description,
            'content'=>$request->content]
        );
        return redirect('/blog.html');
    }
    public function DeleteBlog($id){
        blog::where('id',$id)->delete();
        return redirect('/blog.html');
    }
}
