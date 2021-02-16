<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;
    protected $table = 'system';
    public $primaryKey = 'system_id';
    public $timestamps = True;
    protected $fillable = [
        'system_id','status','created_at','updated_at'
    ];
}
