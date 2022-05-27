<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class KomentarController extends Controller
{
    public function index(){
        return Komentar::select('id','name','email','comment', 'created_at')->get();
    }

    public function store(Request $request){
        $request->validate([
            'name',
            'email',
            'comment'=>'required'
        ]);

        try{
            Komentar::create($request->post());
            return response()->json([
                'message'=>'Your comment has been posted!'
            ], 201);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'message'=>'Your comment has not been posted!'
            ],500);
        }
    }

    public function show(Komentar $komentar){
        return response()->json([
            'komentar'=>$komentar
        ]);
    }

    //function to destroy data
    public function destroy(Komentar $komentar){
        try{
            $komentar->delete();
            return response()->json([
                'message'=>'Your comment has been deleted!'
            ], 200);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'message'=>'Your comment has not been deleted!'
            ],500);
        }
    }
}