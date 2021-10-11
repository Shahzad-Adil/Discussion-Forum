<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watcher extends Model
{
    use HasFactory;

    protected $fillable = [
        'discussion_id',
        'user_id',
    ];

    public function discussion(){
        return  $this->belongsTo('App\Models\Discussion');
    }

    public function user(){
        return  $this->belongsTo('App\Models\User');
    }
}
