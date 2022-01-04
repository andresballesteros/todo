<?php

namespace App\Http\Controllers;

use App\Models\ObservacionTodo;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('home', ['todos' => Todo::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create', ['todo' => new Todo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tarea' => 'required|max:255',
        ]);
        if ($request->has('active')) {
            $data['active'] = true;
        } else {
            $data['active'] = false;
        }
        $data['user_id'] = auth()->user()->id;
        Todo::create($data);
        return redirect()->route('home')->withFlash('La tarea ha sido creada de forma exitosa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        $observacionesTodo = ObservacionTodo::where('todo_id', '=', $todo->id)->get();
        return view('todos.show', compact('todo', 'observacionesTodo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        $this->authorize('update', $todo);
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'tarea' => 'required|max:255',
        ]);
        if ($request->has('active')) {
            $data['active'] = true;
        } else {
            $data['active'] = false;
        }
        $data['user_id'] = auth()->user()->id;
        $todo->update($data);
        return redirect()->route('home')->withFlash('La tarea ha sido actualizada de forma exitosa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('home')->withFlash('La tarea #' . $todo->id . ' ha sido eliminada de forma exitosa');
    }


    public function complete(Todo $todo)
    {
        $data['active'] = true;
        $todo->update($data);
        return redirect()->route('home')->withFlash('La tarea #' . $todo->id . ' ha sido completada de forma exitosa');
    }

    public function incomplete(Todo $todo)
    {
        $data['active'] = false;
        $todo->update($data);
        return redirect()->route('home')->withFlash('La tarea #' . $todo->id . ' ha sido marcada como incompleta de forma exitosa');
    }
}
