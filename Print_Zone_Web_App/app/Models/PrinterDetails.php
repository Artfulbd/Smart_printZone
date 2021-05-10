<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterDetails extends Model
{
    use HasFactory;
    // Table Name
    protected $table = 'print43er_details234c23452';
    // Primary Key
    public $primaryKey = 'printer_id';
    public $timestamps = true;
}
