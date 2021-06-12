<?php

namespace App\Http\Controllers;

use App\Models\Pengguna_bidang;
use Illuminate\Http\Request;

class PenggunaBidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PenggunaBidang = \App\Models\Pengguna_bidang::all();
        return view('PenggunaBidang', ['pengguna_bidang' => $PenggunaBidang]);

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $PenggunaBidang = new Pengguna_bidang();
        $PenggunaBidang->Kode_Bidang = $request->Kode_Bidang;
        $PenggunaBidang->Nama_Bidang = $request->Nama_Bidang;
        $PenggunaBidang->Kode_Aset = $request->Kode_Aset;
        $PenggunaBidang->Nama_Barang = $request->Nama_Barang ;
        $PenggunaBidang->Kategori = $request->Kategori;
        $PenggunaBidang->Kondisi = $request->Kondisi;
        $file=$request->file('Image');
        $file->move("storage/",$file->getClientOriginalName());
        $PenggunaBidang->Image=$file->getClientOriginalName();
        
      
        $PenggunaBidang->save(); 
        return redirect('/penggunabidang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function proses_edit(Request $request) {
        
        $PenggunaBidang = Pengguna_bidang::where('Kode_Bidang', $request->input('Kode_Bidang'))->first();
        $PenggunaBidang->Kode_Bidang = $request->Kode_Bidang;
        $PenggunaBidang->Nama_Bidang = $request->Nama_Bidang;
        $PenggunaBidang->Kode_Aset = $request->Kode_Aset;
        $PenggunaBidang->Nama_Barang = $request->Nama_Barang ;
        $PenggunaBidang->Kategori = $request->Kategori;
        $PenggunaBidang->Kondisi = $request->Kondisi;
        if($request->file('Image') != null){
          // dd('masuk');
          $file=$request->file('Image');
          $file->move("storage/",$file->getClientOriginalName());
          $PenggunaBidang->Image=$file->getClientOriginalName();
      }
      
        $PenggunaBidang->update();
        
        return redirect('penggunabidang');
      }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_single_data($id) {
        $output = 'Kode Bidang';
        $article = Pengguna_bidang::where('Kode_Bidang', $id)->first();
        
        return view('editpenggunabidang', array(
          'content' => $output,
          'article' => $article
        ));
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_single_data($id)
    {
       Pengguna_bidang::where('Kode_Bidang',$id)->delete();

       return redirect('penggunabidang');
    }
}
