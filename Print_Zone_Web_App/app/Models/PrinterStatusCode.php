<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterStatusCode extends Model
{
    use HasFactory;
    // Table Name
    protected $table = 'printer_status_code';
    // Primary Key
    public $primaryKey = 's_code';
    public $timestamps = true;
}
