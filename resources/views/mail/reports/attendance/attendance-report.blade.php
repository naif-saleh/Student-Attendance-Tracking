@component('mail::message')
# Attendance Report

Hello,

This is the attendance report for {{ $period }}.

@component('mail::button', ['url' => $downloadUrl])
Download Attendance Report
@endcomponent


Thanks,<br>
{{ config('app.name') }}


@endcomponent





<x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
