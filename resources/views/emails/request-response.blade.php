<h1>Respuesta a tu Solicitud</h1>
<p>Hola {{ $user->name }},</p>
<p>Tu solicitud para ser organizador de rifas ha sido {{ $status == 'approved' ? 'aprobada' : 'rechazada' }}.</p>
@if ($status == 'approved')
    <p>Ahora puedes organizar rifas en nuestra plataforma.</p>
@else
    <p>Lamentamos informarte que tu solicitud fue rechazada.</p>
@endif
<p>Gracias por tu interés en Todo Rifas.</p>
