<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Discussion;

use App\Models\Channel;

use Auth;

use Illuminate\Pagination\Paginator;

class ForumsController extends Controller
{
    public function index(){

        // $discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);

        switch (request('filter')) {
            case 'me':
                $results = Discussion::where('user_id', Auth::id())->paginate(3);
                break;

            case 'solved':
                {
                    $answered = array();

                    $discussions = Discussion::all();

                    foreach($discussions as $d):
                        if($d->hasBestAnswer())
                        {
                            array_push($answered, $d);
                        }
                    endforeach;

                    $results = new Paginator($answered, 3);
                    break;
                }

            case 'unsolved':
                {
                    $answered = array();
        
                    foreach(Discussion::all() as $d):
                        if(!$d->hasBestAnswer())
                        {
                            array_push($answered, $d);
                        }
                    endforeach;
        
                    $results = new Paginator($answered, 3);
                    break;
                }
            
            default:
                $results = Discussion::orderBy('created_at', 'desc')->paginate(3);
                break;
        }

        return view('dashboard', ['discussions' => $results]);
    }

    public function channel($slug){
        $channel = Channel::where('slug', $slug)->first();

        return view('channel')->with('discussions', $channel->discussions()->paginate(3));
    }


}
