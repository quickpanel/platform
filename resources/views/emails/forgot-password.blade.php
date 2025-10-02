@component('mail::message')
# {{ __('platform::common.email_forgot_password_title') }}

{{ __('platform::common.email_forgot_password_intro') }}

@component('mail::panel')
{{ __('platform::common.email_forgot_password_your_code') }}: **{{ $code }}**
@endcomponent

{{ __('platform::common.email_forgot_password_expires', ['minutes' => $ttlMinutes]) }}

@component('mail::button', ['url' => route('change-password')])
{{ __('platform::common.email_forgot_password_button') }}
@endcomponent

{{ __('platform::common.email_forgot_password_outro') }}

{{ config('app.name') }}
@endcomponent
