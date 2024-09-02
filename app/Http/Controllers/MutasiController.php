<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mutasi;

class MutasiController extends Controller
{
    public function index()
    {
        try {
            $mutasi = Mutasi::all();
            return response()->json($mutasi);
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
            $mutasi = new Mutasi();
            $mutasi->tanggal = $request->tanggal;
            $mutasi->jenis_mutasi = $request->jenis_mutasi;
            $mutasi->jumlah = $request->jumlah;
            $mutasi->idUser = $request->idUser;
            $mutasi->kodeBarang = $request->kodeBarang;
            $mutasi->save();
            return response()->json(['message' => 'data berhasil ditambahkan'], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $mutasi = Mutasi::find($id);
            if (!empty($mutasi)) {
                return response()->json($mutasi);
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

    public function update(Request $request, $id)
    {
        try {
            if (Mutasi::where('id', $id)->exists()) {
                $mutasi = Mutasi::find($id);
                $mutasi->tanggal = is_null($request->tanggal) ? $mutasi->tanggal : $request->tanggal;
                $mutasi->jenis_mutasi = is_null($request->jenis_mutasi) ? $mutasi->jenis_mutasi : $request->jenis_mutasi;
                $mutasi->jumlah = is_null($request->jumlah) ? $mutasi->jumlah : $request->jumlah;
                $mutasi->idUser = is_null($request->idUser) ? $mutasi->idUser : $request->idUser;
                $mutasi->kodeBarang = is_null($request->kodeBarang) ? $mutasi->kodeBarang : $request->kodeBarang;
                $mutasi->save();
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

    public function destroy($id)
    {
        try {
            if (Mutasi::where('id', $id)->exists()) {
                $mutasi = Mutasi::find($id);
                $mutasi->delete();
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

    public function history_mutasi_user($idUser)
    {
        try {
            if (Mutasi::where('idUser', $idUser)->exists()) {
                return response()->json(Mutasi::where('idUser', $idUser)->get());
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

    public function history_mutasi_barang($kodeBarang)
    {
        try {
            if (Mutasi::where('kodeBarang', $kodeBarang)->exists()) {
                return response()->json(Mutasi::where('kodeBarang', $kodeBarang)->get());
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
