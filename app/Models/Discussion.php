<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Auth;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'channel_id',
        'slug',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function channel(){
        return $this->belongsTo('App\Models\Channel');
    }

    public function replies(){
        return $this->hasMany('App\Models\Reply');
    }

    public function watchers(){
        return $this->hasMany('App\Models\Watcher');
    }

    public function is_being_watched_by_auth_user(){

        $id = Auth::id();

        $watchers_ids = array();

        foreach($this->watchers as $w):
            array_push($watchers_ids, $w->user_id);
        endforeach;

        if(in_array($id, $watchers_ids)){
            return true;
        }
        else{
            return false;
        }
    }

    public function hasBestAnswer(){
        $result = false;

        foreach($this->replies as $reply):
            if($reply->best_answer){
                $result = true;
                break;
            }
        endforeach;

        return $result;
    }
}
