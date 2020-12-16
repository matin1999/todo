@component('mail::message')
# Reminder

{{$task->title}}
@component('mail::button', ['url' => route('tasks.show',$task)])
view Task
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
