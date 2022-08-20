<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Thn_ajaran;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow; 
use Illuminate\Support\Facades\Validator;

class SiswaImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.nis' => 'required|numeric|unique:siswa,nis',
            '*.nisn' => 'required|numeric|unique:siswa,nisn',
            '*.nama_siswa' => 'required',
            '*.jeniskelamin' => 'required',
            '*.no_telp' => 'nullable|numeric',
            '*.alamat' => 'required',
            '*.kode_kelas' => 'required',
            '*.kode_thn_ajaran' => 'required',
            '*.email' => 'required|unique:users,email',
            '*.username' => 'required|unique:users,username',
            '*.password' => 'required|unique:users,password',
        ])->validate();

        foreach ($rows as $row)
        {
            $user = User::create([
                'name' => $row['nama_siswa'],
                'username' => $row['username'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
                'remember_token' => \Str::random(50),
                'role_id'=>'5'
            ]);

            Siswa::create([
                'nis' => $row['nis'],
                'nisn' => $row['nisn'], 
                'nama_siswa' => $row['nama_siswa'],
                'jeniskelamin' => $row['jeniskelamin'],
                'alamat' => $row['alamat'],
                'no_telp' => $row['no_telp'],
                'users_id' => $user->id,
                'kode_kelas' => $row['kode_kelas'],
                'kode_thn_ajaran' => $row['kode_thn_ajaran']
            ]);
        }
    }
}
