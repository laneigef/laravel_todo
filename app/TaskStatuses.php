<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TaskStatuses extends Model
{
    //
    protected $fillable = [
        'name', 'user_id',
    ];

    public function todos()
    {
        return $this->hasMany('App\Todos');
    }

    public function createOrUpdate($request)
    {
    	$target = $request->target;
        if ($target === 'store') {
            $folder = new TaskStatuses();
            $folder->user_id = Auth::id();
        } elseif ($target === 'update') {
            $folder = TaskStatuses::findorfail($request->folder_id);
        }
        $folder->fill($request->all());
        $folder->save();

    	return $folder;
    }
}
