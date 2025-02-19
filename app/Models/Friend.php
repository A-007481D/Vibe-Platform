<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function sender(){
        return $this->belongsTo(User::class,"sender_id");
    }
    
    public function reciever(){
        return $this->belongsTo(User::class,"reciever_id");
    }
}
