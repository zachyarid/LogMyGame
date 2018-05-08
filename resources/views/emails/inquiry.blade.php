@component('mail::message')
# Inquiry Received

There has been a new inquiry

User: {{ $inquiry->user->fname }} {{ $inquiry->user->lname }}

Email: {{ $inquiry->user->email }}

Subject: {{ $inquiry->subject }}

Click below to view the inquiry:
@component('mail::button', ['url' => config('app.url') . '/help/' . $inquiry->id])
View Inquiry
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent