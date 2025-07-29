<x-guest-layout>
  <div
    class="w-full max-w-md p-8
           bg-yellow-50 bg-opacity-60 backdrop-blur-sm
           rounded-lg border-2 border-yellow-600
           shadow-lg space-y-6"
  >
    {{-- Logo --}}
    <div class="text-center mb-4">
      <img src="{{ asset('images/logo.svg') }}"
           alt="ISSSTE Logo"
           class="mx-auto w-40 h-auto"/>
    </div>

    {{-- Error servidor --}}
    @if(session('error'))
      <div class="px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded flex justify-between items-center">
        <div>
          <strong>¡Error!</strong> {{ session('error') }}
        </div>
        <button type="button" onclick="closeAlert()">
          <i class="fas fa-times text-red-700 hover:text-red-500"></i>
        </button>
      </div>
    @endif

    {{-- Alerta JS --}}
    <div id="formAlert" class="hidden px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded flex justify-between items-center">
      <div>
        <strong>¡Error!</strong> <span id="alertMessage"></span>
      </div>
      <button type="button" onclick="closeFormAlert()">
        <i class="fas fa-times text-red-700 hover:text-red-500"></i>
      </button>
    </div>

    {{-- Formulario --}}
    <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-4">
      @csrf

      {{-- Usuario --}}
      <div class="relative">
        <x-label for="username" value="Usuario" />
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
          <i class="fas fa-user text-gray-700"></i>
        </div>
        <x-input
          id="username"
          name="username"
          type="text"
          required
          autofocus
          placeholder="ej. ramirez"
          value="{{ old('username') }}"
          class="block w-full pl-10 pr-3 py-2 border rounded focus:ring-red-700 focus:border-red-700"
        />
      </div>

      {{-- Contraseña --}}
      <div class="relative">
        <x-label for="password" value="Contraseña" />
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
          <i class="fas fa-lock text-gray-700"></i>
        </div>
        <x-input
          id="password"
          name="password"
          type="password"
          required
          placeholder="********"
          class="block w-full pl-10 pr-10 py-2 border rounded focus:ring-red-700 focus:border-red-700"
        />
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePassword()">
          <i id="eyeIcon" class="fas fa-eye text-gray-500"></i>
        </div>
      </div>

      {{-- Recuérdame --}}
      <div class="flex items-center">
        <x-checkbox id="remember_me" name="remember"/>
        <label for="remember_me" class="ml-2 text-sm text-gray-900">Recuérdame</label>
      </div>

      {{-- Botón --}}
      <div class="flex justify-end">
        <button type="submit"
                class="inline-flex items-center gap-2
                       bg-yellow-600 hover:bg-yellow-700 text-white
                       font-bold px-4 py-2 rounded-lg"
        >
          <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
        </button>
      </div>
    </form>
  </div>

  {{-- Scripts de validación y toggle --}}
  <script>
    // Prevent empty submit
    document.getElementById('loginForm').addEventListener('submit', function(e){
      e.preventDefault();
      const u = document.getElementById('username').value.trim(),
            p = document.getElementById('password').value.trim();
      if (!u||!p) {
        let m = '';
        if (!u) m += 'El usuario es obligatorio. ';
        if (!p) m += 'La contraseña es obligatoria.';
        showFormAlert(m);
      } else { this.submit(); }
    });

    // Username blur validation
    document.getElementById('username').addEventListener('blur', function(){
      const v = this.value.trim();
      if(!/^[a-zA-Z]{3,}$/.test(v)) {
        showFormAlert('El usuario solo puede contener letras y al menos 3 caracteres.');
      } else {
        closeFormAlert();
      }
    });

    // Toggle password
    function togglePassword(){
      const inp = document.getElementById('password'),
            ico = document.getElementById('eyeIcon');
      if(inp.type==='password'){
        inp.type='text';
        ico.classList.replace('fa-eye','fa-eye-slash');
      } else {
        inp.type='password';
        ico.classList.replace('fa-eye-slash','fa-eye');
      }
    }

    function showFormAlert(msg){
      const a = document.getElementById('formAlert');
      document.getElementById('alertMessage').textContent = msg;
      a.classList.remove('hidden');
    }
    function closeFormAlert(){
      document.getElementById('formAlert').classList.add('hidden');
    }
    function closeAlert(){
      const e = document.getElementById('alert');
      if(e) e.remove();
    }
  </script>
</x-guest-layout>
