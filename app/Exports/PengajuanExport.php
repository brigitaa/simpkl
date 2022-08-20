<?php

namespace App\Exports;

use App\Models\Pengajuan;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Thn_ajaran;
use App\Models\Periode;
use App\Models\Dudi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
// use Maatwebsite\Excel\Concerns\FromView;
// use Illuminate\Contracts\View\View;

class PengajuanExport implements FromCollection, WithHeadings, WithColumnFormatting, WithColumnWidths, WithStyles, WithEvents
{
    protected $kelas;
    protected $tahunajaran;

    function __construct($kelas,$tahunajaran) {
            $this->kelas = $kelas;
            $this->tahunajaran = $tahunajaran;
    }

    public function collection()
    {
        return Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                        ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                        ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                        ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                        ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                        ->select('pengajuan.id','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                        ->where('nama_kelas', '=', $this->kelas)
                        ->where('nama_thn_ajaran', '=', $this->tahunajaran)
                        ->get();
    }

    // public function __construct($kelas,$tahunajaran)
    // {
    //     $this->kelas = $kelas;
    //     $this->tahunajaran = $tahunajaran;
    // }

    // public function query()
    // {
    //     return Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
    //                 ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
    //                 ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
    //                 ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas') 
    //                 ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
    //                 ->select('pengajuan.id','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
    //                 ->where('nama_kelas','like', '%'.$this->kelas.'%')
    //                 ->where('nama_thn_ajaran', 'like', '%'.$this->tahunajaran.'%');
    // }

    // coba lagi
    // protected $pengajuan;

    // function __construct ($pengajuan) {
    //     $this->pengajuan = $pengajuan;
    // }

    // public function collection() {
    //     return $this->pengajuan;
    // }

    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
    //                     ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
    //                     ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
    //                     ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
    //                     ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
    //                     ->select('pengajuan.id','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
    //                     ->get();
    // }



    // use Exportable;
    // protected $namakelas, $namathnajaran;

    // public function __construct($namakelas,$namathnajaran)
    // {
    //     $this->namakelas = $namakelas;
    //     $this->namathnajaran = $namathnajaran;
    // }

    // tes export query
    // public function query()
    // {
    //     $pengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
    //                             ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
    //                             ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
    //                             ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas') 
    //                             ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran');

    //     $pengajuan::query()->select([
    //                         'pengajuan.id',
    //                         'siswa.nis',
    //                         'siswa.nisn',
    //                         'siswa.nama_siswa',
    //                         'kelas.nama_kelas',
    //                         'thn_ajaran.nama_thn_ajaran',
    //                         'periode.tanggal_mulai',
    //                         'periode.tanggal_selesai',
    //                         'dudi.nama_dudi'             
    //     ]);
    //     // ->where('nama_kelas', 'like', '%' . $this->namakelas . '%')
    //     // ->orWhere('nama_thn_ajaran', 'like', '%' . $this->namathnajaran . '%');
    //     if ($this->namakelas != null) {
    //         $pengajuan->where('nama_kelas', $this->namakelas);
    //     }

    //     if ($this->namathnajaran != null) {
    //         $pengajuan->where('nama_thn_ajaran', $this->namathnajaran);
    //     }

    //     return $pengajuan;
    // }

    // tes export froom view
    // private $users;

    // public function __construct($pengajuan)
    // {
    //     $this->pengajuan = $pengajuan;
    // }

    // /**
    //  * @return View
    //  */
    // public function view(): View
    // {
    //     return view('pengajuanPKL.export', ['pengajuan' => $this->pengajuan]);
    // }


    public function headings(): array
    {
        return [
            'ID Pengajuan',
            'NIS',
            'NISN',
            'Nama Siswa',
            'Kelas',
            'Tahun Ajaran',
            'Tanggal Mulai PKL',
            'Tanggal Selesai PKL',
            'Nama DU/DI',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => "0",
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 15,          
            'C' => 20,  
            'D' => 30,  
            'E' => 10,  
            'F' => 15,  
            'G' => 18,  
            'H' => 18,  
            'I' => 30,  
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'center' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:I1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->setAutoFilter('A1:'.$event->sheet->getDelegate()->getHighestColumn().'1');
                            
            },
        ];
    }
}
