<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminTransaction extends Model
{
    use HasFactory;

    protected $table = "admin_transaction";

    public function admin_transaction()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
