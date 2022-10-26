<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $this->validate($request, ['body'  => 'required']);

        $tut = Tutorial::find($id);

        if(!$tut){
            return response([
                'error' => 'tidak ada tutorialnya',     
            ], 404);
        }

        $comment = $request->user()->comments()->create([
            'body'          => $request->json('body'),
            'tutorial_id'   => $id
        ]);

        return response([
            'status' => true,
            'message' => 'berhasil menambah komentar',
            'data' => $comment

        ], 200);
    }
}
