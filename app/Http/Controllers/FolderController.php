<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\FolderRequest;
use App\TaskStatuses;

class FolderController extends Controller
{
	private $db_folders;

    public function __construct(TaskStatuses $db_folders)
    {
        $this->middleware('auth');
        $this->db_folders = $db_folders;
    }

    public function index()
    {
    	$folders = TaskStatuses::where('user_id', Auth::id())->paginate(10);
        return view('folder.index', compact('folders'));
    }

    public function create()
    {
        $folder = new TaskStatuses();
        return view('folder.create', compact('folder'));
    }

    public function store(FolderRequest $request)
	{
		$this->db_folders->createOrUpdate($request);
	    return redirect()->route('folder.index');
	}

	public function edit($id)
    {
    	$folder = TaskStatuses::findOrFail($id);
    	if ($folder->user_id != Auth::id()) {
            return redirect()->route('folder.index');
        }
    	return view('folder.edit', compact('folder'));
    }

    public function update(FolderRequest $request)
    {
    	$folder = Todos::findOrFail($request->folder_id);
        if ($folder->user_id != Auth::id()) {
            return redirect()->route('folder.index');
        }

    	$this->db_folders->createOrUpdate($request);
    	return redirect()->route('folder.index');
    }

    public function destroy($id)
    {
    	$folder = TaskStatuses::findOrFail($id);
    	if ($folder->user_id != Auth::id()) {
            return redirect()->route('folder.index');
        }
        $folder->delete();
        
    	return redirect()->route('folder.index');
    }
}
