<x-mail::message>
# New Contact

Name: {{ $name }} <br>
Email: {{ $email }} <br>
Subject: {{ $subjectTopic }} <br>
Message: {{ $message }} <br>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
