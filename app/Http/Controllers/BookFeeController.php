<?php

namespace App\Http\Controllers;

use App\Models\BookFee;
use App\Http\Requests\StoreBookFeeRequest;
use App\Http\Requests\UpdateBookFeeRequest;
use App\Models\BookList;
use App\Models\Student;
use Illuminate\Http\Request;

class BookFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Student::select('*')->with(['kelas']))
            ->addColumn('action', 'buku.pembayaran.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('buku.pembayaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookFeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookFeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookFee  $bookFee
     * @return \Illuminate\Http\Response
     */
    public function show(BookFee $bookFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookFee  $bookFee
     * @return \Illuminate\Http\Response
     */
    public function edit(BookFee $bookFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookFeeRequest  $request
     * @param  \App\Models\BookFee  $bookFee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookFeeRequest $request, BookFee $bookFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookFee  $bookFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookFee $bookFee)
    {
        //
    }

    public function tagihanIndex() {
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

    public function tagihanShow(Request $request, $id) {
        $tagihan = BookFee::select('*')->with(['siswa'])->where('id_siswa', $id)->get();
        
        return view('buku.tagihan.show', compact('tagihan'));
    }

    public function tagihanCreate(Request $request,  $nisn) {
        $buku = BookList::select('*')->groupBy('kelas')->get();
        $siswa = Student::with(['kelas'])->where('nisn', $nisn)->first();
        return view('spp.pembayaran.create', compact('buku', 'siswa'));
    }
}
