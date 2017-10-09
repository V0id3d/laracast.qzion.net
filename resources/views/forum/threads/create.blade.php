@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create New Thread
                    </div>
                    <div class="panel-body">
                        <form action="#">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" placeholder="Thread Title">
                            </div>
                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea name="body" id="body" class="form-control" rows="5" placeholder="Thread Body"></textarea>
                            </div>

                            <button type="submit" class="btn btn-default">Publish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection