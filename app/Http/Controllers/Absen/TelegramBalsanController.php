<?php

namespace App\Http\Controllers\Absen;

use App\Http\Controllers\Controller;
use App\Models\DaftarAbsen;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBalsanController extends Controller
{
    public $daftarAbsen = [
        ['Daftar-Absen-Jatim-Prov'],
        ['Daftar-Absen-Madiun-Kab'],
    ];
    public $urlAbsen = [
        'madiunkab' => [
            'nama' => 'Presensi Kab. Madiun',
            'url' => 'https://absen.madiunkab.go.id'
        ],
        'jatimprov' => [
            'nama' => 'Presensi Prov. Jawa Timur',
            'url' => 'https://absen.madiunkab.go.id'
        ]
    ];

    public function start($chatId, $messageText = null)
    {
        $data_absen = DaftarAbsen::where('chatId', $chatId)->first();
        if (!$data_absen) {
            Telegram::sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
            $pesan = "Saya adalah chat bot yang akan membantu anda untuk melakukan presensi kerja dimanapun\n\nBerikut Daftar Suport Kami";
            $replyMarkup = ['keyboard' => $this->daftarAbsen, 'resize_keyboard' => true, 'one_time_keyboard' => true];
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => $pesan,
                'reply_markup' => json_encode($replyMarkup),
            ]);
            return;
        } else {

            // Telegram::sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
            // $pesan = "Saya adalah chat bot yang akan membantu anda untuk melakukan presensi kerja dimanapun\n\nBerikut Daftar Suport Kami";
            // $replyMarkup = ['keyboard' => $this->daftarAbsen, 'resize_keyboard' => true, 'one_time_keyboard' => true];
            // Telegram::sendMessage([
            //     'chat_id' => $chatId,
            //     'text' => $pesan,
            //     'reply_markup' => json_encode($replyMarkup),
            // ]);
            // return;
        }
    }

    public function custom($chatId, $messageText)
    {
        switch ($messageText) {
            case 'Daftar-Absen-Jatim-Prov':
                Telegram::sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
                $pesan = "Anda yakin akan mendaftar presensi Provinsi Jawa Timur ?";
                $keyboard = [['Ya-Daftar-Jatim-Prov'], ['Tidak-Daftar-Jatim-Prov']];
                $replyMarkup = ['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => true];
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => $pesan,
                    'reply_markup' => json_encode($replyMarkup),
                ]);
                break;

            case 'Daftar-Absen-Madiun-Kab':
                Telegram::sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
                $pesan = "Anda yakin akan mendaftar presensi Kabupaten Madiun ?";
                $keyboard = [['Ya-Daftar-Madiun-Kab'], ['Tidak-Daftar-Madiun-Kab']];
                $replyMarkup = ['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => true];
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => $pesan,
                    'reply_markup' => json_encode($replyMarkup),
                ]);
                break;

            case 'Ya-Daftar-Madiun-Kab':
                DaftarAbsen::create(['chatId' => $chatId, 'aksi_terakhir' => 'inputNama']);
                Telegram::sendMessage(['chat_id' => $chatId, 'text' => 'Silahkan Masukkan Nama Anda !']);

                break;


            default:
                $data_absen = DaftarAbsen::where('chatId', $chatId)->first();
                switch ($data_absen->aksi_terakhir) {
                    case 'inputNama':
                        $data_absen->aksi_terakhir = 'inputNip';
                        $data_absen->nama = $messageText;
                        $data_absen->save();
                        Telegram::sendMessage(['chat_id' => $chatId, 'text' => "Hai $messageText\n\nSilahkan Masukkan NIP Anda !"]);
                        break;
                    case 'inputNip':
                        $data_absen->aksi_terakhir = 'inputPassword';
                        $data_absen->nip = $messageText;
                        $data_absen->save();
                        Telegram::sendMessage(['chat_id' => $chatId, 'text' => "Hai " . $data_absen->nama . "($messageText)\n\nSilahkan Masukkan Password Akun Presensi Anda !"]);
                        break;
                    case 'inputPassword':
                        $data_absen->aksi_terakhir = 'selesaiInput';
                        $data_absen->password = $messageText;
                        $data_absen->save();
                        Telegram::sendMessage(['chat_id' => $chatId, 'text' => "Hai " . $data_absen->nama . "(" . $data_absen->nip . ")\n\nMohon Tunggu Admin Kami Sedang Melakukan Penggecekan Akun !"]);
                        break;
                        
                    case 'selesaiInput':
                        Telegram::sendMessage(['chat_id' => $chatId, 'text' => "Hai " . $data_absen->nama . "(" . $data_absen->nip . ")\n\nMohon Tunggu Admin Kami Sedang Melakukan Penggecekan Akun !"]);
                        break;

                        // default:
                        //     # code...
                        //     break;
                }
                break;
        }
    }
}
