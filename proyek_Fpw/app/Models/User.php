<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = ['fname','lname','email','notelp','password','status'];
    protected $primaryKey   = "email";
    public $incrementing    = false;
    public $timestamps      = true;
}
