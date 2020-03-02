@component('mail::message')
# Task Deleted: {{$task->title}}

{{$task->description}}

@component('mail::button', ['url' => ''])
View Task
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
