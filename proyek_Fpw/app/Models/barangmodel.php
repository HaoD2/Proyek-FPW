<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barangmodel extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $fillable = ['nama_barang', 'kategori_barang','deskripsi','harga','email_penjual'];
    public $incrementing    = false;
    public $timestamps      = true;
}
