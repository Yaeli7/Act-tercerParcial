@extends('layouts.app')
@section('content')
<div class="container">

    <form action="/ProductosC" method="POST" enctype="multipart/form-data">
    @csrf
    @include('ProductosC.formularios',['modo'=>'Registrar'])
    </form>

</div>
@endsection