<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Kas extends Model
{
    protected $table = 'kas';

    protected $fillable = ['nama_warga', 'setoran', 'tanggal', 'kategori', 'payment_method', 'destination', 'keterangan', 'user_id'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
