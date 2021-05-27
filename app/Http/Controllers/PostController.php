<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\Like;
use Hashids;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::where('user_id' , Auth::id())->with('total_comments', 'total_like')->orderby('created_at', 'desc')->get();
        // dd($posts);
        return view('posts.index', compact('posts'));
    }
    public function create_index()
    {
        return view('posts.create');
    }
    public function store(Request  $request)
    {
        $this->validate($request, [
            'title' => 'Required',
            'description' => 'Required',
        ]);
        $requestdata = $request->all();
        $requestdata['user_id'] = Auth::id();
        Post::create($requestdata);
        Session::flash('success', 'Post Created successfully');
        return redirect('post/index');
    }

    public function post_comment(Request $request)
    {
        $requestdata = $request->all();
        $requestdata['user_id'] = Auth::id();
        // dd($requestdata);
        comment::create($requestdata);
        return back();
    }

    public function like_post(Request $request)
    {

       
        $likes =  Like::where('post_id', $request->datid)->get();
       

        $posts =  Post::findorFail($request->datid)->update(['follow_status' => '1']);
     
        if(empty($likes[0])){

            Like::create(['post_id' => $request->datid , 't_likes'=> '1']);
            return back();

        }
        else
        {

            $t_likes =    $likes[0]->t_likes + 1 ;
            Like::where('post_id', $request->datid)->update(['t_likes' => $t_likes]);
            return back();
        }

       
    }


    public function unlike_post(Request $request)
    {

       
        $likes =  Like::where('post_id', $request->datid)->get();
       

        $posts =  Post::findorFail($request->datid)->update(['follow_status' => '0']);
     
        if(empty($likes[0])){

            
            return back();

        }
        else
        {
            if ($likes[0]->t_likes  >= -1) {
             $t_likes =    $likes[0]->t_likes - 1 ;
            Like::where('post_id', $request->datid)->update(['t_likes' => $t_likes]);
            return back();
            }
           
        }

       
    }

    
}
