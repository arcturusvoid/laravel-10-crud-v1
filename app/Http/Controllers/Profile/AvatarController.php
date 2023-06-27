<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateAvatarRequest;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request){

        if($request->user()->avatar)
          Storage::disk('public')->delete($request->user()->avatar);

        $path = $request->file('avatar')->store('avatars', 'public');
        auth()->user()->update(['avatar' => $path]);
        
        return redirect()->route('profile.edit')->with('status', 'avatar-updated');
    }
}
