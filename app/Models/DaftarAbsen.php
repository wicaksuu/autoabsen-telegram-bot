<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarAbsen extends Model
{
    use HasFactory;
    protected $fillable = [

        'chatId',
        'UrlAbsen',
        'nama',
        'nip',
        'password',
        'koordinat',
        'device',
        'Agent',
        'token',
        'saldo',
        'status',
        'aksi_terakhir',
        'pesan_terakhir',
        'work_code',
    ];
}
