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
            <button onclick="printPDF()">Print PDF</button>
            <h3><strong>Lesson {{ $lesson->id }}:  Result</strong></h3>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                                <th>Result</th>
                                <th>Words</th>
                                <th>Your answer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lesson->results as $result)
                            <tr>
                                @if ($result->anwser_id != 0 && $result->anwser->is_correct == true)
                                    <td>O</td>
                                @else
                                    <td>X</td>
                                @endif
                                <td>{{ $result->word->content }}</td>
                                @if ($result->anwser_id == 0)
                                    <td></td>
                                @else
                                    <td>{{ $result->anwser->content }}</td>
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
<script type="text/javascript">
    function printPDF() {
        window.print();
        }
</script>
@endsection
