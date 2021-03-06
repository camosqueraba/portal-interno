
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre y Apellido') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{isset($usuario->name)?$usuario->name:old('name') }}" required autocomplete="name" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span> 
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de Usuario') }}</label>

    <div class="col-md-6">
        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ isset($usuario->username)?$usuario->username:old('username') }}" required autocomplete="username" autofocus>

        @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>

    <div class="col-md-6">
        <select id="rol" type="text" class="form-control @error('rol') is-invalid @enderror" name="rol" value="{{ isset($usuario->rol)?$usuario->rol:old('rol') }}" required autocomplete="rol" autofocus>
        <option value="">-- Seleccionar --</option>
            <option value="administrador">Administrador</option>
            <option value="publicador">Publicador</option>
        </select>
        @error('rol')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ isset($usuario->email)?$usuario->email:old('email') }}" required autocomplete="email">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contrase??a') }}</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  required autocomplete="new-password">

        @error('password')
            <br>
                <strong style="color: red">{{ $message }}</strong>
            <br>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirme Contrase??a') }}</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  required autocomplete="new-password">
        @error('password_confirmation')
        <br>
            <strong style="color: red">{{ $message }}</strong>
            <br>
    @enderror
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-4"></div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary">
            {{ __('Registrarse') }}
        </button>
    </div>
    <div class="col-md-2">
        <a class="btn btn-success" href="{{url('user')}}">
            {{ __('Regresar') }}
        </a>
    </div>
</div>

   

                 
              
