<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();
        return response()->json([
            'data'   => $todos,
            'message' => 'Taches retournees avec succes',
            'count'  => $todos->count()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'sometimes|boolean',
            'priority' => 'sometimes|in:low,medium,high',
        ]);

        $todo = Todo::create($validated);

        return response()->json([
            'data'  => $todo,
            'message' => 'Tache creee avec succes'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = Todo::find($id);
        if (!$todo){
            return response()->json([
                'message' => 'Tache introuvable!'
            ], 404);
        }
        return response()->json([
            'data' => $todo,
            'message' => 'tache retrouver avec succes'
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {        
        $todo = Todo::find($id);

        if (!$todo){
            return response()->json([
                'message' => 'Tache introuvable!'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'sometimes|boolean',
            'priority' => 'sometimes|in:low,medium,high',
        ]);

        $todo->update($validated);

        return response()->json([
            'data'  => $todo,
            'message' => 'Tache modifiee avec succes'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::find($id);
        if (!$todo) { 
            return response()->json([ 
                'message' => 'Product not found', 
            ], 404); 
        } 
        $todo->delete();

        return response()->json([
            'message' => 'tache supprimer avec succes'
        ],204);
    }

    public function patched(string $id)
    {
        $todo = Todo::find($id);

        if (!$todo){
            return response()->json([
                'message' => 'Tache introuvable!'
            ], 404);
        }

        $todo->completed = TRUE;
        $todo->save();

        return response()->json([
            'data'  => $todo,
            'message' => 'Tache marquee completee'
        ], 200);  
    }
}
