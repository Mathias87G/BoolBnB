@extends('layouts.authlayout')
@section('content')

<div class="container show-house">

  {{-- row-casa --}}

    <div class="row">

      {{-- card casa --}}

        <div class="card card-show">
          {{-- Immagine casa --}}
          <div class="row">
            <div class="img-show-ctr card-img-top col-12 col-md-6 d-flex justify-content-center">
              <img id="img-show" src="{{Str::startsWith($house->img, 'http') ? $house->img : Storage::url($house->img)}}" alt="{{$house->title}}" alt="{{$house->title}}">
            </div>

          {{-- Titolo e descrizione casa --}}
          <div class="card-body col-12 col-md-6 pt-0">
            <div class="house-main-text">
              <h4 class="card-title title-show">{{$house->title}}</h4>
              <p class="card-text">{{ $house->description }}</p>
            </div>

            {{-- Dettagli casa --}}
            <div class="house-details d-flex">
                <div class="card-text house-det">
                  <i class="fas fa-home"></i> stanze: {{ $house->rooms }}  
                </div>
                <div class="card-text house-det">
                  <i class="fas fa-bed"></i> letti: {{ $house->beds }}  
                </div>
                <div class="card-text house-det">
                  <i class="fas fa-toilet"></i> bagni: {{ $house->bathrooms }}
                </div>
            </div>

            {{-- servizi --}}
            <h5 class="service-title pl-2">Servizi offerti</h5>
            <ul class="list-group service-show col-12">
              @forelse ($house->services as $service)
                <li class="pl-0 mt-2 col-6">
                  @if ($service->name == 'Wi-Fi')
                    <i class="fas fa-wifi"></i>
                  @elseif ($service->name == 'Posto Macchina')
                    <i class="fas fa-parking"></i>
                  @elseif ($service->name == 'Piscina')
                    <i class="fas fa-swimming-pool"></i>
                  @elseif ($service->name == 'Portineria')
                    <i class="fas fa-door-open"></i>
                  @elseif ($service->name == 'Sauna')
                    <i class="fas fa-hot-tub"></i>
                  @elseif ($service->name == 'Vista mare')
                    <i class="fas fa-umbrella-beach"></i>
                  @endif
                  {{ $service->name }}</li>
              @empty
                <p class="mt-2">Nessun Servizio offerto</p>
              @endforelse
            </ul>
            <div class="price-show pr-4 pt-4 d-flex justify-content-end">
              <h5 class="price-details-show pr-2">{{ $house->price }}€ </h5>
              <span> a notte</span>
            </div>
          </div>
         </div>
        </div>
    </div>  

    {{-- row-mappe-domande --}}
    <div class="row">

      {{-- mappa --}}
      <div class="col-12 col-md-6 pl-3 pr-1 maps d-flex justify-content-center">
        <div id="map"></div>
      </div>  

      <div class="col-12 col-md-6 messages">

        {{-- Form messaggi se non sei loggato o non sei l'utente proprietario--}}

        @if (!Auth::check() || Auth::user()->id != $house->user_id)
          <form action="{{route('messages.store')}}" method="POST">
            @csrf
            @method('POST')
            <h5 class="message-title">Invia una domanda al proprietario</h5>
              <div class="form-group">
                <input type="hidden" class="form-control" id="house_id"  value="{{$house->id}}" name="house_id" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="sender_mail" value="{{Auth::check() ? Auth::user()->email : ''}}" name="sender_mail" required>
              </div>
                <div class="form-group">
                  <label for="object">Oggetto</label>
                  <input type="text" class="form-control" id="object" name="object" required>
                </div>
                <div class="form-group">
                  <label for="body">Domanda</label>
                  <textarea class="form-control" id="body" rows="6" name="body" required></textarea>
                </div>
                <button id="send-btn" type="submit" class="btn float-right mt-3 btn-white">Invia la tua domanda</button>
          </form>
        @endif

        {{--Sezione sponsor se l'utente autenticato è proprietario della casa --}}
        @auth
          @if (Auth::user()->id == $house->user_id)
          {{-- Immagine sponsor --}}
          <img id="sponsor-img" src="{{ asset('/images/sponsor.jpg') }}" alt="">
          <div class="sponsor-show-text">
            <h5>Metti in evidenza il tuo annuncio</h5>
            <p>Scegli uno dei nostri abbonamenti e il tuo annuncio sarà evidenziato nelle ricerche dei nostri utenti.</p>
          </div>
          <a href="{{route('sponsor.create', $house->id)}}" class="btn btn-white col-12">Sponsorizza la tua casa</a>
          @endif
        @endauth
      </div>  
    </div>  
    
    {{-- Script per la mappa (da mettere poi in app.js) --}}
    <script>
      var markerCoord = [{{$house->long}}, {{$house->lat}}];

      var map = tt.map({
          key: "oCyOS44obJmw9yb7z97dzeeAUwNmVWMq",
          container: "map",
          style: "tomtom://vector/1/basic-main",
          center: markerCoord,
          zoom: 12
      });

      var nav = new tt.NavigationControl({});
      map.addControl(nav, 'top-right');

      var marker = new tt.Marker()
      .setLngLat(markerCoord)
      .addTo(map);
      
    </script>

    </div>

</div>
@endsection
