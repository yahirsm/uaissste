@component('mail::message')
# Bienvenido a la aplicación de la Unidad de Abasto del ISSSTE
UAISSSTE

Se han creado tus credenciales de acceso:

- **Usuario:** `{{ $username }}`
- **Contraseña:** `{{ $passwordPlain }}`

@component('mail::button', ['url' => route('login')])
Iniciar Sesión
@endcomponent

No olvides anotar tu contraseña en un lugar seguro, y en caso de olvidarla contacta al equipo de Informatica

Gracias,<br>
ISSSTE<br>
HOSPITAL REGIONAL BENITO JUAREZ
@endcomponent
