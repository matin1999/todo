@extends('layouts.app')

@section('content')
    <div class="container">
            <h1>ثبت نام</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

        <form action="{{route('register')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">نام</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="form-group">
                <label for="title">ایمیل</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="title">موبایل</label>
                <input type="text" class="form-control" id="mobile" name="mobile">
            </div>

            <div class="form-group">
                <label for="password">رمز</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">تکرار رمز عبور</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary">ثبت نام</button>
        </form>
    </div>
@endsection
