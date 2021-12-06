<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class request_saldo extends Model
{
    use HasFactory;
    protected $table = 'request_saldo';
    protected $fillable = ['nama_user','email_user','jumlah'];
    public $incrementing    = false;
    public $timestamps      = true;
}
