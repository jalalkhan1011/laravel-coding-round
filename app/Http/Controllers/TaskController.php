<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Create a new task
        $task = Task::create([
            'title' => $request->title,
            'is_completed' => false, // Default value for completed
        ]);

        return response()->json(["id" => $task->id, "title" => $task->title, "is_completed" => $task->is_completed, "created_at" => $task->created_at], 201); // Return created task
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json(["id" => $task->id, "title" => $task->title, "is_completed" => $task->is_completed, "created_at" => $task->created_at]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        // Validate the request
        $request->validate([
            'title' => 'nullable|string|max:255',
            'is_completed' => 'nullable|boolean',
        ]);

        // Update task fields
        $task->update([
            'title' => $request->title ?? $task->title,
            'is_completed' => $request->has('is_completed') ? $request->is_completed : $task->is_completed,
        ]);

        return response()->json(["id" => $task->id, "title" => $task->title, "is_completed" => $task->is_completed, "created_at" => $task->created_at]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }

    public function pendingTask()
    {
        $pendingTasks = Task::where('is_completed', false)->get();
        return response()->json($pendingTasks);
    }
}
