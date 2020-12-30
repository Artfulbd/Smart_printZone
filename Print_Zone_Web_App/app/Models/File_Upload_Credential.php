<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File_Upload_Credential extends Model
{
    use HasFactory;
    protected $table = 'file_upload_credential';
    protected $primaryKey = 'setting_id';
    public $timestamps = True;
    protected $fillable = [
        'setting_id','max_file_count','max_size_total','storing_location','created_at','updated_at'
    ];
}
