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
        //
        $datos = Publication::orderBy('created_at', 'desc')->get();
        return view('publication.index',compact('datos'));
        //$publications = Publication::latest()->paginate(5);

        //return view('publication.index', compact('publications'))
         //   ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

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
        
        $datos_publicacion = $request->except('_token');

        
        // $imagen = $request->file('imagen');
        // $documento = $request->file('documento');
        // $video = $request->file('video');
        
         

        if($request->hasFile('imagen')){
            
            $imagen = $request->file('imagen');
            $input  = array('imagen' => $imagen);
            $reglas = array('imagen' => 'image|mimes:jpg,png,jpeg,gif,svg|max:6144');
            $validacion = Validator::make($input,  $reglas);
                       

            if ($validacion->fails())
            {
              
              return redirect('publication/create')->with('mensaje_error', 'El tipo de archivo no es admitido  o es demasiado grande para subirlo.');
            }
            else 
            {
                         
                $slug_nombre = Str::slug($request->input('titulo'));
                $nombre_imagen = date('Y-m-d H-i-s').'-'.$slug_nombre.'.'.$imagen->guessExtension(); 
                              
                $datos_publicacion['imagen'] = request()->file('imagen')->storeAs('anuncios', $nombre_imagen, 'public'); 
            } 
        }

        if($request->hasFile('video')){
            
            $video = $request->file('video');
            $input  = array('video' => $imagen);
            $reglas = array('video' => 'mimes:mp4,mov,ogg,qt|max:204800',);
            $validacion = Validator::make($input,  $reglas);
            $extension = pathinfo($request->input('video'));
            

            if ($validacion->fails())
            {
              
              return redirect('publication/create')->with('mensaje_error', 'El tipo de archivo no es admitido  o es demasiado grande para subirlo.');
            }
            else 
            {
                 
                
                $slug_nombre = 
                $nombre_video = date('Y-m-d H-i-s').'-v-'.Str::slug($request->input('titulo')).'.'.$video->guessExtension(); 
                
                $datos_publicacion['video'] = request()->file('video')->storeAs('anuncios', $nombre_video, 'public'); 
            } 
        }
        if($request->hasFile('documento')){
            
            $documento = $request->file('documento');
            $input  = array('documento' => $documento);
            $reglas = array('documento' => 'mimes:txt,doc,docx,xls,xlsx,pdf|max:20480');
            $validacion = Validator::make($input,  $reglas);
            
            

            if ($validacion->fails())
            {
              
              return redirect('publication/create')->with('mensaje_error', 'El tipo de archivo no es admitido  o es demasiado grande para subirlo.');
            }
            else 
            {
                
                $slug_nombre = Str::slug($request->input('titulo'));
                $nombre_documento = date('Y-m-d H-i-s').'-'.$slug_nombre.'.'.$documento->guessExtension(); 
                
                $datos_publicacion['documento'] = request()->file('documento')->storeAs('documentos', $nombre_documento, 'public'); 
            } 
            
          

        }
        //Publication::insert($datos_publicacion);
        Publication::create($datos_publicacion);
        //return response()->json($datos_publicacion);

        return redirect('publication')->with('mensaje_correcto', 'Publicación creada correctamente.');
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

        $publication = Publication::findOrFail($id);

        if($request->hasFile('imagen')){
            
            $imagen = $request->file('imagen');
            Storage::delete('public/'.$publication->imagen);
            $slug_nombre = Str::slug($request->input('titulo'));
            $nombre_imagen = date('Y-m-d H-i-s').'-'.$slug_nombre.'.'.$imagen->guessExtension(); 
            
            $validatedData = $request->validate([
                'imagen' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:6144',

            ]);

            // $datos_publicacion['imagen'] = request()->file('imagen')->store('uploads', 'public');
            $datos_publicacion['imagen'] = request()->file('imagen')->storeAs('anuncios', $nombre_imagen, 'public');
             
        }
        
        if($request->hasFile('video')){
            $publication = Publication::findOrFail($id);

            Storage::delete('public/'.$publication->video);

            $validatedData = $request->validate([
                'video' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:6144',

            ]);

            $datos_publicacion['video'] = request()->file('video')->store('uploads', 'public');
        }
        
        Publication::where('id', '=', $id)->update($datos_publicacion);

        $publication = Publication::findOrFail($id);
        //return view('publication.edit', compact('publication'));
        //$datos = Publication::paginate(5);
        return redirect('publication')->with('mensaje','Publicación editada');
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

        return redirect('publication')->with('mensaje','Publicación borrada');
    }
}
