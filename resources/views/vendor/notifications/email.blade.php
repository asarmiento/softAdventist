@component('mail::message')
	{{-- Greeting --}}
	@if (! empty($greeting))
		# {{ $greeting }}
	@else
		@if ($level == 'error')
			# Whoops!
		@else
			# Hola!
		@endif
	@endif

	{{-- Intro Lines --}}
	@foreach ($introLines as $line)
		{{ $line }}

	@endforeach

	{{-- Action Button --}}
	@if (isset($actionText))
		<?php
		switch ($level)
		{
			case 'success':
				$color = 'green';
				break;
			case 'error':
				$color = 'red';
				break;
			default:
				$color = 'blue';
		}
		?>
		@component('mail::button', ['url' => $actionUrl, 'color' => $color])
			{{ $actionText }}
		@endcomponent
	@endif

	{{-- Outro Lines --}}
	@foreach ($outroLines as $line)
		{{ $line }}

	@endforeach

	<!-- Salutation -->
	@if (! empty($salutation))
		{{ $salutation }}
	@else
		Saludos,<br>{{ config('app.name') }}
	@endif

	<!-- Subcopy -->
	@if (isset($actionText))
		@component('mail::subcopy')
			Si tienes problemas para hacer clic en "{{ $actionText }}" Botón, copia y pega la URL a continuación
			En su navegador web: [{{ $actionUrl }}]({{ $actionUrl }}) "<a href="http://sistemasamigables.com">Sistemas Amigables de Costa Rica</a>"
		@endcomponent
	@endif
@endcomponent
