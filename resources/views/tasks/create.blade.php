@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <h1>کار جدید</h1>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">بازگشت</a>
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

        <form action="{{ route('tasks.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="title">عنوان</label>
                <input type="text" class="form-control" id="title" name="title">
                @error('title')<p class="m-0">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="tags">tags</label>
                <select name="tags[]" class="custom-select" id="tags" multiple>
                    @foreach($tags as $key=>$value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">تاریخ</label>
                <input type="text" class="form-control" id="date" name="date">
                <input type="hidden" id="altField" name="altField">
            </div>

            <div class="form-group form-check">
                <input type="hidden" name="done" value="0">
                <input type="checkbox" class="form-check-input" id="done" name="done" value="1">
                <label class="form-check-label" for="done">آیا کار انجام شده است؟</label>
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
