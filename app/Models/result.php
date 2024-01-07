<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_id',
        'notes',
        'presence_recipients',
    ];

    // penegasan tipe data dari migration (hasil property ini ketika diambil atau diinsert/update dibuat dalam bentuk tipe data apa)
    protected $casts = [
        'notes' => 'array',
    ];

    public function letter()
    {
        // menghubungkan ke primary key nya
        // dalam kurung merupakan nama model tempat penyimpanan dari pk nya si fk yang ada di model ini
        return $this->belongsTo(Letter::class,'letter_id','id');
    }
}
