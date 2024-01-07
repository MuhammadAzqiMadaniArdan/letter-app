<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Letter extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'letter_type_id',
        'letter_perihal',
        'recipients',
        'content',
        'attachment',
        'notulis',
    ];


//    no tulis adalah no id dari user
    // penegasan tipe data dari migration (hasil property ini ketika diambil atau diinsert/update dibuat dalam bentuk tipe data apa)
    protected $casts = [
        'recipients' => 'array',
        'attachment' => 'string'
    ];
    
    
    public function letter_type()
    {
        // menghubungkan ke primary key nya
        // dalam kurung merupakan nama mo1del tempat penyimpanan dari pk nya si fk yang ada di model ini
        return $this->belongsTo(Letter_type::class,'letter_type_id','id');
    }
    public function user()
    {
        // menghubungkan ke primary key nya
        // dalam kurung merupakan nama model tempat penyimpanan dari pk nya si fk yang ada di model ini
        // return $this->belongsTo(User::class,'notulis','id');
        return $this->belongsTo(User::class,'notulis','id');
    }
    public function result()
    {
        // membuat relasi ke table lain dengan tipe one to many
        // dalam kurung merupakan nama model yang akan disambungkan (tempat fk)
        return $this->hasMany(Result::class,'letter_id','id');
    }
    // protected static function boot()
    // {
    //     parent::boot();
    
    //     static::creating(function ($model) {
    //         $model->notulis = $model->user_id ?: 0;;
    //     });
    // }
}
