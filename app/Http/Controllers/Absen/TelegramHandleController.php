<?php

namespace App\Http\Controllers\Absen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramHandleController extends Controller
{
    /**
     * 
     * daftar last aksi
     * 
     * Pendaftaran : 
     * - inputNama
     * - inputNip
     * - inputPassword
     * - selesaiInput
     * - cek Akun
     * 
     * 
     * 
     */
    public function handle(Request $request)
    {
        $data = $request->all();
        file_put_contents('telegram.json', json_encode($data));
        if (!isset($data['message']['text'])) {
            die;
        }
        $chatId = $data['message']['chat']['id'];
        $messageText = $data['message']['text'];
        $percakapan = new TelegramBalsanController;

        switch ($messageText) {
            case '/start':
                $percakapan->start($chatId, $messageText);
                break;

            case '/info':
                $percakapan->start($chatId, $messageText);
                break;

            default:
                $percakapan->custom($chatId, $messageText);
                break;
        }
    }

    public function setWebHook()
    {
        $response = Telegram::setWebhook(['url' => route('bot-handle')]);
        // $response = Telegram::setWebhook(['url' => 'https://a715-114-125-116-56.ngrok-free/absen']);
        return response()->json($response);
    }

    public function update()
    {
        $response = Telegram::getWebhookUpdate();
        return response()->json($response);
    }
    public function dell()
    {
        $response = Telegram::removeWebhook();
        return response()->json($response);
    }
    public function getUpdate()
    {
        $response = Telegram::getUpdates();
        return response()->json($response);
    }
}
