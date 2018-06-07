{{--
  -- 400 error page
  --
  --}}
  @extends('layouts.app')

  @section('breadcrum')
  <li class="is-active"><a href="#" aria-current="page">Erreur 404</a></li>
  @endsection

  @section('content')

  <div class="section homepage">
      <div class="container">
          <div class="columns is-centered">
              <div class="column is-narrow">
                  <h1 class="title is-1">- 400 -</h1>
              </div>
          </div>
          <div class="columns is-centered">
              <div class="column is-narrow">
                  <h2 class="title is-3">Requète non valide</h2>
              </div>
          </div>
      </div>
  </div>

  @endsection
