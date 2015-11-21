@extends('layout')

@section('content')
    <h1>{{$film->title}}</h1>


    Date: {{ $film->date }}
    <br>
    Rating: {{ $film->rating }}
    <br>
    <a href="{{ $film->id }}/edit" class="btn btn-default">EDIT</a>
    <br>
    <img src="{{ $film->poster }}" class="img-thumbnail" alt="poster" width="" height="">




    @if(Auth::check())

        <h4>Subscription</h4>
        <div class="btn-toggle">
            <a href="{{ action('FilmController@switchSubStatus', [$film->id, 'status' => 'sub']) }}"
               class="btn btn-lg btn-primary subBtn">Subcribe!</a>
            <a href="{{ action('FilmController@switchSubStatus', [$film->id, 'status' => 'unsub']) }}"
               class="btn btn-lg btn-success unsubBtn hide">☑ Subscribed</a>
        </div>


        <form class="form-horizontal" id="rate" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="text" name="rate" value="{{$rate}}">
            <button type="submit" class="btn btn-primary">Rate</button>
        </form>


        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
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


                $('#rate').submit(function(event){
                    event.preventDefault();
                    var rate = $('input[name="rate"]').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type  : "PUT",
                        data: {'rate':  rate},
                        url: "",
                        cache : false,
                        success : function(data) {
                            console.log(data);
//                            var html = '';
//                            data.forEach(function (value) {
//                                html += '<tr>'+
//                                '   <td>'+value['username']+'</td>'+
//                                '   <td>'+value['comment']+'</td>'+
//                                '   <td>'+value['created_at']+'</td>'+
//                                '   <td><button type="submit" class="btn btn-primary ajax" id="'+value['id']+'">Delete</button></td>'+
//                                '</tr>';
//                            });
//                            $('.alert').addClass('alert-danger').text("Deleted!");
//                            $('.comments').html(html);
                        },
                        error : function() {
                            $('.alert').addClass('alert-danger').text("Error");
                        }
                    });
                });
            </script>
        @endsection


    @endif

    @include('partials/commentbox')

@stop