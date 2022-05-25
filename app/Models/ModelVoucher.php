<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelVoucher extends Model
{
    protected $table = "tbl_voucher";
    protected $guarded = [];
    public $timestamps = false;
}
