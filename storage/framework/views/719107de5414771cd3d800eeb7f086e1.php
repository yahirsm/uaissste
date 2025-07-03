<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud de Material #<?php echo e($solicitud->id); ?></title>
    <style>
        /* Solo para impresión */
        @media print {
            /* Resetea márgenes del navegador */
            @page { margin: 0; }
            body { margin: 0; padding: 0; }

            /* Header fijo */
            header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 140px;
                text-align: center;
                padding-top: 10px;
                border-bottom: 2px solid #800000;
            }

            /* Footer fijo */
            footer {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 50px;
                text-align: center;
                font-size: 10px;
                color: #666;
                border-top: 1px solid #ddd;
            }

            /* Contenido descansa entre header y footer */
            .content {
                margin: 160px 20px 70px 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                page-break-inside: auto;
            }
            th, td {
                border: 1px solid #000;
                padding: 5px;
            }
            th {
                background-color: #800000;
                color: #fff;
            }
            thead { display: table-header-group; }
            tr { page-break-inside: avoid; }
        }
    </style>
</head>
<body onload="window.print()">

    <?php
        \Carbon\Carbon::setLocale('es');
        $hoy = \Carbon\Carbon::now()->translatedFormat('l j \d\e F \d\e\l Y');
    ?>

    <header>
        <img src="<?php echo e(asset('images/Logo.svg')); ?>" alt="Logo ISSSTE" width="80">
        <h2 style="color:#800000; margin:5px 0;">SOLICITUD DE MATERIAL #<?php echo e($solicitud->id); ?></h2>
        <p style="margin:2px 0;">
            <strong>Fecha:</strong> <?php echo e($solicitud->created_at->format('d/m/Y H:i')); ?>

            &nbsp;|&nbsp;
            <strong>Solicita:</strong> <?php echo e($solicitud->user->name); ?>

            &nbsp;|&nbsp;
            <strong>Área:</strong> <?php echo e($solicitud->servicio->nombre); ?>

        </p>
    </header>

    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Descripción</th>
                    <th style="text-align:center;">Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $solicitud->materiales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($m->clave); ?></td>
                        <td><?php echo e($m->descripcion); ?></td>
                        <td style="text-align:center;"><?php echo e($m->pivot->cantidad); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <footer>
        Hospital Regional Presidente Benito Juárez del ISSSTE – Unidad de Abasto<br>
        Página <script>document.write(window.location.href.includes('nbpg')? '{nbpg}':'') </script>
    </footer>

</body>
</html>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/distribucion/pedidos/show.blade.php ENDPATH**/ ?>