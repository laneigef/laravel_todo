@extends('layouts.app')
@section('content')
@include('todo.form', ['target' => 'store'])
@endsection