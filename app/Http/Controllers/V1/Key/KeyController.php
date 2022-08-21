<?php

namespace App\Http\Controllers\V1\Key;

use App\Helper\Respond;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetKeyRequest;
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
            'secret_key' => Str::random(50),
        ]);

        return Respond::success('User success register key');
    }

    public function getKey(GetKeyRequest $request)
    {
        $validated = $request->validated();

        $user = User::select('secret_key', 'password')
                        ->where('email', $validated['email'])
                        ->first();

        if(Hash::check($validated['password'], $user->password)) {

            $data = [
                'secret_key' => $user->secret_key
            ];

            return Respond::success('Success get Secret Key', $data);
        }

        return Respond::failed(404, 'not_found', 'User Not Found / email and password doesnt match');
    }
}
