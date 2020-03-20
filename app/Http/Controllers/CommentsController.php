<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Http\Requests\AddCommentRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function getIndex()
    {
    	$comments = Comments::where('type',1)->orderBy('id','desc')->paginate(10);
    	Carbon::setLocale('vi');
    	foreach($comments as $comment){
    		$comment->date = $comment->created_at->diffForHumans(now());
    	}
    	return view('backend.comments.index',['comments' => $comments]);
    }
    public function postAddComment(AddCommentRequest $request)
    {
    	$comment             = new Comments;
        $comment->name       = $request->name;
        $comment->phone      = $request->phone;
        $comment->email      = $request->email;
        $comment->content    = $request->post('content');
        $comment->type    	 = $request->type;
        $comment->comment_id = $request->comment_id;
        $comment->post_id    = $request->post_id;
        $comment->save();
        $comment->avatar = asset('backend/assets/images/avatar-no-image.png');
        Carbon::setLocale('vi');
        $comment->date = $comment->created_at->diffForHumans(now());
        return response()->json($comment, 200);
    }
    public function changeStatus($id)
    {
    	$comment = Comments::findOrFail($id);
    	$comment->status == 0 ? $comment->status = 1 : $comment->status = 0;
    	$comment->save();
    	return response()->json($comment, 200);
    }
    public function getDelete($id)
    {
        $comment = Comments::findOrFail($id);
        Comments::where('comment_id', $comment->id)->delete();
        Comments::where('id', $comment->id)->delete();
        return response()->json($comment, 200);
    }
    public function getOnAll(){
        $comments = Comments::get();
        foreach($comments as $comment){
            $comment->status = 1;
            $comment->save();
        }
        return redirect()->route('CommentsGetIndex')->with(['success' => 'Đã duyệt tất cả bình luận']);
    }
}
