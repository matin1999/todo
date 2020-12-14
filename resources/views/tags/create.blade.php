@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <h1>نگ جدید</h1>
            <a href="{{ route('tags.index') }}" class="btn btn-secondary">بازگشت</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tags.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">نام</label>
                <input type="text" class="form-control" id="name" name="name">
                @error('title')<p class="m-0">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="color">رنگ</label>
                <input type="color" class="form-control" id="color" name="color">
            </div>

            <button type="submit" class="btn btn-primary">اضافه کردن</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#date").pDatepicker({
                'persianDigit':false,
                'format':'YYYY/MM/DD H:m',
                'altField':'#altField',
            });
        });
    </script>
@endsection
