<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable
{
    use HasFactory;
    protected $table = 'user';
    protected $fillable = ['fname','lname','email','notelp','password','level','status','isSeller', 'saldo'];
    protected $primaryKey   = "email";
    public $incrementing    = false;
    public $timestamps      = false;
}
