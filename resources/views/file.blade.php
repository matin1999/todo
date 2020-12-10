@extends('layouts.app')

@section('content')
        <form action="{{ route('file') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="file">file</label>
                <input type="file" class="form-control" id="file" name="file">
            </div>
            <button type="submit" class="btn btn-primary">upload</button>
        </form>
@endsection
