<?php

namespace App\Http\Controllers\V1\Notes;

use App\Helper\Respond;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $data = Note::select('title', 'slug')
                ->where('user_id', request()->user->id)
                ->orderBy('id', 'desc')
                ->get();

        return Respond::success('success', $data);
    }


    public function show(Request $request, $slug)
    {
        $user = User::findByKey($request->query('key'));

        $data = Note::select('id', 'title', 'slug', 'body', 'created_by', 'created_at')
                    ->where('slug', $slug)
                    ->where('user_id', $user->id)
                    ->first();

        if(! $data){

            return Respond::failed(404, 'not_found', 'not_found');
        }

        return Respond::success('success', $data);
    }

    public function store(NoteRequest $request)
    {
        $user = User::findByKey($request->query('key'));

        $validated = $request->validated();
        
        $data = Note::create($validated);

        $data->update(['user_id' => $user->id]);

        if (! $data) {

            return Respond::failed(500, 'failed', 'Failed create Note');
        }

        return Respond::success('success create Note', $data);
    }

    public function update(NoteRequest $request, $slug)
    {
        $user = User::findByKey($request->query('key'));

        $validated = $request->validated();
        $data = Note::where('slug', $slug)
                    ->where('user_id', $user->id)
                    ->first();

        if (! $data){

            return Respond::failed(404, 'failed', 'not_found');
        }

        $data->update($validated);

        return Respond::success('success update Note', $data);

    }

    public function destroy(Request $request, $slug)
    {
        $user = User::findByKey($request->query('key'));

        $data = Note::where('slug', $slug)
                        ->where('user_id', $user->id)
                        ->first();

        if(! $data) {

            return Respond::failed(404, 'failed', 'not_found');
        }

        $data->delete();

        return Respond::success('success delete Note');
    }
}
