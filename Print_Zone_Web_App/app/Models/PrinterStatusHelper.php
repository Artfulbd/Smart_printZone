<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterStatusHelper extends Model
{
    use HasFactory;
    // Table Name
    protected $table = 'printe618r_status_helper';
    // Primary Key
    public $primaryKey = 'u_id';
    public $timestamps = true;
}
