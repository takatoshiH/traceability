<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }

    public function content()
    {
        return $this->belongsTo('App\Models\Content');
    }

    protected $fillable = ['comment', 'latitude', 'longitude'];
}
