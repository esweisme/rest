<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orang;

class apiOrangController extends Controller
{
    public function all()
    {
        return response()->json(Orang::all(), 200);
    }

    public function add(Request $request)
    {
        // Validate the request...
        $orang = new Orang;
        $orang->nama = $request->nama;
        $orang->alamat = $request->alamat;
        $orang->save();
        return response([
            'status' => 'mantap',
            'message' => 'datang orang berhasil disimpan',
            'data' => $orang        
        ], 200);
    }


    public function update(Request $request, $id){
        //cek terlebih dahulu data yang akan di-update melalui id
        //apakah barang ada atau tidak, jika tidak return not found
        $check_orang = Orang::firstWhere('id', $id);
        if($check_orang){
            // echo 'data yang anda cari tersedia';
            // $requestData = json_decode($request->getContent(), true);
            $data_orang = Orang::find($id);
            $data_orang->nama = $request->input('nama');
            $data_orang->alamat = $request->input('alamat');
            $data_orang->save();
            return response([
                'status' => true,
                'message' => 'Data Berhasil Dirubah',
                // 'update-data' => $data_barang
            ], 200);
        } else {
            // echo 'tidak ada';
            return response([
                'status' => false,
                'message' => 'Kode Barang Tidak ditemukan'
            ], 404);
        }
    }

    public function delete($id){
        //cek terlebih dahulu data yang akan di-update melalui id
        //apakah barang ada atau tidak, jika tidak return not found
        $check_orang = Orang::firstWhere('id', $id);
        if($check_orang){
            // echo 'data yang anda cari tersedia';
            // $requestData = json_decode($request->getContent(), true);
            Orang::destroy($id);
            return response([
                'status' => true,
                'message' => 'Data Berhasil dihapus',
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Kode Barang Tidak ditemukan'
            ], 404);
        }
    }
}
