<?php

namespace App\Http\Controllers\V1\Notes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        $data = Note::select('title', 'slug')->orderBy('id', 'desc')->get();
        return response()->json(
            [
                'status'    =>  'success',
                'data'      => $data
            ], 200
        );
    }

    public function store(NoteRequest $request)
    {
        $validated = $request->validated();
        
        $data = Note::create($validated);

        $code = 200;
        $status = 'success';
        if (! $data) {
            $code = 500;
            $status = 'failed';

            $data = null;
        }

        return response()->json([
            'status'   => $status,
            'data'     => $data,
        ], $code);
    }
}
