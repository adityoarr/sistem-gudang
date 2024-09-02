<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        try {
            $barangs = Barang::all();
            return response()->json($barangs);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $barang = Barang::find($request->kode_barang);
            if (!empty($barang)) {
                return response()->json(['message' => 'kode barang sudah terdaftar'], 404);
            } else {
                $barang = new Barang();
                $barang->kode_barang = $request->kode_barang;
                $barang->nama_barang = $request->nama_barang;
                $barang->kategori_barang = $request->kategori_barang;
                $barang->lokasi_barang = $request->lokasi_barang;
                $barang->save();
                return response()->json(['message' => 'data berhasil ditambahkan'], 201);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function show($kode)
    {
        try {
            $barang = Barang::find($kode);
            if (!empty($barang)) {
                return response()->json($barang);
            } else {
                return response()->json(['message' => 'data tidak ditemukan'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $kode)
    {
        try {
            if (Barang::where('kode_barang', $kode)->exists()) {
                $barang = Barang::find($kode);
                $barang->nama_barang = is_null($request->nama_barang) ? $barang->nama_barang : $request->nama_barang;
                $barang->kategori_barang = is_null($request->kategori_barang) ? $barang->kategori_barang : $request->kategori_barang;
                $barang->lokasi_barang = is_null($request->lokasi_barang) ? $barang->lokasi_barang : $request->lokasi_barang;
                $barang->save();
                return response()->json(['message' => 'data berhasil diubah'], 200);
            } else {
                return response()->json(['message' => 'data tidak ditemukan'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($kode)
    {
        try {
            if (Barang::where('kode_barang', $kode)->exists()) {
                $barang = Barang::find($kode);
                $barang->delete();
                return response()->json(['message' => 'data berhasil dihapus'], 200);
            } else {
                return response()->json(['message' => 'data tidak ditemukan'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
