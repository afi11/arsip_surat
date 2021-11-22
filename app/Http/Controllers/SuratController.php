<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Surat;
use Response;
use Carbon\Carbon;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surats = Surat::join('kategoris', 'kategoris.id', '=', 'surats.id_kategori')
            ->select('surats.*', 'kategoris.nm_kategori')->get();
        return view('pages.index-arsip', compact('surats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('pages.tambah-arsip', compact('kategori'));
    }

    public function validation($request)
    {
        $validate_data = $this->validate(
            $request,
            [
                'id_kategori' => 'required',
                'no_surat' => 'required',
                'judul' => 'required',
                'no_surat' => 'required',
                'file_surat' => 'required',
            ],
            [
                'id_kategori.required' => 'Kategori surat harus diisi',
                'no_surat.required' => 'Nomor surat harus diisi',
                'judul.required' => 'Judul surat Kembali harus diisi',
                'no_surat.required' => 'Nomor Surat harus diisi',
                'file_surat.required' => 'File surat harus diisi',
            ]
        );
        return $validate_data;
    }

    public function validation2($request)
    {
        $validate_data = $this->validate(
            $request,
            [
                'id_kategori' => 'required',
                'no_surat' => 'required',
                'judul' => 'required',
                'no_surat' => 'required',
            ],
            [
                'id_kategori.required' => 'Kategori surat harus diisi',
                'no_surat.required' => 'Nomor surat harus diisi',
                'judul.required' => 'Judul surat Kembali harus diisi',
                'no_surat.required' => 'Nomor Surat harus diisi',
            ]
        );
        return $validate_data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $tipe = ".pdf";
        $fileSurat = str_replace("data:application/pdf;base64,","",$request->file_surat);
        $fileName = Carbon::now()->format('Ymd').\Illuminate\Support\Str::random(10).$tipe;
        $path = public_path().'/assets/filesurats/';
        file_put_contents($path.$fileName,base64_decode($fileSurat));

        $input = Surat::create([
            "id_kategori" => $request->id_kategori,
            "no_surat" => $request->no_surat,
            "judul" => $request->judul,
            "file_surat" => $fileName
        ]);

        return response()->json(["code" => 200, "message" => "Berhasil menambahkan arsip surat"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $surat = Surat::join('kategoris', 'kategoris.id', '=', 'surats.id_kategori')
            ->where('surats.id', $id)
            ->select('surats.*', 'kategoris.nm_kategori')->first();
        return view('pages.show-arsip', compact('surat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::all();
        $surat = Surat::join('kategoris', 'kategoris.id', '=', 'surats.id_kategori')
            ->where('surats.id', $id)
            ->select('surats.*', 'kategoris.nm_kategori')->first();
        return view('pages.ubah-arsip', compact('surat', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validation2($request);

        $surat = Surat::find($id);

        if($request->file_surat != ""){
            $tipe = ".pdf";
            $fileSurat = str_replace("data:application/pdf;base64,","",$request->file_surat);
            $fileName = Carbon::now()->format('Ymd').\Illuminate\Support\Str::random(10).$tipe;
            $path = public_path().'/assets/filesurats/';
            file_put_contents($path.$fileName,base64_decode($fileSurat));

            \File::delete(public_path('assets/filesurats/'.$surat->file_surat));
        }

        $surat->id_kategori = $request->id_kategori;
        $surat->no_surat = $request->no_surat;
        $surat->judul = $request->judul;
        if($request->file_surat != ""){
            $surat->file_surat = $fileName;
        }
        $surat->save();
        return response()->json(["code" => 200, "message" => "Berhasil memperbaruhi arsip surat"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $surat = Surat::find($id);
        \File::delete(public_path('assets/filesurats/'.$surat->file_surat));
        $surat->delete();
        return response()->json(["code" => 200, "message" => "Berhasil menghapus arsip surat"]);
    }
}
