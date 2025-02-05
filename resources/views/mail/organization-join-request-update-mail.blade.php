<x-mail::message>
# Request Join Status Update for {{ $organization->name }}

Hello {{ $user->name }}, You have been **{{ $status }}** to joining {{ $organization->name }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
