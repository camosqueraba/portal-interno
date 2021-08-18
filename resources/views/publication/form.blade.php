<input id="tipo" type="hidden" class="form-control @error('tipo') is-invalid @enderror" name="tipo" value ="anuncio" required autocomplete="tipo" autofocus>

<input id="usuario_nombre" type="hidden" class="form-control @error('tipo') is-invalid @enderror" name="usuario_nombre" value="{{Auth::user()->username}}" required autocomplete="tipo" autofocus>


<div class="form-group row">
    <label for="titulo" class="col-md-4 col-form-label text-md-right">{{ __('Titulo') }}</label>

    <div class="col-md-6"> 
        <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{isset($publication->titulo)?$publication->titulo:old('titulo')}}" required autocomplete="titulo" autofocus>

        @error('titulo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

    <div class="col-md-6">
        <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ isset($publication->descripcion)?$publication->descripcion:old('descripcion') }}" required autocomplete="descripcion" autofocus>

        @error('descripcion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="contenido" class="col-md-4 col-form-label text-md-right">{{ __('Contenido') }}</label>

    <div class="col-md-6">
      

        <textarea id="contenido" type="text" class="form-control" @error('contenido') is-invalid @enderror name="contenido" autocomplete="contenido">{{isset($publication->contenido)?$publication->contenido:old('contenido')}}</textarea>

        @error('contenido')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="imagen" class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>
    @if (@isset($publication->imagen))
        <img class="col-md-3"src="{{asset('storage').'/'.$publication->imagen}}" width="100" alt="$publication->imagen">
        <div class="col-md-3">
            <input id="imagen" type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen"  autocomplete="">
            <small class="form-text text-muted">Admitidos jpg, png, jpeg, gif maximo 6Mb</small>
            @error('imagen')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    @else
        <div class="col-md-6">
            <input id="imagen" type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen"  autocomplete="">
            <small class="form-text text-muted">Admitidos jpg, png, jpeg, gif maximo 6Mb</small>
            @error('imagen')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    @endif    

    

        
</div>

<div class="form-group row">
    <label for="video" class="col-md-4 col-form-label text-md-right">{{ __('Video') }}</label>
   

    <div class="col-md-6">

        <input id="video" type="file" class="form-control @error('video') is-invalid @enderror" name="video"  autocomplete="video">
        <small class="form-text text-muted">Admitidos MP4 maximo 200Mb</small>
        @if (@isset($publication->video))
        <small class="form-text text-muted">
            <strong>Actual </strong> {{ $publication->video}}
        </small>
        @endif
        @error('video')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
   
  
</div>

<div class="form-group row">
    <label for="documento" class="col-md-4 col-form-label text-md-right">{{__('Documento')}}
    </label>
    <div class="col-md-6">
        <input id="documento" type="file" class="form-control @error('documento') is-invalid @enderror" name="documento"  autocomplete="video">
        <small class="form-text text-muted">Admitidos excel, word, pdf y txt maximo 20Mb</small>
        @if (@isset($publication->documento))
        <small class="form-text text-muted"><strong>Actual</strong> {{ $publication->documento}}</small>
        @endif
        @error('documento')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        
    </div>
    
</div>



<div class="form-group row">
    <label for="link" class="col-md-4 col-form-label text-md-right">{{ __('Enlace Externo') }}</label>

    <div class="col-md-6">
        <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ isset($publication->link)?$publication->link:old('link') }}"  autocomplete="link">

        @error('link')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="fecha_inicio" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Inicio') }}</label>

    <div class="col-md-6">
        <input id="fecha_inicio" type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio" value="{{ isset($publication->fecha_inicio)?$publication->fecha_inicio:old('fecha_inicio') }}" required autocomplete="fecha_inicio">

        @error('fecha_inicio')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

    <div class="form-group row">
    <label for="fecha_fin" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Fin') }}</label>

    <div class="col-md-6">
        <input id="fecha_fin" type="date" class="form-control @error('fecha_fin') is-invalid @enderror" name="fecha_fin" value="{{ isset($publication->fecha_fin)?$publication->fecha_fin:old('fecha_fin') }}" required autocomplete="fecha_fin">

        @error('fecha_fin')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="form-group row mb-0">
    <div class="col-md-4"></div>

    <div class="col-md-2">
        <button type="submit" class="btn btn-primary" >
            {{ __('Publicar') }}
        </button>
    </div>
      <div class="col-md-2">
        <a class="btn btn-success" href="{{url('publication')}}">
            {{ __('Regresar') }}
        </a>
    </div>
</div>

@section('ck_editor')

{{-- <script type="text/javascript">
    /* $(document).ready(function () {
        $('#contenido').ckeditor();
    }); */

    ClassicEditor
        .create(document.querySelector('#contenido'))
        .catch(error => {
            console.error(error);
        }); --}}

<script>ClassicEditor
.create( document.querySelector( '#contenido' ),
{

	toolbar:
    {
		items: [
			'heading',
			'fontSize',
			'bold',
			'alignment',
			'link',
			'bulletedList',
			'numberedList',
			'|',
			'outdent',
			'indent',
			'|',
			'blockQuote',
			'insertTable'
		]
	},
	language: 'es',
	table:
    {
		contentToolbar: [
			'tableColumn',
			'tableRow',
			'mergeTableCells'
		]
	},
	licenseKey: '',

    link:
     {
        // Automatically add target="_blank" and rel="noopener noreferrer" to all external links.
        addTargetToExternalLinks: true,

        // Let the users control the "download" attribute of each link.
        decorators:
        [
            {
                mode: 'manual',
                label: 'Downloadable',
                attributes: 
                {
                    download: 'download'
                }
            }
        ],
        defaultProtocol: 'http://'
    }
} )
.then( editor => {
	window.editor = editor;
} )
.catch( error => {
	console.error( 'Oops, something went wrong!' );
	console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
	console.warn( 'Build id: v707c69mzyuh-h11itm18cy0z' );
	console.error( error ); 
} );




</script>


@endsection
