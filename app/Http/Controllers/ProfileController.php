<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Validation\Rule;
use Inertia\Response;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        $mustVerifyEmail = $request->user() instanceof MustVerifyEmail;
        $status = session('status');
        $user = $request->user();

        return view('profile.edit', compact('mustVerifyEmail', 'status', 'user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['string', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048'
        ]);

        // if ($request->user()->isDirty('email')) {
        //     $emailVerifiedAt = null;
        // }

        $updData = [
            'username' => $request->username,
            'email' => $request->email
        ];

        if (isset($request->avatar)) {
            // delete old photo
            if(Storage::exists('avatars/'.Auth::user()->avatar))
                Storage::delete('avatars/'.Auth::user()->avatar);

            $imageName = 'avatar-'.Auth::user()->username.'-'.time().'.'.$request->avatar->extension();
            $request->avatar->storeAs('avatars', $imageName);

            $updData['avatar'] = $imageName;
        }
        
        Auth::user()->update($updData);

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
