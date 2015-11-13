@extends('layout')

@section('content')
    <h1>FILM LIST</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($films as $film)

                    <tr>
                        <td><a href="{{ url('/film', $film->id) }}" class="btn btn-default">{{$film->title}} </a></td>
                        <td>{{$film->date}}</td>
                        <td>{{$film->rating}}</td>
                    </tr>

            @endforeach
        </tbody>
    </table>


@stop


