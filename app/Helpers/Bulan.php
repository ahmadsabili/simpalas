<?php 
namespace App\Helpers;

use App\Models\PembayaranSpp;
use Illuminate\Support\Facades\Auth;

class Bulan
{	
	public static function bulanAll()
	{
		return collect([
			[
				'nama_bulan' => 'Juli',
				'kode_bulan' => '07',
			],
			[
				'nama_bulan' => 'Agustus',
				'kode_bulan' => '08',
			],
			[
				'nama_bulan' => 'September',
				'kode_bulan' => '09',
			],
			[
				'nama_bulan' => 'Oktober',
				'kode_bulan' => '10',
			],
			[
				'nama_bulan' => 'November',
				'kode_bulan' => '11',
			],
			[
				'nama_bulan' => 'Desember',
				'kode_bulan' => '12',
			],
			[
				'nama_bulan' => 'Januari',
				'kode_bulan' => '01',
			],
			[
				'nama_bulan' => 'Februari',
				'kode_bulan' => '02',
			],
			[
				'nama_bulan' => 'Maret',
				'kode_bulan' => '03',
			],
			[
				'nama_bulan' => 'April',
				'kode_bulan' => '04',
			],
			[
				'nama_bulan' => 'Mei',
				'kode_bulan' => '05',
			],
            [
				'nama_bulan' => 'Juni',
				'kode_bulan' => '06',
			],
		]);
	}

	public static function statusPembayaran($id_siswa, $tahun_ajaran, $bulan) {
		$pembayaran = PembayaranSpp::where('id_siswa', $id_siswa)
	        ->pluck('bulan')->toArray();

	    foreach ($pembayaran as $key => $bayar) {
	    	if ($bayar == $bulan) {
	    		return "DIBAYAR";
	    	}
	    }

	    // jika pembayaran dibulan tertentu bulan belum dibayar
	    return "BELUM DIBAYAR";
	}
}