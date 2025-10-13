<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $coach = \App\Models\Coach::firstOrCreate(
            ['user_id' => auth()->id()],
            ['sport' => 'Football', 'bio' => null]
        );
        return view('coach.profile.edit', compact('coach'));
    }

    public function update(Request $request)
    {
        $coach = Coach::where('user_id', auth()->id())->firstOrFail();

        $data = $request->validate([
            'sport' => ['required','string','max:100'],
            'bio'   => ['nullable','string','max:2000'],
        ]);

        $coach->update($data);

        return back()->with('success','Profile updated.');
    }
}
