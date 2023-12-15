<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarAbsen extends Model
{
    use HasFactory;
    protected $fillable = [
        'chatId',
        'nama',
        'nip',
        'password',
        'koordinat',
        'device',
        'token',
        'saldo',
        'status',
        'aksi_terakhir',
        'pesan_terakhir',
        'Agent',
        'work_code'
    ];
}
