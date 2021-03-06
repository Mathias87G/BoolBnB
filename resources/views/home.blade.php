@extends('layouts.app')

@section('content')

    <div class="container">

      {{-- row-title --}}

      <div class="row title">

            <h2 class="col-12">Appartamenti in evidenza</h2>

      </div>

      {{-- row-view --}}

      <div class="row view position-relative">

        <div class="card-group scrollMenu col-12">

          @foreach ($houses as $house)

          <div class="card apartment mr-4 mt-4 mb-4 ombra" style="height: 500px;">
            <img class="card-img-top" src="{{Str::startsWith($house->img, 'http') ? $house->img : Storage::url($house->img)}}" alt="{{$house->title}}">
            <div class="card-body">
              <h5 class="card-title">{{$house->title}}</h5>
              <p class="card-text">{{ Str::substr($house->description, 0, 200) . "..." }}</p>
            </div>
            <div class="card-footer" style="padding: 0rem 1.25rem">
              @if (Auth::id() == $house->user_id)
                <a href="{{route('houses.show', $house->slug)}}" class="btn btn-white float-right">Dettagli</a>
                  
              @else
                <form action="{{route('view.store')}}" method="POST">
                  @csrf
                  @method('POST')
                  <input type="hidden" name="house_id" value="{{$house->id}}">
                  <input type="hidden" name="slug" value="{{$house->slug}}">
                  <button type="submit" class="btn btn-white float-right">Dettagli</button>
                </form>                
              @endif
            </div>
          </div>

          @endforeach
          
          
          
        </div>
        
          <button id="scroll-left" class="scroll position-absolute"><i class="fas fa-chevron-left"></i></button>
          <button id="scroll-right" class="scroll position-absolute"><i class="fas fa-chevron-right"></i></button>       

      </div>
      {{-- row-title --}}

      <div class="row title">

        <h2 class="col-12">Unisciti a milioni di host su Boolbnb</h2>

      </div>

      {{-- row-host --}}

      <div class="row host">

        <div class="col-12">
          
          @auth
          <a href="{{route('houses.create')}}">
            <img src="{{ asset('/images/host.jpg') }}" alt="host-img" class="ombra">
          </a>
          @endauth
          @guest
          <a href="{{ route('register') }}">
            <img src="{{ asset('/images/host.jpg') }}" alt="host-img" class="ombra">
          </a>
          @endguest
          
        </div>

      </div>

    </div>
@endsection
