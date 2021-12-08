<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationModel extends Model
{
    use HasFactory;
    protected $table = 'seller_verification';
    protected $fillable = ['email', 'foto', 'selfie'];
    protected $primaryKey   = "email";
    public $incrementing    = false;
    public $timestamps      = true;
}
