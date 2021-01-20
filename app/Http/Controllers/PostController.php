<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use Illuminate\Http\Request;
use Auth;

use DB;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
'post'=>'required',
'cover_image' => 'image|nullable|max:1999'
  ]);

if($request->hasFile('cover_image')){

  $filenamewithExt = $request->file('cover_image')->getClientOriginalName();
  $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
  $extension = $request->file('cover_image')->getClientOriginalExtension();
  $fileNameToStore = $filename .'_'.time().'.'.$extension;
  $path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
} else {
  $fileNameToStore = 'noimage.jpeg';
}


$posts = new post;
$posts->user_id = Auth::user()->id;
$posts->name = Auth::user()->name;
$posts->post = $request->input('post');
$posts->cover_image = $fileNameToStore;
$posts->created_at = now();

$posts->save();




  return redirect('post/show')->with('success','Post Created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    $posts = post::orderBy('created_at', 'DESC')->get();

  $comments = DB::table('comments')->where('post_id', $id)->get();



        return view('post.show', ['posts'=>$posts, 'comments'=>$comments]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

$posts = post::find($id);
$posts->status = $request->input('status');

$posts->save();

return redirect('/post/show')->with('success','Equipment Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $posts = post::find($id);
      $posts->delete();
      return redirect('/profile/show')->with('success','Post Deleted.');
    }


}
