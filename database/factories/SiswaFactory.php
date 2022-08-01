<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['Laki-laki', 'Perempuan']);
        return [
            'nis' => $this->faker->numerify('172021###'),
            'nama' => $this->faker->name,
            'tgl_lahir' => $this->faker->dateTimeBetween('2008-01-01', '2016-12-31')->format('Y-m-d'),
            'jenis_kelamin' => $gender,
            'kelas_id' => mt_rand(1, 6),
            'nama_wali' => $this->faker->name,
            'no_hp' => $this->faker->phoneNumber,
            'alamat' => $this->faker->address,
        ];
    }
}
