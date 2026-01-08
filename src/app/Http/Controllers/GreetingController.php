<?php

namespace App\Http\Controllers;

use App\Models\Greeting;
use App\Models\Person;
use Illuminate\Http\Request;

class GreetingController extends Controller
{
    public function index()
    {
        $greetings = Greeting::with('person')->latest()->get();

        return view('greetings.index', compact('greetings'));
    }

    public function create()
    {
        $people = Person::all();

        return view('greetings.create', compact('people'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'person_id' => 'required|exists:people,id',
            'message' => 'required|string|max:1000',
        ]);

        Greeting::create($validated);

        return redirect()->route('greetings.index')->with('success', '挨拶を追加しました');
    }

    public function destroy(Greeting $greeting)
    {
        $greeting->delete();

        return redirect()->route('greetings.index')->with('success', '挨拶を削除しました');
    }
}
