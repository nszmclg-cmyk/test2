<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GreetingResource;
use App\Models\Greeting;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GreetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $greetings = Greeting::with('person')->latest()->get();

        return response()->json([
            'data' => GreetingResource::collection($greetings),
            'message' => 'Greeting一覧を取得しました'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'person_id' => 'required|exists:people,id',
            'message' => 'required|string|max:1000',
        ]);

        $greeting = Greeting::create($validated);
        $greeting->load('person');

        return response()->json([
            'data' => new GreetingResource($greeting),
            'message' => 'Greetingを作成しました'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Greeting $greeting): JsonResponse
    {
        $greeting->load('person');

        return response()->json([
            'data' => new GreetingResource($greeting),
            'message' => 'Greeting詳細を取得しました'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Greeting $greeting): JsonResponse
    {
        $validated = $request->validate([
            'person_id' => 'required|exists:people,id',
            'message' => 'required|string|max:1000',
        ]);

        $greeting->update($validated);
        $greeting->load('person');

        return response()->json([
            'data' => new GreetingResource($greeting),
            'message' => 'Greetingを更新しました'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Greeting $greeting): JsonResponse
    {
        $greeting->delete();

        return response()->json([
            'message' => 'Greetingを削除しました'
        ]);
    }
}
