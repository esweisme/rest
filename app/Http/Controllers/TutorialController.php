<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;
use Illuminate\Support\Str;

class TutorialController extends Controller
{
    public function create(Request $request)
    {
        // die('hard');
        $this->validate($request, [
            'title'  => 'required',
            'body'  => 'required'

        ]);

        $tutorial = $request->user()->tutorials()->create([
            'title' => $request->json('title'),
            'slug'  => Str::slug($request->json('email')),
            'body'  => $request->json('body')
        ]);

        return $tutorial;
    }
}
