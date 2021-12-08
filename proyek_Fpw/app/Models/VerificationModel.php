<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationModel extends Model
{
    use HasFactory;
    protected $table = 'user';
    protected $fillable = [];
    protected $primaryKey   = "email";
    public $incrementing    = false;
    public $timestamps      = false;
}
