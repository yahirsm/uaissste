<button
    <?php echo e($attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent 
                    rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-500 
                    focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 
                    active:bg-indigo-600 disabled:opacity-25 transition'
    ])); ?>

>
    <?php echo e($slot); ?>

</button>

<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/components/jet-button.blade.php ENDPATH**/ ?>