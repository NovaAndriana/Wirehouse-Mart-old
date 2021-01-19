<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'contact_person', 'email',  'no_telp',  'alamat',
    ];
}
