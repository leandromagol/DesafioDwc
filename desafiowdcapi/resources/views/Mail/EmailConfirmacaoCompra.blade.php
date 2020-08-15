@component('mail::message')
<h1>Confimação de compra do curso 1</h1>
{{ $email }}
@component('mail::button',['url'=>url('/')])
Confirmar Minha compra

@endcomponent
@endcomponent