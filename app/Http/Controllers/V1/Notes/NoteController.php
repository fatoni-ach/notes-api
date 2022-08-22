<?php

namespace App\Http\Controllers\V1\Notes;

use App\Helper\Respond;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        $data = Note::select('title', 'slug')->orderBy('id', 'desc')->get();

        return Respond::success('success', $data);
    }


    public function show(Request $request, $slug)
    {
        $data = Note::select('id', 'title', 'slug', 'body', 'created_by', 'created_at')
                    ->where('slug', $slug)->first();

        if(! $data){

            return Respond::failed(404, 'not_found', 'not_found');
        }

        return Respond::success('success', $data);
    }

    public function store(NoteRequest $request)
    {
        $validated = $request->validated();
        
        $data = Note::create($validated);

        if (! $data) {

            return Respond::failed(500, 'failed', 'Failed create Note');
        }

        return Respond::success('success create Note', $data);
    }

    public function update(NoteRequest $request, $slug)
    {
        $validated = $request->validated();
        $data = Note::where('slug', $slug)->first();

        if (! $data){

            return Respond::failed(404, 'failed', 'not_found');
        }

        $data->update($validated);

        return Respond::success('success update Note', $data);

    }

    public function destroy(Request $request, $slug)
    {
        $data = Note::where('slug', $slug)->first();

        if(! $data) {

            return Respond::failed(404, 'failed', 'not_found');
        }

        $data->delete();

        return Respond::success('success delete Note');
    }
}
