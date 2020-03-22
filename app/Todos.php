<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;

class Todos extends Model
{
    use Sortable;

    public $sortable = [
        'title', 'task_statuses_id', 'deadline',
    ];

    protected $fillable = [
        'user_id', 'title', 'task_statuses_id', 'detail', 'deadline',
    ];

    public function task_statuses()
    {
        return $this->belongsTo('App\TaskStatuses');
    }

    public function createOrUpdate($request)
    {
    	$target = $request->target;
        if ($target === 'store') {
            $todo = new Todos();
            $todo->user_id = Auth::id();
        } elseif ($target === 'update') {
            $todo = Todos::findorfail($request->todo_id);
        }
        $todo->fill($request->all());
        $todo->save();

    	return $todo;
    }

    public function selectSearch($request)
    {
        return Todos::where('user_id', Auth::id())
                ->where(function($query) use ($request){
                    $query->where('title', 'like binary', '%'.$request->input('keyword').'%');
                })
                ->orwhere(function($query) use ($request){
                    $query->where('detail', 'like binary', '%'.$request->input('keyword').'%');
                })
                ->sortable()
                ->paginate(10);
    }
}
