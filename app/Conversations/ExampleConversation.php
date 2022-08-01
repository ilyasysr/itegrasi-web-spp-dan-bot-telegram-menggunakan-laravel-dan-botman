<?php

namespace App\Conversations;

use App\Http\Controllers\BotManController;
use App\Models\Pembayaran;
use App\Models\Siswa;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use Illuminate\Support\Facades\Auth;

class ExampleConversation extends Conversation
{

    /**
     * First question
     */

    public function logIn()
    {
        $question = Question::create("Silakan klik login")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Login')->value('masuk'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->geteIn();
            }
        });
    }

    public function geteIn()
    {
        $this->ask('Silahkan masukan username<spasi>password : ', function (Answer $answer) {

            $userpass = $answer->getText();
            $x = explode(" ", $userpass);
            $username = $x[0];
            $password = $x[1];

            if (Auth::attempt([
                'username' => $username,
                'password' => $password
            ])) {
                // request()->session()->regenerate();
                $nis = auth()->user()->username;
                $this->say("Berhasil Login, Selamat datang " . auth()->user()->name);
                $this->getData($nis);
            } else {
                $this->say("Gagal login !" . PHP_EOL . "Periksa kembali format login dan pastikan username dan password anda benar !");
                $this->logIn();
            }
        });
    }


    public function getData($nis)
    {
        $question = Question::create("Silahkan pilih jenis informasi :")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('SPP')->value('SPP'),
                Button::create('Tagihan Lainnya')->value('Tagihan Lainnya'),
                Button::create('Riwayat Bayar')->value('Riwayat Bayar'),
                Button::create('Keluar')->value('Keluar'),
            ]);

        return $this->ask($question, function (Answer $answer) use ($nis) {
            if ($answer->isInteractiveMessageReply()) {

                $siswa = Siswa::where('nis', '=', $nis)->first();
                switch ($answer->getValue()) {
                    case 'SPP':
                        $this->say('Anda memlilih ' . $answer->getValue());
                        $this->spp($siswa);
                        break;
                    case 'Tagihan Lainnya':
                        $this->say('Anda memlilih ' . $answer->getValue());
                        $this->lainnya($siswa);
                        break;
                    case 'Riwayat Bayar':
                        $this->say('Anda memlilih ' . $answer->getValue());
                        $this->riwayat($siswa);
                        break;
                    case 'Keluar':
                        $this->say('Anda memilih keluar.' . PHP_EOL . 'Terima kasih dan sampai jumpa 🧐️. Wassalamualaikum ');
                        break;
                    default:
                        break;
                }
            }
        });
    }

    public function spp($siswa)
    {
        $pembayaran = $siswa->pembayaran()->selectRaw('siswa_id,spp_id')->distinct()
            ->whereHas('spp', function ($query) {
                $query->where('tipe', '=', 'BULANAN');
            })->orderBy('created_at', 'DESC')->get();

        if ($pembayaran->count() > 0) {

            $btn = [];
            foreach ($pembayaran as $data) {
                $btn[] = Button::create($data->spp->nama_jenis_bayar . ' | T.A ' . $data->spp->thn_ajaran)
                    ->value($data->spp->id);
            }

            $question = Question::create("Berikut adalah daftar tagihan anda. Klik untuk melihat detail :")
                ->fallback('Unable to ask question')
                ->callbackId('ask_reason')
                ->addButtons($btn);

            return $this->ask($question, function (Answer $answer) use ($siswa) {
                if ($answer->isInteractiveMessageReply()) {

                    $data = Pembayaran::where('spp_id', $answer->getValue())->where('siswa_id', $siswa->id)->first();

                    $databayar = Pembayaran::where('spp_id', $answer->getValue())->where('siswa_id', $siswa->id)
                        ->where('keterangan', 'Belum Bayar')->get();
                    $detail = "";
                    foreach ($databayar as $data) {
                        $detail .= sprintf("Bulan: " . $data->bulan . "\n");
                        $detail .= sprintf("Biaya: Rp " . number_format($data->biaya, 0, ",", ".") . "\n");
                        $detail .= sprintf("Batas Akhir Bayar: " . $data->jatuh_tempo . "\n");
                        $detail .= sprintf("Keterangan: " . $data->keterangan . "\n");
                        $detail .= sprintf("=============================");
                        $detail .= sprintf("\n");
                    }

                    $this->say("Detailnya sebagai berikut: " . PHP_EOL . PHP_EOL .
                        "Jenis : " . $data->spp->nama_jenis_bayar . PHP_EOL .
                        "Tahun Ajaran : " . $data->spp->thn_ajaran . PHP_EOL .
                        "Nama : " . $data->siswa->nama . PHP_EOL .
                        "Kelas : " . $data->siswa->kelas->nama_kelas . PHP_EOL . PHP_EOL .
                        $detail);

                    $this->opsi($siswa->nis);
                }
            });
        } else {
            $this->say("Saat ini anda tidak mempunyai tagihan SPP. Terima kasih atas perhatiannya.");
            $this->getData($siswa->nis);
        }
    }

    public function lainnya($siswa)
    {

        $pembayaranbebas = $siswa->pembayaran()->whereHas('spp', function ($q) {
            $q->where('tipe', '=', 'BEBAS');
        })->where('keterangan', '=', 'Belum Bayar')->get();

        if ($pembayaranbebas->count() > 0) {
            $jawaban = "";
            $i = 1;
            foreach ($pembayaranbebas as $data) {
                $jawaban .= sprintf("Tagihan # " . $i++ . "\n");
                $jawaban .= sprintf("Nama Pembayaran: " . $data->spp->nama_jenis_bayar . "\n");
                $jawaban .= sprintf("Tahun Ajaran: " . $data->spp->thn_ajaran . "\n");
                $jawaban .= sprintf("Jumlah Biaya: Rp " . number_format($data->biaya, 0, ",", ".") . "\n");
                $jawaban .= sprintf("Keterangan: " . $data->keterangan . "\n");
                $jawaban .= sprintf("=============================");
                $jawaban .= sprintf("\n");
            }
            $this->say($jawaban);
            // $this->bot->reply($jawaban);
            $this->opsi($siswa->nis);
        } else {
            $this->say("Saat ini anda tidak mempunyai tagihan jenis lainnya. Terima kasih atas perhatiannya.");
            $this->getData($siswa->nis);
        }
    }
    public function riwayat($siswa)
    {

        $htransaksi = $siswa->pembayaran()->with(['siswa', 'spp'])
            ->where('keterangan', 'LUNAS')->orderBy('tgl_bayar', 'ASC')->get();

        if ($htransaksi->count() > 0) {
            $jawaban = "";
            $i = 1;
            foreach ($htransaksi as $data) {

                $jawaban .= sprintf("Pembayaran ke # " . $i++ . "\n");
                $jawaban .= sprintf("Nama Pembayaran: " . $data->spp->nama_jenis_bayar . "\n");
                $jawaban .= sprintf("Tahun Ajaran: " . $data->spp->thn_ajaran . "\n");
                $jawaban .= sprintf("Jumlah Biaya: Rp " . number_format($data->biaya, 0, ",", ".") . "\n");
                $jawaban .= sprintf("Tanggal bayar: " . $data->tgl_bayar . "\n");
                $jawaban .= sprintf("Keterangan:" . $data->keterangan . "\n");
                $jawaban .= sprintf("=============================");
                $jawaban .= sprintf("\n");
            }
            $this->say($jawaban);
            $this->opsi($siswa->nis);
        } else {
            $this->say("Saat ini anda tidak mempunyai riwayat pembayaran apapun.");
            $this->getData($siswa->nis);
        }
    }

    public function opsi($nis)
    {
        $question = Question::create("Ingin melanjutkan ?")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Ya')->value('Ya'),
                Button::create('Tidak')->value('Tidak')
            ]);

        return $this->ask($question, function (Answer $answer) use ($nis) {
            if ($answer->isInteractiveMessageReply()) {

                switch ($answer->getValue()) {
                    case 'Ya':
                        $this->say($answer->getValue());
                        $this->getData($nis);
                        break;
                    case 'Tidak':
                        $this->say('Anda memilih tidak melanjutkan.' . PHP_EOL . 'Terima kasih dan sampai jumpa 🧐️. Wassalamualaikum ');
                        break;
                    default:
                        break;
                }
            }
        });
    }

    // /**
    //  * Start the conversation
    //  */

    public function run()
    {
        $this->logIn();
    }
}
