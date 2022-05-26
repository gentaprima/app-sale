<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTransactionMember extends Model
{
    protected $table = "tbl_transaction_member";
    protected $guarded = [];
    public $timestamps = false;

    public function product(){
        return $this->belongsToMany(ModelProduct::class,'tbl_transaction_member','id_product','id');
    }
}
