<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class didTask extends Model
{
    use HasFactory;
    protected $fillable=[
        'body',
        'taketime',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
