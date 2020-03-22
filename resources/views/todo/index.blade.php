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
            <form action="{{ route('todo.search') }}" method="get">
              <div class="input-group no-border">
                <input type="text" name="keyword" value="" class="form-control" placeholder="検索" required="">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <button class="nc-icon nc-zoom-split" type="submit"></button>
                    </div>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </nav>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                          <a href="{{ route('todo.create') }}">
                            <button class="btn btn-primary btn-sm">新規作成</button>
                          </a>
                        </div>
                        <div class="d-flex justify-content-center text-center">
                            {{ $todos->links() }}
                        </div>
                        <div class="text-center">
                            <p>{{ $todos->total().'件中　'.$todos->firstItem().'-'.$todos->lastItem().'件表示' }}</p>
                        </div>
                        <table class="table text-center">
                            <tr>
                                <th class="text-center">@sortablelink('title', 'タイトル')</th>
                                <th class="text-center">@sortablelink('task_statuses_id', 'フォルダ')</th>
                                <th class="text-center">@sortablelink('deadline', '対応期限')</th>
                            </tr>
                            @foreach($todos as $todo)
                            <tr>
                                <td>
                                  <a href="{{ route('todo.edit', ['todo' => $todo->id]) }}">{{ $todo->title }}</a>
                                </td>
                                <td>{{ $todo->task_statuses->name }}</td>
                                <td>{{ $todo->deadline }}</td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="d-flex justify-content-center text-center">
                            {{ $todos->links() }}
                        </div>
                    </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
@endsection