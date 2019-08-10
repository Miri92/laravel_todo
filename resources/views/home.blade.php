@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your Todos <a href="{{route('todo.create')}}" class="btn btn-primary pull-right btn-sm">Add New Todo</a></div>

                <div class="panel-body">
                    @if($get_todos)
                        <table class="table">
                        @foreach($get_todos as $todo)
                            <tr>
                                <td>#{{$todo->id}}</td>
                                <td><a href="{{ route('todo.detail',$todo->id) }}">{{$todo->title}}</a></td>
                                <td>
                                    <form action="{{ route('todo.destroy', $todo->id) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
