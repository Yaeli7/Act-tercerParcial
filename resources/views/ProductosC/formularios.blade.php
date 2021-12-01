
    <h1>{{$modo}} datos</h1>

    

    @if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
               <li>  {{$error}} </li>
            @endforeach
        </ul>
    </div>
       
    @endif

    <div class="form-group">
        <label for="Producto">Producto</label>
        <input type="text" class="form-control" name="Producto" value="{{isset($productos->Producto)?$productos->Producto:old('Producto') }}" id="Producto">
    </div>

    <div class="form-group">
        <label for="Categoria">Categoria</label>
        <input type="text" class="form-control" name="Categoria" value="{{isset($productos->Categoria)?$productos->Categoria:old('Categoria') }}" id="Categoria">
    </div>

    <div class="form-group">
        <label for="Stock">Stock</label>
        <input type="text" class="form-control" name="Stock" value="{{isset($productos->Stock)?$productos->Stock:old('Stock') }}" id="Stock">
    </div>

    <div class="form-group">
        <label for="Precio">Precio</label>
        <input type="text" class="form-control" name="Precio" value="{{isset($productos->Precio)?$productos->Precio:old('Precio') }}" id="Precio">
    </div>

    <div class="form-group">
        
        @if(isset($productos->foto))
        <img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$productos->foto}}" width="100" alt="">
        @endif
        <input type="file" class="form-control" name="foto" value="" id="foto">
    </div>

    <input class="btn btn-success" type="submit" value="{{$modo}}">
    <br>
    <a href="{{url('ProductosC')}}" class="btn btn-primary mt-3"><i class="fas fa-long-arrow-alt-left"></i></a>