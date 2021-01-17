<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\True_;

class Pending_File extends Model
{
    use HasFactory;
    protected $table = 'pending_file';
    public $primaryKey = 'file_id';
    public $timestamps = True;
    protected $fillable = [
        'file_id','id','file_name','pg_count','size','is_online','created_at','updated_at'
    ];
}
