@extends('layouts.app')

@section('content')
@if(session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
@elseif (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                        <tr >
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Update At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td class="center">
                                <form action="{{ url('lesson') }}" method="POST">
                                    {{ csrf_field() }}

                                    <input id="category_id" type="hidden" value="{{ $category->id }}" name="category_id">
                                    <button type="submit" class="btn btn-default">
                                        Create and start lesson
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div align="center">{!! $categories->links() !!}</div>
            </div>
        </div>
    </div>
</div>
@endsection
