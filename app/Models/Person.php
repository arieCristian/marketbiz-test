<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory,HasUuids ;
    protected $guarded = [''];

    public static function search($search){
        return empty($search) ? static::query() 
        : static::query()->where('name','like','%'.$search.'%')->orWhere('job','like','%'.$search.'%');
    }
}
