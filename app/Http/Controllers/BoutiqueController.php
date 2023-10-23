<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\Boutique;
use Illuminate\Http\Request;

class BoutiqueController extends Controller
{
    public function index()
    {
        $boutique = Boutique::all();
        return view('boutique.index', compact('boutique'));
    }

    public function create()
    {
        return view('boutique.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $boutique = Boutique::create($request->all());

        $user = auth()->user()->name;
        $log_entry = $user . " added a drum \"" . $boutique->name . "\" with the ID " . $boutique->id;
        event(new UserLog($log_entry));

        return redirect()->route('boutique.index')->with('success','Drum created successfully.');
    }

    public function show(Boutique $boutique)
    {
        return view('boutique.show', compact('boutique'));
    }

    public function edit(Boutique $boutique)
    {
        return view('boutique.edit', compact('boutique'));
    }

    public function update(Request $request, Boutique $boutique)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $boutique->update($request->all());

        $user = auth()->user()->name;
        $log_entry = $user . " updated a drum \"" . $boutique->name . "\" with the ID " . $boutique->id;
        event(new UserLog($log_entry));

        return redirect()->route('boutique.index')->with('success','Drum updated successfully');
    }

    public function destroy(Boutique $boutique)
    {
        $boutique->delete();

        $user = auth()->user()->name;
        $log_entry = $user . " deleted a drum \"" . $boutique->name . "\" with the ID " . $boutique->id;
        event(new UserLog($log_entry));

        return redirect()->route('boutique.index')->with('error','Drum deleted successfully');
    }
}
