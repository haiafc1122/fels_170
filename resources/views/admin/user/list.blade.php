@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1><strong>Danh sach nguoi dung</strong></h1>
        <table class="table table-bordered">
            <thead>
                <tr >
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $us)
                <tr>
                    <td>{{ $us->id }}</td>
                    <td>{{ $us->name }}</td>
                    <td>{{ $us->email}}</td>
                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>
                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div align="center">{!! $user->links() !!}</div>
    </div>
</div>
@stop
