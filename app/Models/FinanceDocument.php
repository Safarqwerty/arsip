<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_arsip',
        'nama_arsip',
        'kategori',
        'keterangan',
        'file_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
