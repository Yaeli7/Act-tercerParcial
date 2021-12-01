@extends('layouts.app')
@section('content')

<div class="container">

    
    @if(Session::has('mensaje')) 
        <div class="alert alert-success alert-dismissible" role="alert">          
            <i class="fas fa-check-circle"></i> 
               
                {{Session::get('mensaje')}}           
            
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif  
  

    <a href="{{url('ProductosC/create')}}" class="btn btn-success mb-5"><i class="fas fa-plus"></i></a>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Categoria</th>
                <th>Stock</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $produc)
            <tr>
                <td>{{$produc->id}}</td>
                <td>{{$produc->Producto}}</td>
                <td>{{$produc->Categoria}}</td>
                <td>{{$produc->Stock}}</td>
                <td>{{$produc->Precio}}</td>
                <td>
                    <img src="{{asset('storage').'/'.$produc->foto}}"  width="100" alt="">
                </td>


                <td>
                    <a href="{{url('/ProductosC/'.$produc->id.'/edit')}}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>


                    <form action="{{url('/ProductosC/'.$produc->id)}}" method="post" class="d-inline">
                    @csrf
                    {{method_field('DELETE')}}
                        <input class="btn btn-danger boton" type="submit" onclick="return 
                        confirm('¿Estas seguro de que quiere eliminar el elemento?')"
                        value="Delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection