<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\CommentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'user_id' => Auth::id(),
            'homestay_id' => $request->homestay_id,
            'parent_id' => $request->parent_id,
            'content' => $request->content
        ];
        Comment::create($data);

        return redirect()->back()->with('success', __('Comment successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function report($id)
    {
        $comment = Comment::find($id);

        return view("modal.report-comment", compact("comment"))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createReport(Request $request)
    {
        $data = [
            'user_id' => auth()->id(),
            'comment_id' => $request->comment_id,
            'content' => $request->content,
            'status' => '0',
        ];
        CommentReport::create($data);

        return redirect()->back()->with('success', __('Report successfully!!!'));
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
        $data = ['content' => $request->content];
        Comment::find($id)->update($data);

        return redirect()->back()->with('success', __('Update comment successfully!!!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commentChilds = Comment::where('parent_id', $id)->get();
        foreach ($commentChilds as $item) {
            Comment::find($item->id)->delete();
        }
        Comment::find($id)->delete();

        return redirect()->back()->with('success', __('messages.delete.success'));
    }
}
