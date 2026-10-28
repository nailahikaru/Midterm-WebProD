<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update($data);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }
}