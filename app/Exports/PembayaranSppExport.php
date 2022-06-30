<?php

namespace App\Exports;

use App\Models\PembayaranSpp;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpParser\Node\Expr\FuncCall;

class PembayaranSppExport implements FromQuery, WithMapping, WithHeadings, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;

        return $this;
    }

    public function query()
    {
        return PembayaranSpp::query()
        ->with('siswa.kelas')
        ->whereDate('updated_at', '>=', $this->startDate)
        ->whereDate('updated_at', '<=', $this->endDate);
    }

    public function map($pembayaran): array
    {
        return [
            $pembayaran->siswa->nama,
            $pembayaran->siswa->kelas->nama_kelas,
            $pembayaran->tahun_ajaran,
            $pembayaran->bulan,
            $pembayaran->nominal,
            Carbon::parse($pembayaran->updated_at)->format('d-m-Y'),
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Kelas',
            'Tahun Ajaran',
            'Bulan',
            'Nominal',
            'Tanggal Pembayaran'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class  => function(AfterSheet $event) {
                $cellRange = 'A1:F1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
            },
        ];
    }

}
