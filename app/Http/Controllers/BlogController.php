<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Post;

class BlogController extends Controller
{
public function __construct()
{
 $this->middleware('auth')->except(['index','show']);   
}
    //
    public function index(Request $request){
        if($request->search){
$posts= Post::where('title','like', '%'.$request->search.'%')
->orWhere('body','like', '%'.$request->search.'%')->latest()->paginate(4);
        }
        elseif($request->category){
            $posts=Category::where('name',$request->category)->firstOrfail()->posts()->paginate(3)->withQueryString();

        }
        else {
             $posts=Post::latest()->paginate(4);
        }

     
$categories=Category::all();
        return view('blogPosts.blog',compact('posts','categories'));
    }
    public function create(){
        $categories=Category::all();
        return view('blogPosts.create-blog-post', compact('categories'));
      
    }
    public function store(Request $request){

    // this is meant to test whether you are getting everything from the user.
        // $allInputs=$request->all();
     
        // this is meant to test a special input filed value is getting from the user.
        // $title=$request->input('title');
        // dd('title');

        $request->validate([
            'title'=>'required',
            'imagePath'=>'required|image|mimes:png,jpg,jpeg,gif',
            'body'=>'required',
            'category_id'=>'required'
        ],
        [
            'title.required'=>'Please the title field can not be empty!',
            'imagePath.required'=>'Please upload an image!',
            'imagePath.image'=>'The file has to an image',
            'imagePath.mimes'=>'The image has to be PNG, JPG, JPEG, and GIF only',
            'body.required'=>'The body field can not be empty!',
            'category_id.required'=>'The category field is required',
        ]
    );
    $title=$request->input('title');
    $category_id=$request->input('category_id');
  if(Post::latest()->first() !==null){
    $postId=Post::latest()->first()->id+1;

  }
  else{
      $postId=1;
  }

    $slug=Str::Slug($title,'-').'-'.$postId;
    $user_id=Auth::user()->id;
    $body=$request->input('body');
    //upload image
   $imagePath = 'storage/'. $request->file('imagePath')->store('PostImages','public');
  //'storage'.      PostImages/0c04hKV0QEHBnZXxsTyGQPYKZUPr2jxYaCkZqLBb.png
  // I want to save to the database
  $post=new Post();
  $post->title=$title;
  $post->category_id=$category_id;
  $post->slug=$slug;
  $post->user_id=$user_id;
  $post->body=$body;
  $post->imagePath=$imagePath;
 
  $post->save();

    return redirect()->back()->with('success','Post created successfully');
        
       
    }
    public function edit(Post $post){
        if(auth()->user()->id!==$post->user->id){
            abort(403);

        }

        return view('blogPosts.edit-blog-post',compact('post'));
    }
    public function update(Request $request, Post $post){
        if(auth()->user()->id!==$post->user->id){
            abort(403);

        }
        $request->validate([
            'title'=>'required',
            'imagePath'=>'required|image|mimes:png,jpg,jpeg,gif',
            'body'=>'required'
        ],
        [
            'title.required'=>'Please the title field can not be empty!',
            'imagePath.required'=>'Please upload an image!',
            'imagePath.image'=>'The file has to an image',
            'imagePath.mimes'=>'The image has to be PNG, JPG, JPEG, and GIF only',
            'body.required'=>'The body field can not be empty!'
        ]
    );
    $title=$request->input('title');
    $postId=$post->id;
    $slug=Str::Slug($title,'-').'-'.$postId;
    
    $body=$request->input('body');
    //upload image
   $imagePath = 'storage/'. $request->file('imagePath')->store('PostImages','public');
  //'storage'.      PostImages/0c04hKV0QEHBnZXxsTyGQPYKZUPr2jxYaCkZqLBb.png
  // I want to save to the database
  
  $post->title=$title;
  $post->slug=$slug;
  
  $post->body=$body;
  $post->imagePath=$imagePath;
 
  $post->save();

    return redirect()->back()->with('success','Post edited successfully');
        
       

       
    }




    // public function show($slug){
    //     $post= Post::where('slug',$slug)->first();
     
    //    
    // }
// Using route model binding 
public function show(Post $post){
    $category=$post->category;
    $relatePosts=$category->posts()->where('id','!=',$post->id)->latest()->take(3)->get();

    return view('blogPosts.single-blog-post', compact('post','relatePosts'));
}
// this is the delete route
public function destroy(Post $post){

    $post->delete();
    return redirect()->back()->with('success','Post deleted successfully');
}
    public function about(){
        return view('about');
    }
 
}
