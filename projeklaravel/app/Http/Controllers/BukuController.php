<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    //
    public function showAll(){
        return APIUtil::sendResponse(Buku::all(), 'success');
    }

    public function show($judul){
        $buku = Buku::where('judul', $judul)->first();
        if($buku){
            return APIUtil::sendResponse($buku, 'success');
        }
        return APIUtil::sendError('Find failed', 'Buku not found');
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'judul'=>'required',
            'pengarang'=>'required',
            'penerbit'=>'required',
            'tahun_terbit'=>'required'
        ]);

        if($validate->fails()){
            return APIUtil::sendError('Store failed', $validate->errors());
        }

        $newBook = Buku::where('judul', $request->judul)->first();
        if($newBook){
            return APIUtil::sendError('Store failed', 'Buku sudah ada');
        }
        $newBook = Buku::create($request->all());
        return APIUtil::sendResponse($newBook, 'Success');
    }

    public function update(Request $request, $judul){
        $buku = Buku::where('judul', $judul)->first();
        if($buku){
            $validate = Validator::make($request->all(), [
                'judul'=>'required',
                'pengarang'=>'required',
                'penerbit'=>'required',
                'tahun_terbit'=>'required'
            ]);

            if($validate->fails()){
                return APIUtil::sendError('Update failed', $validate->errors());
            }

            $buku->judul = $request->judul;
            $buku->pengarang = $request->pengarang;
            $buku->penerbit = $request->penerbit;
            $buku->tahun_terbit = $request->tahun_terbit;
            $buku->save();
            return APIUtil::sendResponse($buku, 'Update success');
        }
        return APIUtil::sendError('Update failed', 'Buku tidak ditemukan');
    }

    public function destroy($judul){
        $buku = Buku::where('judul', $judul)->first();
        if($buku){
            $buku->delete();
            return APIUtil::sendResponse('Success', 'Deleted');
        }
        return APIUtil::sendError('Failed', 'Buku tidak ditemukan');
    }
}
