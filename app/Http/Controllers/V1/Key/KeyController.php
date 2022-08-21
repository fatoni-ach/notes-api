<?php

namespace App\Http\Controllers\V1\Key;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use App\Models\Note;

class KeyController extends Controller
{
    public function registerKey()
    {
        return response()->json([
            'register key'
        ]);
    }
}
