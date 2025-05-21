<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis;
use App\Models\produk;
use App\Models\merk;
class FronController extends Controller
{
    public function index()
    {
        $jenis = Jenis::all();
        $produk = Produk::all();
        $merk = Merk::all();
        return view('welcome',compact('jenis','produk','merk'));
    }
   
    public function show()
    {
        $jenis = Jenis::all();
        $produk = Produk::all();
        $merk = Merk::all();
        return view('car', compact('jenis','produk','merk'));
        
    }

    public function about()
    {
        $jenis = Jenis::all();
        $produk = Produk::all();
        $merk = Merk::all();
        return view('about', compact('jenis','produk','merk'));
        
    }
    public function detail($id)
    {
        $data = Jenis::findOrFail($id);
        $data = Produk::findOrFail($id);
        $data = Merk::findOrFail($id);
        return view('detail', compact('data'));
        
    }
    

}

