@extends('layouts.authlayout')
@section('content')

<div class="container create">

    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
          <p>{{$error}}</p>
        @endforeach
    </div>
    @endif
    
    {{-- Form Creazione --}}

    <form action="{{route('houses.store')}}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('POST')

            {{-- Titolo e indirizzo --}}

            <div class="row">
                <div class="form-group pt-2 col-9">
                    <label for="title">Titolo</label>
                    <input  type="text" class="form-control" id="title" name="title">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-9">
                    <label for="address">Indirizzo</label>
                    <input type="text" class="form-control" id="address" name="address">
        
                    <input type="hidden" id="lat" name="lat" value="">
                    <input type="hidden" id="long" name="long" value="">
                </div>
            </div>

            {{-- Stanze, letti, bagni, mq e prezzo --}}

            <div class="row">
                <div class="form-group col-md-2 col-sm-2 col-4 mr-1">
                    <label for="rooms">Stanze</label>
                    <input type="number" min="1" class="form-control" id="rooms" name="rooms" value="rooms">
                </div>
    
                <div class="form-group col-md-2 col-sm-3 col-4 mr-1">
                    <label for="beds">Posti Letto</label>
                    <input type="number" min="1" class="form-control" id="beds" name="beds" value="beds">
                </div>
    
                <div class="form-group col-md-2 col-sm-2 col-4 mr-1">
                    <label for="bathrooms">Bagni</label>
                    <input type="number" min="1" class="form-control" id="bathrooms" name="bathrooms" value="bathrooms">
                </div>
            
                <div class="form-group col-md-2 col-sm-2 col-4 mr-1">
                    <label for="size">Dimensioni</label>
                    <input type="number" min="1"class="form-control" id="size" name="size" placeholder="m²">
                </div>
    
                <div class="form-group col-md-2 col-sm-3 col-4 mr-1">
                    <label for="price">Prezzo</label>
                    <input type="number" min="1" class="form-control" id="price" name="price" placeholder="Euro">
                </div>
            </div>   

            {{-- Descrizione --}}

            <div class="row">
                <div class="form-group col-9">
                    <label for="description">Descrizione</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
            </div>

            {{-- Servizi --}}

            <div class="row">
                <div class="form-group col-12 d-flex flex-wrap">
                    @foreach ($services as $service)
                        <div class="pr-2 pl-0">
                            <label class="pr-2" for="{{$service->name}}">{{$service->name}}</label>
                            <input type="checkbox" class="mr-4" id="{{$service->name}}" name='services[]' value="{{$service->id}}">
                        </div>    
                    @endforeach
                </div>
            </div>

            <div class="row">
                {{-- Immagine --}}
                <div class="form-group col-12 bg-none">
                    <label for="img" style="display: block; text-align: left">Aggiungi foto della casa</label>
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" class="previewImg" alt="Placeholder" style="object-fit: cover">
                    <input type="file" accept="image/*" class="form-control text-light" id="img-create" name="img">
                </div>

            </div>

            <button type="submit" id="create-house" class="btn btn-white">Crea annuncio</button>

    </form>

</div>   


@endsection