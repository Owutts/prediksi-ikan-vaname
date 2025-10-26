<?php

namespace App\Http\Controllers;
use App\Models\dataset;
use Illuminate\Http\Request;

class datasetController extends Controller
{
    //
    public function index()
    {
        $dataset = dataset::all();
        return view('dataset', compact('dataset'));
    }
    public function tambah(Request $request)
    {
        $dataset = new dataset;
        $dataset->TAHUN = $request->TAHUN;
        $dataset->MUSIM_PANEN = $request->MUSIM_PANEN;
        $dataset->LUAS = $request->LUAS;
        $dataset->QTY_TANAM = $request->QTY_TANAM;
        $dataset->LAMA = $request->LAMA;
        $dataset->PAKAN = $request->PAKAN;
        $dataset->HASIL_PANEN = $request->HASIL_PANEN;
        $dataset->save();
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }
    public function edit(Request $request, String $id)
    {
     
        $dataset = dataset::find($id);
        $dataset->TAHUN = $request->TAHUN;
        $dataset->MUSIM_PANEN = $request->MUSIM_PANEN;
        $dataset->LUAS = $request->LUAS;
        $dataset->QTY_TANAM = $request->QTY_TANAM;
        $dataset->LAMA = $request->LAMA;
        $dataset->PAKAN = $request->PAKAN;
        $dataset->HASIL_PANEN = $request->HASIL_PANEN;
        $dataset->save();
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }
    public function hapus(String $id)
    {
        $dataset = dataset::find($id);
        $dataset->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
