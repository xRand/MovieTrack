@extends('layout')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add New Film</div>
                    <div class="panel-body">

                        @include('errors.list')

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/film') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Title</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Date</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="date" value="{{ old('date') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Genre</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="genre" value="{{ old('genre') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Director</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="director" value="{{ old('director') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Poster</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="poster" value="{{ old('poster') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Description</label>
                                <div class="col-md-6">
                                    <textarea rows="4" class="form-control" name="description" value="{{ old('description') }}"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
