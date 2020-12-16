@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <h1>لیست کارها</h1>
            <div>
                <a href="{{ route('logout') }}" class="btn btn-primary"> log out</a>

                <a href="{{ route('tasks.create') }}" class="btn btn-primary">اضافه کردن</a>
            <a href="{{route('tags.index')}}" class="btn btn-secondary">مدیریت تگ ها</a>
            </div>
        </div>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @forelse($tasks as $index => $task)
            <div class="card mb-4">
                <div class="card-body">
                    <a href="{{route('tasks.show',$task)}}">
                    <h5 class="card-title">{{ $task->title }}</h5>
                    </a>
                    <p class="card-text badge badge-info">{{$task->tags->implode('name', ',')}}</p>
                    <p class="card-title">{{verta($task->date)}}</p>
                    <span class="badge badge-primary">{{ $task->done ? 'انجام شده' : 'انجام نشده' }}</span>
                </div>
                <div class="card-footer d-flex flex-column">
                    <a href="{{ route('tasks.edit', $task) }}">ویرایش</a>
                    <a href="{{ route('tasks.delete', $task) }}"> getحذف</a>

                    <form action="{{route('tasks.destroy',$task)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">حدف</button>
                        <button class="btn btn-danger" onclick="return confirm('آیا مظمین هستید')">با اخظار حدف</button>
                        <button class="btn btn-danger" type="submit"> ajaxبا اخظار حدف</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="alert alert-info">شما هنوز هیچ کاری اضافه نکرده‌اید.</div>
        @endforelse
    </div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
