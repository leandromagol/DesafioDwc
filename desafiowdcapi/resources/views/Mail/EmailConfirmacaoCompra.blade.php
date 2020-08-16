@component('mail::message')
<h1>Obrigado por compar nosso produto,clique no botão a baixo e preencha o formulario com os dados para que possamos fazer o envio do seu brinde</h1>
{{ env('MAIL_FROM_ADDRESS') }}
@component('mail::button',['url'=>(config('app.client_url').'form/'.$token),'color' => 'success'])
Receber meu brinde
@endcomponent
@endcomponent