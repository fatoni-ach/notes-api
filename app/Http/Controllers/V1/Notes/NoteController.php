<?php

namespace App\Http\Controllers\V1\Notes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        $data = Note::select('id', 'title', 'slug', 'body', 'created_by', 'created_at')->orderBy('id', 'desc')->get();
        return response()->json(
            [
                'status'    =>  'success',
                'data'      => $data
            ], 200
        );
    }
}
