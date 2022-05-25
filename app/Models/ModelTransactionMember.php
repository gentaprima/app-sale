<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTransactionMember extends Model
{
    protected $table = "tbl_transaction_member";
    protected $guarded = [];
    public $timestamps = false;
}
