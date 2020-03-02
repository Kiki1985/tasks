@component('mail::message')
# New Task: {{$task->title}}

{{$task->description}}

@component('mail::button', ['url' => url('/tasks')])
View Task
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
