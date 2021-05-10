<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    // Table Name
    protected $table = 'zones';
    // Primary Key
    public $primaryKey = 'zone_id';
    public $timestamps = true;
}
