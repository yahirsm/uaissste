<?php $__env->startComponent('mail::message'); ?>
# Bienvenido a la aplicación de la Unidad de Abastos del ISSSTE
UAISSSTE

Se han creado tus credenciales de acceso:

- **Usuario:** `<?php echo new \Illuminate\Support\EncodedHtmlString($username); ?>`
- **Contraseña:** `<?php echo new \Illuminate\Support\EncodedHtmlString($passwordPlain); ?>`

<?php $__env->startComponent('mail::button', ['url' => route('login')]); ?>
Iniciar Sesión
<?php echo $__env->renderComponent(); ?>

No olvides anotar tu contraseña en un lugar seguro, y en caso de olvidarla contacta al equipo de Informatica

Gracias,<br>
ISSSTE
HOSPITAL REGIONAL BENITO JUAREZ
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/emails/credentials.blade.php ENDPATH**/ ?>