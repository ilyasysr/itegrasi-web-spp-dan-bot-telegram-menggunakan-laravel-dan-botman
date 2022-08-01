<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Siswa::factory(10)->create();
        User::create([
            'id' => '1',
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'role' => 'Admin',
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'id' => '2',
            'name' => 'TU MDT',
            'username' => 'tumdtsj',
            'password' => bcrypt('12345678'),
            'role' => 'TU',
            'remember_token' => Str::random(10),
        ]);

        Kelas::create([
            'id' => '1',
            'nama_kelas' => 'KELAS I'
        ]);
        Kelas::create([
            'id' => '2',
            'nama_kelas' => 'KELAS II'
        ]);
        Kelas::create([
            'id' => '3',
            'nama_kelas' => 'KELAS III'
        ]);
        Kelas::create([
            'id' => '4',
            'nama_kelas' => 'KELAS IV'
        ]);
        Kelas::create([
            'id' => '5',
            'nama_kelas' => 'KELAS V'
        ]);
        Kelas::create([
            'id' => '6',
            'nama_kelas' => 'KELAS VI'
        ]);
    }
}
