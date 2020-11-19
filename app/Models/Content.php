<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }

    public function trace()
    {
        return $this->hasMany('App\Models\Trace');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($content){
            $content->traces()->delete();
        });
    }

    protected $table = 'contents';

    protected $fillable = ['brand', 'name', 'price', 'information'];

}
