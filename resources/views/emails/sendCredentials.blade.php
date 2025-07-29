<h2>¡Bienvenido a tu nueva tienda!</h2>

<p>Tu tienda ya está lista y estos son tus accesos:</p>

<ul>
    <li><strong>Correo:</strong> {{ $email }}</li>
    <li><strong>Contraseña:</strong> {{ $password }}</li>
    <li><strong>Panel de administración:</strong> <a href="{{ $panelUrl }}">{{ $panelUrl }}</a></li>
</ul>

<p>Por seguridad, te recomendamos cambiar tu contraseña en el primer inicio de sesión.</p>

<p>Gracias por confiar en nosotros.</p>
