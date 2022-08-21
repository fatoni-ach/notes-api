<?php

namespace App\Http\Controllers\V1\Key;

use App\Http\Controllers\Controller;
use App\Http\Requests\KeyRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KeyController extends Controller
{
    public function registerKey(KeyRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'secret_key' => Str::random(20),
        ]);

        return response()->json([
            'status'    => 'success'
        ], 200);
    }
}
