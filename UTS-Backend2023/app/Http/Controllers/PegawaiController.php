<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use PhpParser\Node\Expr\Cast\String_;

class PegawaiController extends Controller
{
    // Method atau function untuk menampilkan semua data pegawai
    public function index()
    {
         // menggunakan eloquent all() untuk mengambil semua data pegawai pada Model Pegawai
         $pegawai = Pegawai::all();

         //jika data kosong maka kirim status code 200
         if ($pegawai->isEmpty()) {
            $data = ["message" => "Data is empty"];

            return response()->json($data, 200);
         }
         //membuat data response 
         $data =[
            "message" => "Get all Resouce",
            "data" => $pegawai 
         ];
         //mengirim data (json) dan kode 200
         return response()->json($data, 200);
    }

    //method ini untuk menambahkan data karyawan baru
    public function store(Request $request)
    {
        // membuat validation request
        $request->validate([
            "name" => "required",
            "gender" => "required",
            "phone" => "required",
            "alamat" => "required",
            "email" => "required",
            "status" => "required",
            "hired_on" => "required",
        ]);

        //data yang akan ditambahkan 
        $input = [
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'status' => $request->status,
            'hired_on' => $request->hired_on,
        ];

         // menggunakan eloquent create() untuk menambah data pegawai baru
         $pegawai = Pegawai::create($input);

         //membuat data response
         $data = [
            "message" => "pegawai is created successfully",
            "data" => $pegawai,
         ];

         //mengirim data (json) dan code 201
         return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        //menggunakan eloquent find() untuk mencari data pegawai berdasakan id
        $pegawai = Pegawai::find($id);

        //jika data yang dicari tidak ada makan kirim kode 404
        if (!$pegawai) {
            $data = [
                "message" => "Resouce not found",
            ];

            //mengirim data (json) dan code 404
            return response()->json($data, 404);
        }

         // menggunakan eloquent update() untuk mengubah data pegawai dan menampilkan kembali menggunakan eloquent all()
         $pegawai->update([
            "name" => $request->name ?? $pegawai->nama,
            "gender" => $request->gender  ?? $pegawai->gender,
            "phone" => $request->phone ?? $pegawai->phone,
            "alamat" => $request->alamat ?? $pegawai->alamat,
            "email" => $request->email ?? $pegawai->email,
            "status" => $request->status ?? $pegawai->status,
            "hired_on" => $request->hired_on ?? $pegawai->hired_on,
        ]);
        //membuat data response
        $data = [
            "message" => "pegawai is updated successfully",
            "data" => $pegawai,
        ];

        //mengirim data json dan code 200
        return response()->json($data, 200);
    }

    //method atau funcition untuk menghapus data pegawai
    public function destroy($id)
    {
        //menggunakan eloquent find() untuk mencari data pegawai berdasarkan id
        $pegawai = Pegawai::find($id);
        // jika data pegawai tidak ditemukan 
        if (!$pegawai){
            //membuat response data
            $data = [
                "message" => "Resource not found",
            ];
            //mengirim data (json) dan mengirim kode 404
            return response()->json($data, 404);
        }

        //jika data pegawai dtemukan maka hapus dari data pegawai
        $pegawai->delete();

        //buat data response
        $data = [
            "message" => "pegawai is delete successfully",
            "datadeleted" => $pegawai,
        ];

        //mengirim data (json) dan kode 200
        return response()->json($data, 200);
    }

    //funvtion ini untuk memnampilkan data pegawai berdasarkan id
    public function show($id)
    {
        $pegawai = Pegawai::find($id);

        //jika data tidak ada makan kirim kode 404
        if (!$pegawai) {
            $data = [
                "message" => "data pegawai not found",
            ];

            return response()->json($data, 404);
        }

        // membuat data response
        $data = [
            "message" => "get Detail pegawai",
            "data" => $pegawai
        ];

        //mengirim data (json) lalu kirim kode 200
        return response()->json($data, 200);
    }

    public function search(String $name)
    {
        $pegawai = Pegawai::where('name', 'like', "%{$name}%")->get();

        //jika data pegawai tidak ada maka kirim kode 404
        if(!$pegawai) {
            $data =[
                "message" => "data pegawai not found",
                "data" => $pegawai
            ];

            //mengirim data  (json) lalu kirim kode 404
            return response()->json($data, 404);
        } else {
            $data =[
                "message" => "get data pegawai dengan nama",
                "data" => $pegawai
            ];

            return response()->json($data, 200);
        }
    }

    public function active()
    {
        $pegawai = Pegawai::where('status', 'active')->get();

        //jika data pegawai aktif tidak ada makan kirim kode 404
        if (!$pegawai) {
            $data = [
                "message" => "data pegawao not found",
                "data" => []
            ];

            //mengirim data (json) lalu kirim kode 404
            return response()->json($data, 404);
        } else {
            $data = [
                "message" => "Get data pegawai by status active",
                "data" => $pegawai
            ];

            //jika data ditemukan maka kirim kode 200
            return response()->json($data, 200);
        }
    }

    public function Inactive()
    {
        $pegawai = Pegawai::where('status', 'inactive')->get();

        //jika data pegawai yang inactive tidak ditemukan maka kirim kode 404
        if (!$pegawai) {
            $data = [
                "message" => "Data pegawai yang inactive tidak ditemukan",
                "data" => []
            ];
            
            //jika tidak ditemukan maka kirim kode 404
            return response()->json($data, 404);
        } else {
            $data = [
                "message" => "Get data pegawai yang berstatus inactive",
                "data"=> $pegawai
            ];

            //jika data karyawan ditemukan maka kirim kode 200
            return response()->json($data, 200);
        }
    }

    public function terminated()
    {
        $pegawai = Pegawai::where('status', 'terminated')->get();

        //jika data pegawai yang dikeluarkan tidak ada maka kirim kode 404
        if (!$pegawai) {
            $data = [
                "message" => "data pegawai tidak ditemukan",
                "data" => []
            ];
        } else {
            $data = [
                "message" => "get data pegawai dengan status terminated",
                "data" => $pegawai
            ];

            //jika ditemukan maka kirim kode 200
            return response()->json($data, 200);
        }
    }
}
