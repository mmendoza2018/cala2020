@component('mail::message')
# Verifica tu dirección de correo electrónico

Gracias por registrarte en {{ config('app.name') }}. Haz clic en el botón a continuación para verificar tu correo electrónico.

@component('mail::button', ['url' => $url])
Verificar correo
@endcomponent

Si no solicitaste una cuenta, ignora este mensaje.

Saludos,<br>
{{ config('app.name') }}

@endcomponent
