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
                  <div class="row">
                    <div class="col-md-12">
                      <div class="text-center">
                          <a href="{{ route('folder.create') }}">
                            <button class="btn btn-primary btn-sm">新規作成</button>
                          </a>
                        </div>
                        <div class="d-flex justify-content-center text-center">
                            {{ $folders->links() }}
                        </div>
                        <div class="text-center">
                            <p>{{ $folders->total().'件中　'.$folders->firstItem().'-'.$folders->lastItem().'件表示' }}</p>
                        </div>
                        <table class="table text-center">
                            <tr>
                                <th class="text-center">フォルダ名</th>
                                <th class="text-center">更新日時</th>
                                <th class="text-center">削除</th>
                            </tr>
                            @foreach($folders as $folder)
                            <tr>
                                <td>
                                  <a href="{{ route('folder.edit', ['folder' => $folder->id]) }}">{{ $folder->name }}</a>
                                </td>
                                <td>{{ $folder->updated_at }}</td>
                                <td>
                                    <form action="{{ route('folder.destroy', ['folder' => $folder->id]) }}" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">削除</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="d-flex justify-content-center text-center">
                            {{ $folders->links() }}
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection