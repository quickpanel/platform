@component('mail::message')
# {{ __('platform::common.email_password_changed_title') }}

{{ __('platform::common.email_password_changed_intro') }}

{{ __('platform::common.email_password_changed_security_tip') }}

{{ config('app.name') }}
@endcomponent
