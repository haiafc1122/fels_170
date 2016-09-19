@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('message'))
        <div class="alert alert-danger">
            {{ session('message')}}
        </div>
    @elseif (session('success'))
        <div class="alert alert-success">
            {{ session('success')}}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><strong>Lessons</strong></h3>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr >
                                <th>Lesson</th>
                                <th>Category</th>
                                <th>Finished at</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lessons as $lesson)
                            <tr>
                                <td>Lesson {{ $lesson->id }}</td>
                                <td>{{ $lesson->category->name }}</td>
                                @if ($lesson->results->first() == null)
                                    <td></td>
                                    <td><a href="{{ url('lesson/' . $lesson->id) }}" class="btn btn-primary">Start lesson</a></td>
                                @else
                                    <td>{{ $lesson->updated_at }}</td>
                                    <td><a href="{{ url('lesson/' . $lesson->id) }}" class="btn btn-default">Show result</a></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
