@extends('layouts.app')

@section('content')
    <div class="container">
<div class="row">
    <div class="col-md-6">
        <form action="{{ route('todo.store') }}" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control" required></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Create</button>
        </form>
    </div>
    <div class="col-md-6"></div>
</div>
    </div>
@endsection