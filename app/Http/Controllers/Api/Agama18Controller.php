<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiFormat;
use App\Models\Agama;
use Illuminate\Http\Request;

class Agama18Controller extends Controller
{

    public function index18()
    {
        $data = Agama::get();
        return new ApiFormat(true, 'List Data', $data);
    }
    public function create18(Request $request)
    {
        $data = Agama::create(['nama_agama' => $request->agama]);
        return new ApiFormat(true, 'Data agama berhasil ditambahkan!', $data);
    }
    public function show18($id)
    {
        $data = Agama::where('id', $id)->get();
        return new ApiFormat(true, 'Show Data', $data);
    }
    public function update18(Request $request)
    {
        $data = Agama::where('id', $request->id)->update(['nama_agama' => $request->agama]);
        return new ApiFormat(true, 'Data agama berhasil diupdate!', $data);
    }
    public function delete18($id)
    {
        $data = Agama::where('id', $id)->delete();
        return new ApiFormat(true, 'Data agama berhasil dihapus!', $data);
    }
}