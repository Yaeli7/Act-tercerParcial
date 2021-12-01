<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['productos']=Productos::paginate(5);
        return view('ProductosC.Index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ProductosC.Registrar');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validacion = [
            'Producto'=>'required|string|max:100',
            'Categoria'=>'required|string|max:100',
            'Stock'=>'required|string|max:100',
            'Precio'=>'required|string|max:100',
            'foto'=>'required|max:10000|mimes:jpeg,png,jpg'
        ];

        $aviso = [
            'required'=>'El :attribute es requerido',
            'Categoria.required'=>'La categoria es requerida',
            'foto.required'=>'La foto es requerida'
        ];

        $this->validate($request, $validacion, $aviso);

        $datosProducto = request()->except('_token');
        
        if($request->hasFile('foto')){

            $datosProducto['foto']=$request->file('foto')->store('uploads','public');
        }
        Productos::insert($datosProducto);

       // return response()->json($datosProducto);

       return redirect('ProductosC')->with('mensaje','Producto registrado exitosamente');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $productos = Productos::findOrFail($id);
        return view('ProductosC.editar', compact('productos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validacion = [
            'Producto'=>'required|string|max:100',
            'Categoria'=>'required|string|max:100',
            'Stock'=>'required|string|max:100',
            'Precio'=>'required|string|max:100',
            
        ];

        $aviso = [
            'required'=>'El :attribute es requerido',
            'Categoria.required'=>'La categoria es requerida'
        ];

        if($request->hasFile('foto')){
            
            $validacion=['foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $aviso = ['foto.required'=>'La foto es requerida'];
        }
        $this->validate($request, $validacion, $aviso);

        $datosProducto = request()->except(['_token','_method']);

        if($request->hasFile('foto')){
            $productos = Productos::findOrFail($id);
            Storage::delete('public/'.$productos->foto);
            $datosProducto['foto']=$request->file('foto')->store('uploads','public');
        }

        Productos::where('id','=',$id)->update($datosProducto);

        $productos = Productos::findOrFail($id);
        //return view('ProductosC.editar', compact('productos'));
        return redirect('ProductosC')->with('mensaje','Registro editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $productos = Productos::findOrFail($id);

        if(Storage::delete('public/'.$productos->foto)){
            Productos::destroy($id);
        }       
        return redirect('ProductosC')->with('mensaje','Registro eliminado');
    }
}
