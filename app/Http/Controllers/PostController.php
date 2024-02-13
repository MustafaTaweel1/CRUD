<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //show all posts in the database 5 posts per page 
    public function index()
    {
        $posts = Post::with('category')->paginate(5);
                                //time set in cache         
        // $posts=Cache::remember('posts-page-'.request('page',1),60,function(){
        //     return Post::with('category')->paginate(5);
        // });
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    //go to page posts.create and  insert data in website
    public function create()
    {
        //GATE 
        // $this->authorize('create_post');
        //policy 
        $this->authorize('create',Post::class);
        $category=Category::all();
        return view('posts.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // take request data from create and insert into storage
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required','max:5000','image'],
            'title' => ['required','max:255'],
            'category_id' => ['required','integer'],
            'description' => ['required']
        ]);
        //name image and insert file
        $fileName=time().'_'.$request->image->getClientOriginalName();
        $filePath=$request->image->storeAs('Uploads',$fileName);
        $post=new Post();
        $post->title=$request->title;
        $post->description=$request->description;
        $post->category_id=$request->category_id;
        $post->image = 'storage/'.$filePath;
        $post->save();
        return redirect()->route('Posts.index');
    }

    // take data from posts.edit and update post with new values
    public function update(Request $request,$id)
    {
        $post=Post::findOrFail($id);
        // 'image' => ['required','max:5000','image'],
        $request->validate([
            'title' => ['required','max:255'],
            'category_id' => ['required','integer'],
            'description' => ['required']
        ]);
        if($request->hasFile('image')){
            $request->validate([
            'image' => ['required','max:5000','image'],
        ]);
        $fileName=time().'_'.$request->image->getClientOriginalName();
        $filePath=$request->image->storeAs('Uploads',$fileName);
        File::delete(public_path($post->image));
        $post->image = 'storage/'.$filePath;
        }
        //name image and insert file
        $post->title=$request->title;
        $post->description=$request->description;
        $post->category_id=$request->category_id;
        $post->save();
        return redirect()->route('Posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posts=Post::findOrFail($id);
        return view('Posts.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    //edit method take id posts and send to posts.edit  and edit data 
    public function edit(string $id)
    {
        $post=Post::findOrFail($id);
        $this->authorize('update', $post);
        $category=Category::all();
        return view('Posts.edit', compact('post', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */

        //


    /**
     * Remove the specified resource from storage.
     */
    //delete from  list  posts and send to trashed posts
    public function destroy( $id)
    {
        $post=Post::findOrFail($id);
        $this->authorize('delete', $post);

        $post->delete();
        return redirect()->route('Posts.index');
    }

    //show all posts for Trashed 
    public function trashed(){
        $posts=Post::onlyTrashed()->get();
        // $posts=Post::paginate(5);
        return view('Posts.trashed', compact('posts'));
    }
    //return Post to the database  posts its Trashed 
    public function restore($id){
        $post=Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->back();
    }
    // delete the Posts from storage  Drop in database
    public function forcedelete($id){
        $post=Post::onlyTrashed()->findOrFail($id);
        File::delete(public_path($post->id));
        $post->forceDelete();
        return redirect()->back();
    }
}
