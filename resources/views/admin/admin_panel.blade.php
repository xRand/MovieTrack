@extends('layout')

@section('content')
    <h1>Admin Panel</h1>

    <ul>
        <li><a href="{{ url('film/create') }}" class="btn btn-default">Add New Film</a></li>
    </ul>

@stop