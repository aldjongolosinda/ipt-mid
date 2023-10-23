<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drum; // Make sure to import the Drum model

class DrumController extends Controller
{
    public function index()
    {
        $drums = Drum::all(); // Change variable name from $boutique to $drum
        return view('drum.index', compact('drums')); // Change the view name to 'drum.index'
    }

    public function create()
    {
        return view('drum.create'); // Change the view name to 'drum.create'
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $drum = Drum::create($request->all()); // Change variable name from $boutique to $drum

        $user = auth()->user()->name;
        $log_entry = $user . " added a drum \"" . $drum->name . "\" with the ID " . $drum->id; // Change $boutique to $drum
        event(new UserLog($log_entry));

        return redirect()->route('drum.index')->with('success','Drum created successfully.'); // Change the route name to 'drum.index'
    }

    public function show(Drum $drum)
    {
        return view('drum.show', compact('drum')); // Change the view name to 'drum.show'
    }

    public function edit(Drum $drum)
    {
        return view('drum.edit', compact('drum')); // Change the view name to 'drum.edit'
    }

    public function update(Request $request, Drum $drum)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $drum->update($request->all());

        $user = auth()->user()->name;
        $log_entry = $user . " updated a drum \"" . $drum->name . "\" with the ID " . $drum->id;
        event(new UserLog($log_entry));

        return redirect()->route('drum.index')->with('success','Drum updated successfully');
    }

    public function destroy(Drum $drum)
    {
        $drum->delete();

        $user = auth()->user()->name;
        $log_entry = $user . " deleted a drum \"" . $drum->name . "\" with the ID " . $drum->id;
        event(new UserLog($log_entry));

        return redirect()->route('drum.index')->with('error','Drum deleted successfully');
    }
}
