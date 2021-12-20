<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $fillable = ['email', 'id_barang','jumlah'];
    public $incrementing    = true;
    public $timestamps      = true;
}
