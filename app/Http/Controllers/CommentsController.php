<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');

    }
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$post_id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'website' => 'required|max:400',
            'comment' => 'required|min:5|max:2000',
        ]);

        $post = Post::find($post_id);
        $comment = new Comment();
        $comment->name =  $request->input('name');
        $comment->email =  $request->input('email');
        $comment->website =  $request->input('website');
        $comment->comment =  $request->input('comment');
        $comment->approved = 0;
        $comment->post()->associate($post);
        $comment->save();
        Session::flash('success_message', 'Success! comment was added!');
        return redirect()->back();


    }

    public function commentStatusChange(Request $request)
    {

        $input = $request->all();
        $input = array_map('strip_tags',$input);
        $id = $input['id'];
        $comment = Comment::findOrFail($id);
        $comment->approved = $input['approved'];
        $comment->save();
        Session::flash('success_message', 'Success! comment status was changed!');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment =  Comment::findOrFail($id);
        $comment->delete();
        Session::flash('success_message', 'Success! Comment successfully deleted!');
        return redirect()->back();
    }
}
