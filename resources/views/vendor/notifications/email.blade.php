@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
    # @lang('Whoops!')
@else
    # @lang('Hello!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}
@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'), <br>
{{ config('app.vendor') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
{{ __('If you have trouble clicking the button, copy and paste the URL below') }}
<br>
{{ __('into your web browser:') }}
{{ $actionUrl }}
@endslot
@endisset
@endcomponent
