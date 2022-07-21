<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelWinner extends Model
{
    protected $table = "tbl_pemenang";
    protected $guarded = [];
    public $timestamps = false;
}
