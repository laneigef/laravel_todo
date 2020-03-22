<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Todos;
use App\TaskStatuses;

class TodoController extends Controller
{
	private $db_todo;

    public function __construct(Todos $db_todo)
    {
        $this->middleware('auth');
        $this->db_todo = $db_todo;
    }

    public function index()
    {
        $todos = Todos::where('user_id', Auth::id())->sortable()->paginate(10);
        return view('todo.index', compact('todos'));
    }

    public function search(Request $request)
    {
        $todos = $this->db_todo->selectSearch($request);
        return view('todo.index', compact('todos'));
    }

    public function create()
    {
        $todo = new Todos();
        $folders = TaskStatuses::where('user_id', Auth::id())->get();
        return view('todo.create', compact('todo', 'folders'));
    }

    public function store(TodoRequest $request)
	{
		$this->db_todo->createOrUpdate($request);
	    return redirect()->route('todo.index');
	}

	public function edit($id)
    {
    	$todo = Todos::findOrFail($id);
        if ($todo->user_id != Auth::id()) {
            return redirect()->route('todo.index');
        }
    	$folders = TaskStatuses::where('user_id', Auth::id())->get();
    	return view('todo.edit', compact('todo', 'folders'));
    }

    public function update(TodoRequest $request)
    {
        $todo = Todos::findOrFail($request->todo_id);
        if ($todo->user_id != Auth::id()) {
            return redirect()->route('todo.index');
        }

    	$this->db_todo->createOrUpdate($request);
    	return redirect()->route('todo.index');
    }

    public function destroy($id)
    {
    	$todo = Todos::findOrFail($id);
        if ($todo->user_id != Auth::id()) {
            return redirect()->route('todo.index');
        }
        $todo->delete();

    	return redirect()->route('todo.index');
    }
}
