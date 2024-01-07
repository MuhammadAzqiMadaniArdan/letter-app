<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter_type extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_code',
        'name_type',
    ];

    public function letter()
    {
        // membuat relasi ke table lain dengan tipe one to many
        // dalam kurung merupakan nama model yang akan disambungkan (tempat fk)
        return $this->hasMany(Letter::class,'letter_type_id','id');
    }
}
