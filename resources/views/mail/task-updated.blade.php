@component('mail::message')
# Task Updated: 

@component('mail::button', ['url' => url('/tasks')])
View Task
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
