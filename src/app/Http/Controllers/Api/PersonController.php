<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $people = Person::withCount('greetings')->latest()->get();

        return response()->json([
            'data' => PersonResource::collection($people),
            'message' => 'Person一覧を取得しました'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:150',
        ]);

        $person = Person::create($validated);

        return response()->json([
            'data' => new PersonResource($person),
            'message' => 'Personを作成しました'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person): JsonResponse
    {
        $person->load('greetings');

        return response()->json([
            'data' => new PersonResource($person),
            'message' => 'Person詳細を取得しました'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:150',
        ]);

        $person->update($validated);

        return response()->json([
            'data' => new PersonResource($person),
            'message' => 'Personを更新しました'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person): JsonResponse
    {
        $person->delete();

        return response()->json([
            'message' => 'Personを削除しました'
        ]);
    }
}
