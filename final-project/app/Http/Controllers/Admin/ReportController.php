<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\CommentController;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function comment()
    {
        $comments = Comment::all();
        
        return view('admin.report.comment', ['comments' => $comments]);
    }

    public function handleComment($id)
    {
        $comment = Comment::find($id);
        CommentController::destroy($id);
        User::find($comment->user_id)->update(['status' => '1']);        

        return redirect()->back()->with('message','Bock User successfully!!!');
    }

    public function homestay()
    {
        return view('admin.report.homestay');
    }

    public function handleHomestay($id)
    {
        //
    }
}
