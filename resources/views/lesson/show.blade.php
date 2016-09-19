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
            <h3><strong>{{ $lesson->category->name }}: Lesson {{ $lesson->id }}</strong></h3>
            <h4>The lesson will submit in: <span id="clock"></span> minutes</h4>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-condensed lesson">
                        <form action="{{ url('lesson/' . $lesson->id) }}" method="POST" id="test">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <button type="submit" class="btn btn-default">
                                Finish
                            </button>
                            <tbody>
                                @foreach ($words as $key => $word)
                                    <tr>
                                        <td class="col-sm-1">{{ $key + 1 }}.</td>
                                        <td><strong>{{ $word->content }}</strong></td>
                                        <input type="hidden" value="{{ $word->id }}" name="word_ids[{{ $key }}]">
                                    </tr>
                                    <tr>
                                        <td class="col-sm-1"></td>
                                        @foreach ($word->anwsers as $anwser)
                                            <td class="col-sm-2">
                                                <input type="radio" value="{{ $anwser->id }}" name="word_anwser[{{ $word->id }}]">
                                                {{ $anwser->content }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn-default">
                                            Finish
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    val = 20 * 60 * 1000;
    time = new Date().valueOf() + val;
    $('#clock').countdown(time.toString()).on('update.countdown', function(event) {
        $(this).html(event.strftime('%M:%S'));
    }).on('finish.countdown', function(event) {
        $("#test").submit();
    });
</script>
@endsection
