@extends('layouts.app')

@section('content')
    <div class="container">
<div class="row">
    <div class="col-md-8">
        <h2>{{$todo->title}}</h2>
        <p>{{$todo->description}}</p>
    </div>
    <div class="col-md-4">
        <div class="well">
            <h3>Share This Todo</h3>
            <form action="{{route('todo.share')}}" method="post">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" name="shared_with" class="form-control" placeholder="Username" required>
                    <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Share</button>
                </span>
                </div>
                <input type="hidden" name="todo_id" class="form-control" value="{{$todo->id}}">
            </form>
        </div>
        <div class="well">
            <h3>This Todo Shared with</h3>
            <table class="table">
                @if($todo->shared)
                    @foreach($todo->shared as $shared)
                        <tr>
                            <td>{{$shared->user_name}}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
    <div class="col-md-6"></div>
</div>
    </div>
@endsection