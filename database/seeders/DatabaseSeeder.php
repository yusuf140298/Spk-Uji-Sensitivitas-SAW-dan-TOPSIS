<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		
		DB::table('roles')->insert([
			'role' => 'Administrator'
		]);
        DB::table('roles')->insert([
			'role' => 'Pegawai'
		]);
		DB::table('users')->insert([
			'nip' => '11218049',
			'name' => 'Wahyu',
			'role_id' => '1',
			'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
		]);
		DB::table('users')->insert([
			'nip' => '111199',
			'name' => 'Murti',
			'role_id' => '2',
			'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
		]);
        DB::table('receivers')->insert([
            'nik' => '3604124205690002',
            'nama' => 'SUPIAH',
            'alamat' => 'Kaserangan',
            'rt' => '001',
            'rw' => '001'
		]);
		DB::table('receivers')->insert([
			'nik' => '3604124809670001',
            'nama' => 'HURIYAH',
            'alamat' => 'Kaserangan',
            'rt' => '001',
            'rw' => '001'
		]);
		DB::table('receivers')->insert([
			'nik' => '3604120511840003',
            'nama' => 'BADRUDIN',
            'alamat' => 'Kaserangan',
            'rt' => '001',
            'rw' => '001'
		]);
		DB::table('receivers')->insert([
			'nik' => '3604124107570035',
            'nama' => 'BAHRIAH',
            'alamat' => 'Kaserangan',
            'rt' => '001',
            'rw' => '001'
		]);
		DB::table('receivers')->insert([
			'nik' => '3604125512720002',
            'nama' => 'SALMI',
            'alamat' => 'Kaserangan',
            'rt' => '001',
            'rw' => '001'
		]);
		DB::table('receivers')->insert([
			'nik' => '3604124107630014',
            'nama' => 'JULEHAH',
            'alamat' => 'Kaserangan',
            'rt' => '001',
            'rw' => '001'
		]);
		DB::table('receivers')->insert([
			'nik' => '3604124701810002',
            'nama' => 'AISYAH',
            'alamat' => 'Kaserangan',
            'rt' => '001',
            'rw' => '001'
		]);
		DB::table('receivers')->insert([
			'nik' => '3604124102640005',
            'nama' => 'NASWIYAH',
            'alamat' => 'Kaserangan',
            'rt' => '001',
            'rw' => '001'
		]);
		DB::table('receivers')->insert([
			'nik' => '3604120803690003',
            'nama' => 'JABIDI',
            'alamat' => 'Kaserangan',
            'rt' => '001',
            'rw' => '001'
		]);
		DB::table('receivers')->insert([
			'nik' => '3604122405490001',
            'nama' => 'YANTO',
            'alamat' => 'Kaserangan',
            'rt' => '001',
            'rw' => '001'
		]);

		DB::table('criterias')->insert([
            'kriteria' => 'Pekerjaan',
            'bobot' => '4',
            'jenis' => 'Benefit'
        ]);
		DB::table('criterias')->insert([
			'kriteria' => 'Penghasilan',
            'bobot' => '5',
            'jenis' => 'Cost'
		]);
		DB::table('criterias')->insert([
			'kriteria' => 'Jumlah Tanggungan',
            'bobot' => '4',
            'jenis' => 'Benefit'
		]);
		DB::table('criterias')->insert([
			'kriteria' => 'Kepemilikan Rumah',
            'bobot' => '3',
            'jenis' => 'Benefit'
		]);
		DB::table('criterias')->insert([
			'kriteria' => 'Memiliki Penyakit Kronis',
            'bobot' => '4',
            'jenis' => 'Benefit'
		]);

		DB::table('subcriterias')->insert([
            'criteria_id' => '1',
            'keterangan' => 'Wiraswasta/Pedagang',
            'bobotsub' => '1'
        ]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '1',
            'keterangan' => 'Karyawan Swasta',
            'bobotsub' => '2'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '1',
            'keterangan' => 'Petani Pemilik Lahan',
            'bobotsub' => '3'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '1',
            'keterangan' => 'Buruh',
            'bobotsub' => '4'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '1',
            'keterangan' => 'Tidak bekerja',
            'bobotsub' => '5'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '2',
            'keterangan' => 'Kurang dari 500.000',
            'bobotsub' => '1'
        ]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '2',
            'keterangan' => '500.000 s/d 1.500.000',
            'bobotsub' => '2'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '2',
            'keterangan' => '1.500.000 s/d 2.500.000',
            'bobotsub' => '3'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '2',
            'keterangan' => '2.500.000 s/d 3.500.000',
            'bobotsub' => '4'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '2',
            'keterangan' => 'Lebih dari 3.500.000',
            'bobotsub' => '5'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '3',
            'keterangan' => 'Tidak memiliki tanggungan',
            'bobotsub' => '1'
        ]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '3',
            'keterangan' => '1 Anak',
            'bobotsub' => '2'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '3',
            'keterangan' => '2 Anak',
            'bobotsub' => '3'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '3',
            'keterangan' => '3 s/d 4 Anak',
            'bobotsub' => '4'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '3',
            'keterangan' => '5 Anak atau lebih',
            'bobotsub' => '5'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '4',
            'keterangan' => 'Permanen',
            'bobotsub' => '2'
        ]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '4',
            'keterangan' => 'Semi Permanen',
            'bobotsub' => '3'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '4',
            'keterangan' => 'Menumpang',
            'bobotsub' => '4'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '5',
            'keterangan' => 'Tidak',
            'bobotsub' => '2'
		]);
		DB::table('subcriterias')->insert([
			'criteria_id' => '5',
            'keterangan' => 'Ya',
            'bobotsub' => '4'
		]);

		DB::table('scores')->insert([
            'receiver_id' => '1',
            'criteria_id' => '1',
            'nilai' => '5'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '1',
            'criteria_id' => '2',
            'nilai' => '1'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '1',
            'criteria_id' => '3',
            'nilai' => '3'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '1',
            'criteria_id' => '4',
            'nilai' => '3'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '1',
            'criteria_id' => '5',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([
			'receiver_id' => '2',
            'criteria_id' => '1',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '2',
            'criteria_id' => '2',
            'nilai' => '3'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '2',
            'criteria_id' => '3',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '2',
            'criteria_id' => '4',
            'nilai' => '3'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '2',
            'criteria_id' => '5',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([
			'receiver_id' => '3',
            'criteria_id' => '1',
            'nilai' => '3'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '3',
            'criteria_id' => '2',
            'nilai' => '4'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '3',
            'criteria_id' => '3',
            'nilai' => '5'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '3',
            'criteria_id' => '4',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '3',
            'criteria_id' => '5',
            'nilai' => '4'
        ]);
		DB::table('scores')->insert([
			'receiver_id' => '4',
            'criteria_id' => '1',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '4',
            'criteria_id' => '2',
            'nilai' => '3'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '4',
            'criteria_id' => '3',
            'nilai' => '3'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '4',
            'criteria_id' => '4',
            'nilai' => '3'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '4',
            'criteria_id' => '5',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([
			'receiver_id' => '5',
            'criteria_id' => '1',
            'nilai' => '1'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '5',
            'criteria_id' => '2',
            'nilai' => '3'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '5',
            'criteria_id' => '3',
            'nilai' => '3'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '5',
            'criteria_id' => '4',
            'nilai' => '3'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '5',
            'criteria_id' => '5',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([
			'receiver_id' => '6',
            'criteria_id' => '1',
            'nilai' => '1'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '6',
            'criteria_id' => '2',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '6',
            'criteria_id' => '3',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '6',
            'criteria_id' => '4',
            'nilai' => '3'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '6',
            'criteria_id' => '5',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([
			'receiver_id' => '7',
            'criteria_id' => '1',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '7',
            'criteria_id' => '2',
            'nilai' => '4'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '7',
            'criteria_id' => '3',
            'nilai' => '4'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '7',
            'criteria_id' => '4',
            'nilai' => '3'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '7',
            'criteria_id' => '5',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([
			'receiver_id' => '8',
            'criteria_id' => '1',
            'nilai' => '5'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '8',
            'criteria_id' => '2',
            'nilai' => '1'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '8',
            'criteria_id' => '3',
            'nilai' => '1'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '8',
            'criteria_id' => '4',
            'nilai' => '4'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '8',
            'criteria_id' => '5',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([
			'receiver_id' => '9',
            'criteria_id' => '1',
            'nilai' => '4'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '9',
            'criteria_id' => '2',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '9',
            'criteria_id' => '3',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '9',
            'criteria_id' => '4',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '9',
            'criteria_id' => '5',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([
			'receiver_id' => '10',
            'criteria_id' => '1',
            'nilai' => '4'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '10',
            'criteria_id' => '2',
            'nilai' => '2'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '10',
            'criteria_id' => '3',
            'nilai' => '1'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '10',
            'criteria_id' => '4',
            'nilai' => '3'
        ]);
		DB::table('scores')->insert([  
			'receiver_id' => '10',
            'criteria_id' => '5',
            'nilai' => '2'
        ]);
    }
}
