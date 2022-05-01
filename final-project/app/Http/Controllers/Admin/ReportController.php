<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\CommentController;
use App\Models\Comment;
use App\Models\Homestay;
use App\Models\HomestayReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function comment()
    {
        $comments = Comment::where('status', '0')->get();

        return view('admin.report.comment', ['comments' => $comments]);
    }

    public function handleComment($id)
    {
        $comment = Comment::find($id);
        CommentController::destroy($id);
        User::find($comment->user_id)->update(['status' => '1']);

        return redirect()->back()->with('message', 'Bock User successfully!!!');
    }

    public function blockComments($id)
    {
        $comment = Comment::find($id)->toArray();
        CommentController::destroy($id);
        $user = User::find($comment['user_id']);
        Mail::send('mail.report_comment', $comment, function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Notice of your comments!!!');
        });

        return redirect()->back()->with('message', 'Notice User successfully!!!');
    }

    public function homestay()
    {
        $homestays = Homestay::all();
        $homestayReports = HomestayReport::where('status', '0')->get();

        return view('admin.report.homestay', ['homestays' => $homestays, 'homestayReports' => $homestayReports]);
    }

    public function handleHomestay($id)
    {
        $homestay = Homestay::find($id)->toArray();
        $user = User::find($homestay['user_id']);
        Mail::send('mail.report_homestay', $homestay, function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Notice of your homestay!!!');
        });
        $homestayReports = HomestayReport::where('homestay_id', $id)->get();
        foreach ($homestayReports as $item) {
            HomestayReport::where('id', $item->id)->update(['status' => "1"]);
        }

        return redirect()->back()->with('message', 'Notice User successfully!!!');
    }
}
