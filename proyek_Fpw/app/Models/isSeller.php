<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class isSeller extends Model
{
    use HasFactory;
    protected $table = 'isSeller';
    protected $fillable = ['email', 'status'];
    public $incrementing    = false;
    public $timestamps      = true;
}
