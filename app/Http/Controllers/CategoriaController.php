<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categorias = Categoria::all();
        return view('categoria.index')->with ('categorias',$categorias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('categoria.create');
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
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        // script para subir la imagen
        if($request->hasFile("imagen")){

            $imagen = $request->file("imagen");
            //$nombreimagen = Str::slug($request->nombre).".".$imagen->guessExtension();
            //$ruta = public_path("img\categoria");


                   

             $imagen         = $request->file('imagen');
             $nombreimagen = $imagen->getClientOriginalName();
             $ruta           = public_path("images/categoria/");
             $imagen->move($ruta,$nombreimagen);
             $categoria->imagen = $nombreimagen;        
 //$model->foto  = $nombreimagen; // asignar el nombre para guardar
    
            
        }
        $categoria->save();

        return redirect('/categorias');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $categoria = Categoria::find($id);
        $file=$categoria->imagen;
        $image_path = "images/categoria/".$file;
        if (File::exists($image_path)){
            File::delete($image_path);
        }        
        $categoria->delete();

        return redirect('/categorias');
    }
}
