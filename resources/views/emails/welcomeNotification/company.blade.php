@component('mail::message')
# Introduction

<p>Welcome {{$name}}</p>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
