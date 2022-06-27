<?php

namespace App\Http\Controllers;

use App\Models\BookFee;
use App\Http\Requests\StoreBookFeeRequest;
use App\Http\Requests\UpdateBookFeeRequest;
use App\Models\BookList;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagihanController extends Controller
{
    public function index() {
        $siswa = Student::select('id')->get();
        if(request()->ajax()) {
            return datatables()->of(Student::select('*')->with(['kelas']))
            ->addColumn('action', 'buku.tagihan.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('buku.tagihan.index', compact('siswa'));
    }

    public function show(Request $request, $id) {
        $tagihan = BookFee::select('*')->with(['siswa'])->where('id_siswa', $id)->get();
        $siswa = Student::select('nisn')->where('id', $id)->first();
        $belumBayar = BookFee::where('id_siswa', $id)->where('status', 'Belum Dibayar')->sum('nominal');
        $sudahBayar = BookFee::where('id_siswa', $id)->where('status', 'Dibayar')->sum('nominal');
        return view('buku.tagihan.show', compact('tagihan', 'siswa', 'belumBayar','sudahBayar'));
    }

    public function create($nisn) {
        $siswa = Student::with(['kelas'])->where('nisn', $nisn)->first();
        $kelas = explode(' ', $siswa->kelas->nama_kelas);
        $buku = BookList::select('*')->where('kelas', $kelas[0])->get();
        $items = BookFee::select('*')->with(['buku'])->where('id_siswa', $siswa->id)->get();
        return view('buku.tagihan.create', compact('siswa', 'buku', 'items'));
    }

    public function store(Request $request) {
        $tagihan = BookFee::whereIn('id_buku', $request->id_buku)
            ->where('id_siswa', $request->id_siswa)
            ->pluck('id_buku')
            ->toArray();

            if (!$tagihan) {
                DB::transaction(function() use($request) {
                    foreach ($request->id_buku as $id) {
                        $harga = BookList::find($id, ['harga']);
                        BookFee::create([
                            'id_siswa' => $request->id_siswa,
                            'kelas' => $request->kelas,
                            'id_buku' => $id,
                            'nominal' => $harga->harga,
                        ]);
                    }
                });
                return redirect()->route('tagihan-buku.show', $request->id_siswa)
                    ->with('success', 'Tagihan berhasil ditambahkan  !');
            } else {
                return back()
                    ->with('error', 'Tagihan buku sudah ada !');
            }
    }

    public function update(Request $request, $id) {
        BookFee::find($id)->update([
            'tanggal_bayar' => Carbon::now(),
            'status' => 'Dibayar'
        ]);
        return redirect()->back()->with('success','Tagihan berhasil dibayar !');
    }

    public function destroy() {
        
    }

    public function riwayatIndex() {
        $tagihan = BookFee::select('*')->with(['siswa'])->where('status', 'Dibayar')->orderBy('tanggal_bayar', 'desc')->get();
        return view('buku.riwayat.index', compact('tagihan'));
    }
}
