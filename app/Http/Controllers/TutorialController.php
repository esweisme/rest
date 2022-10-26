<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;
use Illuminate\Support\Str;

class TutorialController extends Controller
{
    public function index(){

        return Tutorial::all();

    }

    public function show($id){

    //   $tutorial = Tutorial::find($id);

    //eager loading
    $tutorial = Tutorial::with('comments')->where('id', $id)->get();

        if (! $tutorial){
            return response([
                'error' => 'data tutorial tidak ditemukan',     
            ], 404);
        }else{
            return $tutorial;
        }

    }




    public function store(Request $request)
    {
        // die('hard');
        $this->validate($request, [
            'title'  => 'required',
            'body'  => 'required'

        ]);

        $tutorial = $request->user()->tutorials()->create([
            'title' => $request->json('title'),
            'slug'  => Str::slug($request->json('title')),
            'body'  => $request->json('body')
        ]);

        return $tutorial;
    }

    public function update(Request $request, $id)
    {
        // die('hard');
        $this->validate($request, [
            'title'  => 'required',
            'body'  => 'required'

        ]);

        $tutorial = Tutorial::find($id);

        //menguji ownership
        if ($request->user()->id != $tutorial->user_id){
            return response([
                'error' => 'tidak boleh edit',     
            ], 403);

        }

        $tutorial->title = $request->title;
        $tutorial->body = $request->body;
        $tutorial->save();

        return response([
            'status' => true,
            'message' => 'berhasil edit',
            'data' => $tutorial

        ], 200);



    }

    public function destroy(Request $request, $id)
    {
        // die('hard');
        $this->validate($request, [
            'title'  => 'required',
            'body'  => 'required'

        ]);

        $tutorial = Tutorial::find($id);

        //menguji ownership
        if ($request->user()->id != $tutorial->user_id){
            return response([
                'error' => 'tidak boleh hapus',     
            ], 403);

        }

        $tutorial->delete();

        return response([
            'status' => true,
            'message' => 'berhasil hapus',    
            'judul' => $tutorial->title
        ], 200);
    }


}
