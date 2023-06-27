<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\rate;
use App\Models\comment;


class BlogMController extends Controller
{
    public function ShowBlog(){
        $data = blog::orderBy('id','DESC')->paginate(3);
        return view('frontend.blogs.blog', compact('data'));
    }
    public function ShowBlogSingle($id){
        $id_blog = $id;
        $data = blog::where('id',$id)->get();
        $pre = blog::where('id','<',$id)->max('id');
        $next = blog::where('id','>',$id)->min('id');

        //rate
        $mark = rate::where('id_blog',$id_blog)->get();
        $numberOfRate = rate::where('id_blog', $id_blog)->get()->count();
        $sum = 0;
        foreach ($mark as $key => $value){
            $sum +=$value->mark;
        }
        $averageMark = 0;
        if($numberOfRate > 0){
        round($averageMark = $sum / $numberOfRate);
        }

        //comment
        $comment = comment::where([
            ['id_blog', $id_blog],
        ])->get();

       
        return view('frontend.blogs.blog-single', compact('data','pre','next','id_blog','averageMark','comment'));
    }
    public function RateBlog(){
        $id_user = Auth::id();
        $id_blog = $_POST['id_blog'];
        $mark = $_POST['mark'];
        
        $isDuplicate = rate::where([
            ['id_blog', $id_blog],
            ['id_user', $id_user]
        ])->get()->count();
        
        if($isDuplicate == 0){
            
            $new_rate = new rate();
            $new_rate->id_user = $id_user;
            $new_rate->id_blog = $id_blog;
            $new_rate->mark = $mark;
            $new_rate->save();
        }
        else{
            rate::where([
            ['id_blog', $id_blog],
            ['id_user', $id_user]
            ])->update(['mark'=>$mark]);
        };    
    }
    public function CommentBlog(Request $request){
        $id_user = Auth::id();
        $id_blog = $request->id_blog;
        $comment = $request->comment;
        $id_cmt = $request->id_cmt;

        if($id_cmt == 0){
            $new_comment = new comment();
            $new_comment->id_user = $id_user;
            $new_comment->id_blog = $id_blog;
            $new_comment->comment = $comment;
            $new_comment->save();
        }else{
            $new_comment = new comment();
            $new_comment->id_user = $id_user;
            $new_comment->id_blog = $id_blog;
            $new_comment->comment = $comment;
            $new_comment->level = $id_cmt;
            $new_comment->save();
        }
        
          
        return redirect()->back();
    }
}

