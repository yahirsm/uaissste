{{-- resources/views/distribucion/pedidos/index.blade.php --}}
<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-4 pt-20">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold text-red-700 mb-4">
                <i class="fas fa-truck mr-2"></i> Pedidos Realizados
            </h2>

            {{-- Alertas de sesión --}}
            @if (session('success'))
                <div class="flex items-center bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 20 20"><path d="M10 15a1.5 1.5 0 11-.001-2.999A1.5 1.5 0 0110 15zm1-9h-2v6h2V6z"/></svg>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="flex items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 20 20"><path d="M10 15a1.5 1.5 0 11-.001-2.999A1.5 1.5 0 0110 15zm1-9h-2v6h2V6z"/></svg>
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border">Fecha</th>
                            <th class="px-4 py-2 border">Solicita</th>
                            <th class="px-4 py-2 border">Área</th>
                            <th class="px-4 py-2 border">Estado</th>
                            <th class="px-4 py-2 border">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pedidos as $p)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2">{{ $p->id }}</td>
                                <td class="border px-4 py-2">{{ $p->created_at->format('d/m/Y H:i') }}</td>
                                <td class="border px-4 py-2">{{ $p->user->name }}</td>
                                <td class="border px-4 py-2">{{ $p->servicio->nombre }}</td>
                                <td class="border px-4 py-2">
                                    @if($p->atendido)
                                        <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded">
                                            Atendido
                                        </span>
                                    @else
                                        <span class="inline-block px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded">
                                            Pendiente
                                        </span>
                                    @endif
                                </td>
                                <td class="border px-4 py-2 space-x-2">
                                    {{-- Ver detalles --}}
                                    <a href="{{ route('distribucion.pedidos.show', $p) }}"
                                       class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                        <i class="fas fa-eye mr-1"></i> Ver
                                    </a>

                                    {{-- Autorizar (solo para quienes tengan permiso) --}}
                                    @can('solicitudes.aprobar')
                                        @unless($p->atendido)
                                            <form action="{{ route('distribucion.pedidos.autorizar', $p) }}"
                                                  method="POST"
                                                  class="inline-block js-autorizar-form">
                                                @csrf
                                                <button type="submit"
                                                        class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded js-autorizar-btn">
                                                    <i class="fas fa-check mr-1"></i> Autorizar
                                                </button>
                                            </form>
                                        @endunless
                                    @endcan

                                    {{-- Descargar PDF --}}
                                    <a href="{{ route('distribucion.pedidos.pdf', $p) }}"
                                       class="inline-flex items-center bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">
                                        <i class="fas fa-download mr-1"></i> PDF
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border px-4 py-6 text-center text-gray-700">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    No has realizado ningún pedido aún.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="mt-4">
                {{ $pedidos->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.js-autorizar-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: '¿Autorizar pedido?',
                    text: 'Se generará el movimiento de salida y se descontará del stock.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, autorizar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true,
                    focusCancel: true,
                    customClass: {
                        confirmButton: 'bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded',
                        cancelButton: 'bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded'
                    },
                    buttonsStyling: false
                }).then(result => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
    </script>
</x-app-layout>
