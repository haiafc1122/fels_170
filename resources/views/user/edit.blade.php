@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-sm-offset-1 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Profile
            </div>
            @if ($message = Session::get('fail'))
                <div class="fail-alert">
                    <button type="button" class="close" data-dismiss="alert">×
                    </button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="panel-body">
                <!-- edit form -->
                <form action="/user/{{$user->id}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <!-- Avatar -->
                    <div class="form-group">
                        <label for="avatar" class="col-sm-3 control-label">Avatar
                        </label>

                        <div class="col-sm-6">
                            <label for="file-upload" class="custom-file-upload">
                                Upload new avatar

                                <input type="file" name="avatar" id="file-upload" class="upload-file" accept="image/*" }}">
                            </label>
                        </div>
                        @if ($errors->has('avatar'))
                            <span class="help-block">
                                <strong>{{ $errors->first('avatar') }}</strong>
                            </span>
                        @endif

                    </div>
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Name</label>

                        <div class="col-sm-6">
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                        </div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                    </div>

                    <!-- email -->
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-6">
                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <!-- User Id -->
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-save"></i>Edit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
