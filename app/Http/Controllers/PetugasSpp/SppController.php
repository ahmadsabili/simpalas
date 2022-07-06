<?php

namespace App\Http\Controllers\PetugasSpp;

use App\Exports\PembayaranSppExport;
use App\Helpers\Bulan;
use App\Http\Controllers\Controller;
use App\Models\SppFee;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\PembayaranSpp;
use App\Models\Spp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class SppController extends Controller
{
    public function sppDashboard() {
        $student = Student::count();
        $class = Kelas::count();
        $sumToday = PembayaranSpp::whereDate('updated_at', Carbon::today())->sum('nominal');
        $sumMonth = PembayaranSpp::whereMonth('updated_at', Carbon::today())->sum('nominal');
        return view('spp.dashboard', compact('student', 'class', 'sumToday', 'sumMonth'));
    }

    public function index(Request $request)
    {
        if(request()->ajax()) {
            return datatables()->of(Student::select('*')->with(['kelas']))
            ->addColumn('action', 'spp.pembayaran.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('spp.pembayaran.index');
    }

    public function createBayar(Request $request,  $nisn) {
        $bulanAll = Bulan::bulanAll();
        $tahun_ajaran = Spp::select('tahun_ajaran')->groupBy('tahun_ajaran')->get();
        $siswa = Student::with(['kelas'])->where('nisn', $nisn)->first();
        return view('spp.pembayaran.create', compact('bulanAll', 'tahun_ajaran', 'siswa'));
    }

    public function getKelas(Request $request)
    {
        $kelas = Spp::select('*')->where('tahun_ajaran', $request->tahun_ajaran)->get();
        return response()->json($kelas);
    }

    public function getNominal(Request $request)
    {
        $nominal = Spp::select('nominal')->where('id', $request->kelasId)->get()->first();
        return response()->json($nominal);
    }

    public function storeBayar(Request $request) {
        $request->validate([
            'tahun_ajaran' => 'required',
            'nominal' => 'required',
        ]);
        $pembayaran = PembayaranSpp::whereIn('bulan', $request->bulan)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->where('id_siswa', $request->id_siswa)
            ->pluck('bulan')
            ->toArray();

            if (!$pembayaran) {
                DB::transaction(function() use($request) {
                    foreach ($request->bulan as $month) {
                        PembayaranSpp::create([
                            'id_siswa' => $request->id_siswa,
                            'tahun_ajaran' => $request->tahun_ajaran,
                            'bulan' => $month,
                            'nominal' => $request->nominal,
                        ]);
                    }
                });
                
                return redirect()->route('spp.status.show', $request->id_siswa)
                    ->with('success', 'Pembayaran berhasil disimpan!');
            }else{
                return back()
                    ->with('error', 'Tagihan SPP sudah dibayar!');
            }
    }

    public function statusIndex() {
        if(request()->ajax()) {
            return datatables()->of(Student::select('*')->with(['kelas']))
            ->addColumn('action', 'spp.status-pembayaran.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('spp.status-pembayaran.index');
    }

    public function statusShow(Request $request, $id) {
        $pembayaran = PembayaranSpp::select('*')->with(['siswa'])->where('id_siswa', $id)->orderBy('updated_at', 'asc')->get();
        $nisn = Student::select('nisn')->where('id', $id)->first();
        return view('spp.status-pembayaran.show', compact('pembayaran', 'nisn'));
    }

    public function statusDestroy($id) {
        $pembayaran = PembayaranSpp::find($id);
        $pembayaran->delete();
        return redirect()->back()
            ->with('success', 'Pembayaran berhasil dihapus!');
    }

    public function daftarSppIndex() {
        if(request()->ajax()) {
            return datatables()->of(Spp::select('*'))
            ->addColumn('action', 'spp.daftar.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('spp.daftar.index');
    }

    public function daftarSppCreate() {
        return view('spp.daftar.create');
    }

    public function daftarSppStore(Request $request) {
        Spp::create($request->all());
        return redirect()->route('spp.daftar.index')->with('success','SPP berhasil ditambahkan!');
    }

    public function daftarSppEdit($id) {
        $spp = Spp::find($id);
        return view('spp.daftar.edit', compact('spp'));
    }

    public function daftarSppUpdate(Request $request, $id) {
        $spp = Spp::find($id);
        $spp->update($request->all());
        return redirect()->route('spp.daftar.index')->with('success','SPP berhasil diubah!');
    }

    public function daftarSppDestroy(Request $request) {
        $spp = Spp::where('id',$request->id)->delete();
        return response()->json($spp);
    }

    public function riwayatIndex() {
        if(request()->ajax()) {
            return datatables()->of(PembayaranSpp::select('*')->with(['siswa.kelas']))
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at ? with(new Carbon($user->updated_at))->format('Y/m/d') : '';;
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
            })
            ->make(true);
        }
        return view('spp.riwayat.index');
    }

    public function belumBayar() {
        PembayaranSpp::select('*')->where('');
    }

    public function createExportExcel()
    {
        return view('spp.riwayat.export-excel');
    }

    public function exportExcel(Request $request) {
        return (new PembayaranSppExport($request->startDate, $request->endDate))->download('pembayaran-komite.xlsx');
    }
}
