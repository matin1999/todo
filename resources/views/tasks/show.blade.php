@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <h1>{{$task->title}} {{$task->done ? 'انجام شده'  : 'انجا نشده '}}</h1>
            <button class="btn btn-info btn-sm" onclick="donetask()">تغییر وضعیت</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">بازگشت</a>
        </div>

        <h2>یاداشت ها</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @forelse($task->notes()->withTrashed()->get() as $note)
            <div class="card mb-4">
                <div class="card-body">
                    <p class="card-text">{{$note->text}}</p>
                </div>
                @if(is_null($note->deleted_at))
                <div class="card-footer">
                    {!! Form::open(['route' => ['tasks.notes.destroy',$task->id,$note->id],'method'=>'delete']) !!}
                    {!! Form::submit('حذف',['class'=>'btn btn-danger btn-block mt-4']) !!}
                    {!! Form::close() !!}
                </div>
                @else
                    {!! Form::open(['route' => ['tasks.notes.terminate',$task->id,$note->id],'method'=>'delete']) !!}
                    {!! Form::submit(' حذف کلی',['class'=>'btn btn-warning btn-block']) !!}
                    {!! Form::close() !!}

                    {!! Form::open(['route' => ['tasks.notes.restore',$task->id,$note->id],'method'=>'post']) !!}
                    {!! Form::submit('بازنشانی',['class'=>'btn btn-info btn-block']) !!}
                    {!! Form::close() !!}
                @endif
            </div>
        @empty
            <p>هنوز یادداشتی اضافه نشده است</p>
        @endforelse

        <h3>افزودن یادداشت</h3>
        <div>

            {!! Form::open(['route' => ['tasks.notes.store',$task->id]]) !!}
            {!! Form::textarea('text',null,['class'=>'form-control']) !!}
            {!! Form::submit('افزودن',['class'=>'btn btn-primary btn-block mt-4']) !!}
            {!! Form::close() !!}
        </div>
        @endsection
        @section('scripts')
            <script>
                function donetask() {
                    $.ajax({
                        'method': 'post',
                        'url': '{{ route('tasks.done',$task) }}',
                        'data': '_{{@csrf_token()}}',
                        success: function (response) {
                            console.log(response)
                        }
                    })
                }
            </script>
@endsection
