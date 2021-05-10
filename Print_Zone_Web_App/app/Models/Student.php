<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = '_user711qd9m';
    protected $primaryKey = 'id';
    public $timestamps = True;
    protected $fillable = [
        'id','status','page_left','total_printed','pending','created_at','updated_at','currently_printing'
    ];
}
