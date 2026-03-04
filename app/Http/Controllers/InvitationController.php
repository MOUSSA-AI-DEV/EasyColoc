<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Invitation;
use App\Http\Requests\StoreInvitationRequest;
use App\Models\User;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvitationRequest $request, Colocation $colocation)
    {
        $request->validated();
        $token = Str::random(16);
        Invitation::create([
            'colocation_id' => $colocation->id,
            'token' => $token,
            'email' => $request->email
        ]);

        $user = User::where('email', $request->email)->first();

        $colocation->users()->attach($user->id, [
            'role' => 'member',
        ]);
        return redirect()->route('colocations.show', $colocation)->with('success', 'Invitation created successfully : ' . $token);
    }
}
