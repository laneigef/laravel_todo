@extends('layouts.app')

@section('content')
<div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="{{ route('todo.index') }}">ToDo</a>
          </div>
        </div>
      </nav>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
              	@if($target == 'store')
              	<form action="{{ route('todo.store') }}" method="post">
              	@elseif($target == 'update')
              	<form action="{{ route('todo.update', ['todo' => $todo->id]) }}" method="post">
              		<input type="hidden" name="_method" value="PUT">
                  <input type="hidden" name="todo_id" value="{{ $todo->id }}">
              	@endif
              	  <input type="hidden" name="target" value="{{ $target }}">
                  @csrf
                  <div class="row">
                    <div class="col-md-12">
                      @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                      @endif
                      <div class="form-group">
                        <label>タイトル</label>
                        <input type="text" class="form-control" name="title" value="{{ !empty(old('title')) ? old('title') : $todo->title }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>フォルダ</label>
                        <select class="form-control" name="task_statuses_id">
                          <option value="">選択してください</option>
                          @foreach ($folders as $folder)
                          {{ !empty(old('task_statuses_id')) ? $todo->task_statuses_id = old('task_statuses_id') : $todo->task_statuses_id = $todo->task_statuses_id }}
                          <option value="{{ $folder->id }}" @if ($folder->id  == $todo->task_statuses_id ) selected @endif>{{ $folder->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>詳細</label><br>
                        <textarea class="form-control" name="detail">{{ !empty(old('detail')) ? old('detail') : $todo->detail }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>対応期限</label>
                        <input type="date" class="form-control" name="deadline" value="{{ !empty(old('deadline')) ? old('deadline') : $todo->deadline }}">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">登録する</button>
                    </div>
                  </div>
                </form>
                @if($target == 'update')
                <form action="{{ route('todo.destroy', ['todo' => $todo->id]) }}" method="post">
                	<input type="hidden" name="_method" value="DELETE">
                  	@csrf
                  	<div class="row">
                    	<div class="update ml-auto mr-auto">
                      		<button type="submit" class="btn btn-danger btn-round">削除する</button>
                    	</div>
                  	</div>
                </form>
                @endif
              </div>
          </div>
        </div>
      </div>
</div>
@endsection