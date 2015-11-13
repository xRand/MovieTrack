@extends('layout')

@section('content')
    <h1>{{$film->title}}</h1>


    {{ $film->date }}

    <a href="{{ $film->id }}/edit" class="btn btn-default">EDIT</a>
    <br>
    <img src="{{ $film->poster }}" class="img-thumbnail" alt="poster" width="" height="">


    @if(Auth::check())


        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif

        <h4>Subscription</h4>
        <div class="btn-toggle">
            <a href="{{ action('FilmController@switchSubStatus', [$film->id, 'status' => 'sub']) }}"
               class="btn btn-lg btn-primary subBtn">Subcribe!</a>
            <a href="{{ action('FilmController@switchSubStatus', [$film->id, 'status' => 'unsub']) }}"
               class="btn btn-lg btn-success unsubBtn hide">☑ Subscribed</a>
        </div>

        @section('footer')
            <script>
                @if($sub == 'true')
                    $('.subBtn').addClass('hide');
                    $('.unsubBtn').removeClass('hide');
                @else
                     $('.subBtn').removeClass('hide');
                     $('.unsubBtn').addClass('hide');
                @endif

                $('.btn-toggle').click(function () {
                            $(this).toggle('slow');
                        });

                $('.unsubBtn')
                        .hover(function () {
                            $(this).toggleClass('btn-danger').text('☒ Unsubscribe');
                        })
                        .mouseout(function () {
                            $(this).text('☑ Subscribed');
                        });
            </script>
        @endsection


    @endif

@stop