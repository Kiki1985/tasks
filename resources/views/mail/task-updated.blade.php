@component('mail::message')
# Task Updated: {{$task->title}}

{{$task->description}}

@component('mail::button', ['url' => url('/tasks')])
View Task
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
