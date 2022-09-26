<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Thn_ajaran;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow; 
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    /**
    * @param Collection $collection
    */
    // public function collection(Collection $rows)
    // {
    //     Validator::make($rows->toArray(), [
    //         '*.nis' => 'required|numeric|unique:siswa,nis',
    //         '*.nisn' => 'required|numeric|unique:siswa,nisn',
    //         '*.nama_siswa' => 'required',
    //         '*.jeniskelamin' => 'required',
    //         '*.no_telp' => 'nullable|numeric',
    //         '*.alamat' => 'required',
    //         '*.kode_kelas' => 'required',
    //         '*.kode_thn_ajaran' => 'required',
    //         '*.email' => 'required|unique:users,email',
    //         '*.username' => 'required|unique:users,username',
    //         '*.password' => 'required|unique:users,password',
    //     ])->validate();

    //     foreach ($rows as $row)
    //     {
    //         $user = User::create([
    //             'name' => $row['nama_siswa'],
    //             'username' => $row['username'],
    //             'email' => $row['email'],
    //             'password' => Hash::make($row['password']),
    //             'remember_token' => \Str::random(50),
    //             'role_id'=>'5'
    //         ]);

    //         Siswa::create([
    //             'nis' => $row['nis'],
    //             'nisn' => $row['nisn'], 
    //             'nama_siswa' => $row['nama_siswa'],
    //             'jeniskelamin' => $row['jeniskelamin'],
    //             'alamat' => $row['alamat'],
    //             'no_telp' => $row['no_telp'],
    //             'users_id' => $user->id,
    //             'kode_kelas' => $row['kode_kelas'],
    //             'kode_thn_ajaran' => $row['kode_thn_ajaran']
    //         ]);
    //     }
    // }

    public function rules(): array
    {
        return [
            'nis' => 'required|numeric|unique:siswa,nis',
            'nisn' => 'required|numeric|unique:siswa,nisn',
            'nama_siswa' => 'required',
            'jeniskelamin' => 'required',
            'no_telp' => 'nullable|numeric',
            'alamat' => 'required',
            'kode_kelas' => 'required',
            'kode_thn_ajaran' => 'required',
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required'
        ];

    }

    public function customValidationMessages()
    {
        return [
            'nis.required' => 'NIS harus diisi.',
            'nis.numeric' => 'NIS harus berupa angka.',
            'nis.unique' => 'NIS sudah digunakan.',
            'nisn.required' => 'NISN harus diisi.',
            'nisn.numeric' => 'NISN harus berupa angka.',
            'nisn.unique' => 'NISN sudah digunakan.',
            'nama_siswa.required' => 'Nama siswa harus diisi.',
            'jeniskelamin.required' => 'Jenis kelamin harus diisi.',
            'no_telp.numeric' => 'Nomor telepon harus berupa angka.',
            'alamat.required' => 'Alamat harus diisi.',
            'kode_kelas.required' => 'Kode kelas harus diisi.',
            'kode_thn_ajaran.required' => 'Kode tahun ajaran harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password harus diisi.',

        ];
    }

    public function model(array $row)
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
