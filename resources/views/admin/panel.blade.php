@extends('layout')

@section('content')
    <h1>Admin Panel</h1>

    <ul>
        <li><a href="{{ url('film/create') }}" class="btn btn-default">Add New Film</a></li>
        <li><a href="{{ url('admin/users') }}" class="btn btn-default">User Management</a></li>
        <li><a href="{{ url('admin/comments') }}" class="btn btn-default">Comment Management</a></li>
    </ul>

@stop