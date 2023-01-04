<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class Agama18Controller extends Controller
{
    public function index18()
    {
        $agama = Agama::get();
        return view('admin.agama', compact('agama'));
    }
    public function create18(Request $request)
    {
        Agama::create(['nama_agama' => $request->agama]);
        return Redirect::back()->with(['agamaadd' => 'Data agama berhasil ditambahkan!']);
    }
    public function edit18($id)
    {
        $agama = Agama::where('id', $id)->get();
        return view('admin.edit_agama', compact('agama'));
    }
    public function update18(Request $request)
    {
        Agama::where('id', $request->id)->update(['nama_agama' => $request->agama]);
        return redirect('/admin18/data-agama18')->with(['agama' => 'Data agama berhasil diupdate!']);
    }
    public function delete18($id)
    {
        Agama::where('id', $id)->delete();
        return Redirect::back()->with(['agamadel' => 'Data agama berhasil dihapus!']);
    }
}