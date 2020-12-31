<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'name', 'stok', 'satuan',  'category',  'brand',  'supplier', 'harga_beli', 'harga_jual', 'diskon', 'deskripsi', 'image',
    ];
}
