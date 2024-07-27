<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);
        return view('users.show', compact('user', 'ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $editing = true;
        $ideas = $user->ideas()->paginate(5);
        return view('users.edit', compact('user', 'editing', 'ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        $validated = request()->validate([
            'name' => ['required','string','max:255'],
            'image' => ['image'],
            'bio' => ['nullable','string','max:255'],
        ]);

        /**
         * Stores the uploaded profile image for the user.
         * config/filesystems.php  public is defoned as the disk for the public directory.
         * This code checks if the 'image' field is present in the request, and if so, stores the uploaded image in the 'profile' directory of the 'public' disk.
         */
        if (request()->has('image')) {
            $imagePath = request()->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            /**
             * Deletes the exiting user's profile image from the public disk.
             * This is called when updating the user's profile, if a new image is provided.
             * The previous image is deleted to free up disk space.
             */
            Storage::disk('public')->delete($user->image);
        }

        $user->update($validated);

        return redirect()->route('profile');
    }

    public function profile()
    {
        return $this->show(auth()->user());
    }
}
