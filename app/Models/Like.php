<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reply_id',
    ];

    public function reply(){
        return $this->belongsTo('App\Models\Reply');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
