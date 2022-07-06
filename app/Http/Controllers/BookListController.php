<?php

namespace App\Http\Controllers;

use App\Models\BookList;
use App\Http\Requests\StoreBookListRequest;
use App\Http\Requests\UpdateBookListRequest;
use Illuminate\Http\Request;

class BookListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(BookList::select('*'))
            ->addColumn('action', 'buku.daftar.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('buku.daftar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.daftar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookListRequest $request)
    {
        BookList::create($request->all());
        return redirect()->route('buku.daftar.index')->with('success','Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookList  $bookList
     * @return \Illuminate\Http\Response
     */
    public function show(BookList $bookList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookList  $bookList
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = BookList::select('*')->where('id', $id)->first();
        return view('buku.daftar.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookListRequest  $request
     * @param  \App\Models\BookList  $bookList
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        BookList::find($id)->update(request()->all());
        return redirect(route('buku.daftar.index'))->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookList  $bookList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = BookList::where('id', $id)->delete();
        return response()->json($buku);
    }
}
