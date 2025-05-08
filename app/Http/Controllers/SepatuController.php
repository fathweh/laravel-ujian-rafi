<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Sepatu;

class SepatuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sepatu = Sepatu::all();
        return view('sepatu.index', compact('sepatu'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sepatu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function store(Request $request)
    {
        $sepatu = new Sepatu();
        $sepatu->nama_sepatu = $request->nama_sepatu;
       

        if ($request->hasFile('foto')) {
            $img = $request->file('foto');
            $name = rand(1000,9999) . $img->getClientOriginalName();
            $img->move('storage/sepatu', $name);
            $sepatu->foto = $name;
        }
        
        $sepatu->save();
        return redirect()->route('sepatu.index')->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sepatu = Sepatu::findOrFail($id);
        return view('sepatu.show', compact('sepatu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sepatu = Sepatu::findOrFail($id);
        return view('sepatu.edit', compact('sepatu'));
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
        $sepatu = Sepatu::findOrFail($id);
        $sepatu->nama_sepatu = $request->nama_sepatu;
        

        // update gambar atau foto
        if ($request->hasFile('foto')) {
            $sepatu->deleteimage();
            $img = $request->file('foto');
            $name = rand(1000,9999) . $img->getClientOriginalName();
            $img->move('storage/sepatu', $name);
            $sepatu->foto = $name;
        }

        $sepatu->save();
        return redirect()->route('sepatu.index')->with('success', 'data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sepatu = Sepatu::findOrFail($id);
        // Hapus Gambar yang Lama jika ada
       

        $sepatu->delete();
        return redirect()->route('sepatu.index')->with('success', 'data berhasil dihapus');
    }
}
