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
            <a class="navbar-brand" href="{{ route('folder.index') }}">フォルダ一覧</a>
          </div>
        </div>
      </nav>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
              	@if($target == 'store')
              	<form action="{{ route('folder.store') }}" method="post">
              	@elseif($target == 'update')
              	<form action="{{ route('folder.update', ['folder' => $folder->id]) }}" method="post">
              		<input type="hidden" name="_method" value="PUT">
                  <input type="hidden" name="folder_id" value="{{ $folder->id }}">
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
                        <label>フォルダ名</label>
                        <input type="text" class="form-control" name="name" value="{{ !empty(old('name')) ? old('name') : $folder->name }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">登録する</button>
                    </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
</div>
@endsection