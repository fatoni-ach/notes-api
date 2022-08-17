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


    public function show(Request $request, $slug)
    {
        $data = Note::select('id', 'title', 'slug', 'body', 'created_by', 'created_at')
                    ->where('slug', $slug)->first();

        $code = 200;
        $status = 'success';

        if(! $data){
            $code = 404;
            $status = 'not found';
        }

        return response()->json([
            'status'    => $status,
            'data'  => $data,
        ], $code);
    }

    public function store(NoteRequest $request)
    {
        $validated = $request->validated();
        
        $data = Note::create($validated);

        $code = 200;
        $status = 'success create';
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

    public function update(NoteRequest $request, $slug)
    {
        $validated = $request->validated();
        $data = Note::where('slug', $slug)->first();

        if (! $data){
            return response()->json([
                'status'    => 'not found',
                'data'      => null,
            ], 404);
        }

        $data->update($validated);

        return response()->json([
            'status'    => 'success update',
            'data'      => $data
        ], 200);

    }

    public function destroy(Request $request, $slug)
    {
        $data = Note::where('slug', $slug)->first();

        if(! $data) {
            return response()->json([
                'status'    => 'not found',
                'data'      => null
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status'    => 'success delete',
            'data'  => null,
        ], 200);
    }
}
