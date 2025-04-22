<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // $tasks = \App\Models\Task::all(); 

        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }
    
    public function create() {
        return view('tasks.create');
    }
    
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);
    
        // $data = $request->all();
        Task::create($request->all());
        // $data['is_completed'] = $request->has('is_completed') ? 1 : 0;
        // Task::create($data);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
    
    public function edit(Task $task) {
        return view('tasks.edit', compact('task'));
    }
    
    public function update(Request $request, Task $task) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);
        
        $data = $request->all();
        $data['is_completed'] = $request->has('is_completed') ? 1 : 0;
    
        $task->update($data);
        // $task->update($request->all());
    
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
    
    public function destroy(Task $task) {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
