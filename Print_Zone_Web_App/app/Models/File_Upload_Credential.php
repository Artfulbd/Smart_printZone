<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File_Upload_Credential extends Model
{
    use HasFactory;
    protected $table = '_cread96a4f3p';
    protected $primaryKey = 'setting_id';
    public $timestamps = True;
    protected $fillable = [
        'setting_id','max_file_count','max_size_total','server_dir','hidden_dir','temp_dir','created_at','updated_at'
    ];
}
