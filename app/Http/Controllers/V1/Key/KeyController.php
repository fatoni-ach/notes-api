<?php

namespace App\Http\Controllers\V1\Key;

use App\Http\Controllers\Controller;
use App\Http\Requests\KeyRequest;
use App\Models\Note;

class KeyController extends Controller
{
    public function registerKey(KeyRequest $request)
    {
        $validated = $request-validated();
        return response()->json([
            'register key'
        ]);
    }
}
