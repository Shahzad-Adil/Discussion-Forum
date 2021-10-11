<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Discussion;
use App\Models\Reply;
use App\Models\User;

use Auth;
use Session;
use Str;
use Notification;

class DiscussionsController extends Controller
{
    public function store(){
        $r = request();

        $this->validate($r, [
            'title' => 'required',
            'channel_id' => 'required',
            'content' => 'required',
        ]);

        $discussion = Discussion::create([
           'title' => $r->title,
           'channel_id' =>$r->channel_id,
           'content' => $r->content,
           'user_id' => Auth::id(), 
           'slug' => Str::slug($r->title),
        ]);

        Session::flash('success', 'Discussion Created.');

        return redirect()->route('discussions', ['slug' => $discussion->slug]);
    }

    public function create(){
        return view('discuss');
    }

    public function show($slug){

        $discussion = Discussion::where('slug', $slug)->first();

        $best_answer = $discussion->replies()->where('best_answer', 1)->first();

        return view('discussions.show')->with('dd', $discussion)->with('best_answer', $best_answer);
    }

    public function reply($id){

        $d = Discussion::find($id);

        $r = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $id,
            'content' => request()->reply,
        ]);

        $r->user->points += 25;

        $r->user->save();

        $watchers = array();

        foreach($d->watchers as $watcher):
            array_push($watchers, User::find($watcher->user_id));
        endforeach;

        Notification::send($watchers, new \App\Notifications\NewReplyAdded($d));

        Session::flash('success', 'Reply Created.');

        return redirect()->back();
        
    }

    public function edit($slug){
        return view('discussions.edit')->with('discussion', Discussion::where('slug', $slug)->first());
    }

    public function update($id){
        $d = Discussion::find($id);

        $this->validate(request(),[
            'content' => 'required'
        ]);

        $d->content = request()->content;

        $d->save();

        Session::flash('success', 'Discussion updated.');

        return redirect()->route('discussions', ['slug' => $d->slug]);
    }
}
