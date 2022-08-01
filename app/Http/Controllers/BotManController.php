<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use App\Conversations\ExampleConversation;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Attachments\File;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public $user;

    public function handle()
    {

        // Load driver
        DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);

        $config = [
            // token bot telegram
            "telegram" => [
                "token" => "2087530021:AAF3eLQs46kK9MchZegnarFzKoYo8VxuMSo"
            ]
        ];
        $botman = BotManFactory::create($config, new LaravelCache());

        $botman->hears('/start|start|mulai', function (BotMan $bot) {
            $user = $bot->getUser();
            $message = "\n" . "\n" . "Selamat datang di Sistem Informasi Pembayaran MDT Sirojul Athfal." . "\n" .
                "Untuk masuk ke dalam sistem, anda harus login dan pastikan anda sudah mempunyai akun." . "\n" .
                "Atau jika anda belum paham silahkan klik atau tulis /help .";
            $bot->reply('Assalamualaikum ' . $user->getFirstName() . $message);

            $bot->startConversation(new ExampleConversation());
        })->stopsConversation();


        $botman->hears('/help|help', function (BotMan $bot) {
            $message = "Berikut adalah perintah-perintah yang tersedia untuk membantu anda :" . "\n" . "\n";
            $message .= "/start - Untuk memulai" . "\n" . "\n";
            $message .= "/login - Untuk masuk ke dalam sistem, dengan cara ketik usename< spasi >password. Secara default username dan password adalah Nomor Induk Siswa masing-masing, demi keamanan silakan untuk mengganti password dengan mengunjungi webiste mdt sirojul athfal. Contoh untuk login :" . "\n" . "172021001 siswa123" . "\n" . "\n";
            $message .= "/tentang - Infomasi mengenai sistem" . "\n" . "\n";
            $message .= "/help - Bantuan penggunaan";
            $bot->reply($message);
        })->stopsConversation();

        $botman->hears('/login|login', function (BotMan $bot) {
            $bot->startConversation(new ExampleConversation());
        })->stopsConversation();

        $botman->hears('/tentang|about|tentang', function (BotMan $bot) {
            $bot->reply('Sistem informasi MDT Sirojul Athfal yang terintegrasi dengan bot telegram bertujuan untuk memudahkan dan dalam hal penyampaian maupun menerima informasi yang lebih dinamis dan praktis.');
        })->stopsConversation();

        //fallback (balasan invalid command)
        $botman->fallback(function (BotMan $bot) {
            // $user = $bot->getUser();
            // $message = "Invalid command for" . $user->getBotMessages->getText() . "<br>";
            $message = "Kami tidak paham apa yang anda katakan. Coba tinjau kembali dengan mengetik- /help atau lihat pada menu daftar commad untuk dapat melanjutkan komunikasi dengan kami.";
            $bot->reply($message);
        });

        // $botman->hears('image', function (BotMan $bot) {
        //     // $url = 'https://*.ngrok.io/admin/dist/img/slogan.png';
        //     $attach = new Image('https://727c-140-213-140-148.ngrok.io/admin/dist/img/slogan.png', [
        //         'custom_payload' => true,
        //     ]);
        //     $message = OutgoingMessage::create('pdf')
        //         ->withAttachment($attach);
        //     $bot->reply($message);
        // });
        // $botman->hears('file', function (BotMan $bot) {
        //     $url = asset('admin/file.pdf');
        //     $attach = new File($url, [
        //         'custom_payload' => true,
        //     ]);
        //     $message = OutgoingMessage::create('pdf')
        //         ->withAttachment($attach);
        //     $bot->reply($message);
        // });

        $botman->listen();
    }
}
