<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Like;

use Auth;
use Session;
use App\Models\Reply;

class RepliesController extends Controller
{
    public function like($id){

        Like::create([
            'reply_id' => $id,
            'user_id' => Auth::id(),
        ]);

        Session('success', 'You liked the reply');

        return redirect()->back();
    }

    public function unlike($id){

        $like = Like::where('user_id', Auth::id())->where('reply_id', $id)->first();

        $like->delete();

        Session('success', 'You unliked the reply');

        return redirect()->back();
    }

    public function best_answer($id){
        $reply = Reply::find($id);
        $reply->best_answer = 1;
        $reply->save();

        $reply->user->points += 50;
        $reply->user->save();

        Session('success', 'You marked the reply as best answer');

        return redirect()->back();
    }

    public function edit($id){
        return view('replies.edit', ['reply' => Reply::find($id)]);
    }

    public function update($id){
        $r = Reply::find($id);

        $this->validate(request(), [
            'content' => 'required'
        ]);

        $r->content = request()->content;

        $r->save();

        Session('success', 'Reply updated successfully.');

        return redirect()->route('discussions', ['slug' => $r->discussion->slug]);
    }
}
