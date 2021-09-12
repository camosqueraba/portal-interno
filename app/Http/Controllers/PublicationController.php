<?php

namespace App\Http\Controllers; 

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Photo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $datos = Publication::orderBy('created_at', 'desc')->get();
        
        //$publications = Publication::latest()->paginate(5);


        return view('publication.index',compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('publication.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $datos_publicacion = $request->except('_token');

        
        $imagen = $request->file('imagen');
        $documento = $request->file('documento');
        $video = $request->file('video');
        
        

        // $validatedData = $request->validate([

        //     'imagen' => 'image|mimes:jpg,png,jpeg,gif,svg|max:6144',
        //     'video' => 'mimes:mp4,mov,ogg,qt|max:204800',
        //     'documento' => 'mimes:txt,doc,docx,xls,xlsx,pdf|max:20480',
        // ]);

        $request->validate([

            'titulo' => 'required|max:105',
            'descripcion' => 'required|max:255',
            'imagen' => 'image|mimes:jpg,png,jpeg,gif,svg|max:6144',
            'video' => 'mimes:mp4,mov,ogg,qt|max:204800',
            'documento' => 'mimes:txt,doc,docx,xls,xlsx,pdf|max:20480',
        ]);

        if($request->hasFile('imagen')){
            
            $imagen = $request->file('imagen');
            $input  = array('imagen' => $imagen);
            $reglas = array('imagen' => 'image|mimes:jpg,png,jpeg,gif,svg|max:6144');
            $validacion = Validator::make($input,  $reglas);
            $extension = pathinfo($request->input('imagen'));
            

            if ($validacion->fails())
            {
              /*return view("mensajes.msj_rechazado")->with("msj","El tipo de archivo no es admitido  o es demasiado grande para subirlo");*/
              return redirect('publication/create')->with('mensaje_error', 'El tipo de archivo no es admitido  o es demasiado grande para subirlo.');

            }
            else 
            {
                 
                //$ruta = storage_path();
                $slug_nombre = 
                $nombre_imagen = date('Y-m-d H-i-s').'-'.Str::slug($request->input('titulo')).'.'.$imagen->guessExtension(); 
                //$ruta ='imagenes/'.date('(Y-m-d H-i-s)').'/'.$request->input('titulo').'.'.$extension;
                
                //Storage::disk('local')->put('uploads',  File::get($imagen));
                //$imagen->move($ruta, $nombre_imagen);
                //$datos_publicacion['imagen'] = request()->file('imagen')->storeAs('imagenes', $nombre_imagen);
                //$datos_publicacion['imagen'] = $ruta.'/anuncios/'.$nombre_imagen;
                $datos_publicacion['imagen'] = request()->file('imagen')->storeAs('anuncios', $nombre_imagen, 'public'); 
            } 
            
           /* if($request->hasfile('imagen')):
             $imagen         = $request->file('imagen');
             $nombreimagen   = Str::slug($request->nombre).".".$imagen->guessExtension();
             //$nombreimagen = $imagen->getClientOriginalName();
             $ruta           = public_path("img/post/");
             $imagen->move($ruta,$nombreimagen);         
             //$model->foto  = $nombreimagen; // asignar el nombre para guardar
            endif;*/
            

        }

        if($request->hasFile('documento')){
            
            $video = $request->file('documento');
            $input  = array('documento' => $imagen);
            $reglas = array('video' => 'mimes:mp4,mov,ogg,qt|max:204800',);
            $validacion = Validator::make($input,  $reglas);
            $extension = pathinfo($request->input('video'));
            

            if ($validacion->fails())
            {
              /*return view("mensajes.msj_rechazado")->with("msj","El tipo de archivo no es admitido  o es demasiado grande para subirlo");*/
              return redirect('publication/create')->with('mensaje_error', 'El tipo de archivo no es admitido  o es demasiado grande para subirlo.');

            }
            else 
            {
                 
                //$ruta = storage_path();
                $slug_nombre = 
                $nombre_documento = date('Y-m-d H-i-s').'-v-'.Str::slug($request->input('titulo')).'.'.$documento->guessExtension(); 
                //$ruta ='imagenes/'.date('(Y-m-d H-i-s)').'/'.$request->input('titulo').'.'.$extension;
                
                //Storage::disk('local')->put('uploads',  File::get($imagen));
                //$imagen->move($ruta, $nombre_imagen);
                //$datos_publicacion['imagen'] = request()->file('imagen')->storeAs('imagenes', $nombre_imagen);
                //$datos_publicacion['imagen'] = $ruta.'/anuncios/'.$nombre_imagen;
                $datos_publicacion['video'] = request()->file('documento')->storeAs('anuncios', $nombre_documento, 'public'); 
            } 
            
           /* if($request->hasfile('imagen')):
             $imagen         = $request->file('imagen');
             $nombreimagen   = Str::slug($request->nombre).".".$imagen->guessExtension();
             //$nombreimagen = $imagen->getClientOriginalName();
             $ruta           = public_path("img/post/");
             $imagen->move($ruta,$nombreimagen);         
             //$model->foto  = $nombreimagen; // asignar el nombre para guardar
            endif;*/
            

           // $datos_publicacion['video'] = request()->file('video')->store('uploads', 'public');

        }
        if($request->hasFile('documento')){
            
            $video = $request->file('documento');
            $input  = array('documento' => $documento);
            $reglas = array('video' => 'mimes:mp4,mov,ogg,qt|max:204800',);
            $validacion = Validator::make($input,  $reglas);
            //$extension = pathinfo($request->input('documento'));
            

            if ($validacion->fails())
            {
              /*return view("mensajes.msj_rechazado")->with("msj","El tipo de archivo no es admitido  o es demasiado grande para subirlo");*/
              return redirect('publication/create')->with('mensaje_error', 'El tipo de archivo no es admitido  o es demasiado grande para subirlo.');

            }
            else 
            {
                 
                //$ruta = storage_path();
                $slug_nombre = 
                $nombre_documento = date('Y-m-d').'-'.Str::slug($request->input('titulo')).'.'.$documento->guessExtension(); 
                //$ruta ='imagenes/'.date('(Y-m-d H-i-s)').'/'.$request->input('titulo').'.'.$extension;
                
                //Storage::disk('local')->put('uploads',  File::get($imagen));
                //$imagen->move($ruta, $nombre_imagen);
                //$datos_publicacion['imagen'] = request()->file('imagen')->storeAs('imagenes', $nombre_imagen);
                //$datos_publicacion['imagen'] = $ruta.'/anuncios/'.$nombre_imagen;
                $datos_publicacion['documento'] = request()->file('documento')->storeAs('documentos', $nombre_documento, 'public'); 
            } 
            
           /* if($request->hasfile('imagen')):
             $imagen         = $request->file('imagen');
             $nombreimagen   = Str::slug($request->nombre).".".$imagen->guessExtension();
             //$nombreimagen = $imagen->getClientOriginalName();
             $ruta           = public_path("img/post/");
             $imagen->move($ruta,$nombreimagen);         
             //$model->foto  = $nombreimagen; // asignar el nombre para guardar
            endif;*/
            

           // $datos_publicacion['video'] = request()->file('video')->store('uploads', 'public');


            //$datos_publicacion['documento'] = request()->file('documento')->store('uploads', 'public');

        }
        //Publication::insert($datos_publicacion);
        Publication::create($datos_publicacion);
        //return response()->json($datos_publicacion);

        return redirect('publication')->with('mensaje_de_creado', 'Publicación creada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $anuncio = Publication::select('titulo','descripcion', 'contenido','imagen','link', 'created_at', 'usuario_nombre')->where('id', $id)->first();
        return view('principal.anuncios.anuncio-detalle', compact('anuncio'));
        //return response()->json($anuncio);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $publication = Publication::findOrFail($id);
        return view('publication.edit', compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return view('publication.index',compact('datos'));

        $datos_publicacion = $request->except(['_token', '_method']); 

        if($request->hasFile('imagen')){
            $publication = Publication::findOrFail($id);

            Storage::delete('public/'.$publication->imagen);

            $validatedData = $request->validate([
                'imagen' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:6144',

            ]);

            $datos_publicacion['imagen'] = request()->file('imagen')->store('uploads', 'public');


        }
        Publication::where('id', '=', $id)->update($datos_publicacion);

        $publication = Publication::findOrFail($id);
        //return view('publication.edit', compact('publication'));
        //$datos = Publication::paginate(5);
        return redirect('publication')->with('mensaje_de_editado','Publicación editada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Publication::destroy($id);

        return redirect('publication')->with('mensaje_de_borrado','Publicación borrada');
    }
}
