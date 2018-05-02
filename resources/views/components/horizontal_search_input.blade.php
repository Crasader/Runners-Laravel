{{--
  -- Horizontal search input
  -- Allows you to easy bootstrap form inputs with search system errors and bulma styling
  --
  -- To work this field require a specific ajax route to interogates the system.
  --
  -- SEE :
  --   scss/features/search-field.scss
  --   js/features/search-field.js
  --
  -- @author Bastien Nicoud
  --}}

{{-- Inject the search field specific js in the page --}}
@push('scripts')
    <script src="{{ mix('js/features/search-field.js') }}"></script>
@endpush

<div class="field">
    <p class="autocomplete control is-expanded has-icons-left">
        <input id="search-field-{{ $name }}" data-search-api-url="{{ $apiUrl }}" class="input {{ $errors->has($name) ? ' is-danger' : '' }}"
            type="{{ $type }}"
            name="{{ $name }}"
            @if(old($name))
                value="{{ old($name) }}"
            @elseif(isset($value))
                value="{{ $value }}"
            @endif
            placeholder="{{ $placeholder }}">
        <span class="icon is-small is-left">
            <i class="fas {{ $icon }}"></i>
        </span>
        <div id="search-results-{{ $name }}"></div>
        <div class="dropdown-menu">
            <div class="dropdown-content">
                <a class="dropdown-item">Resultat de recherche 1</a>
                <a class="dropdown-item">Resultat de recherche 3</a>
                <a class="dropdown-item">Resultat de recherche 3</a>
            </div>
        </div>
    </p>
    @if ($errors->has($name))
        <p class="help is-danger">{{ $errors->first($name) }}</p>
    @endif
    {{ $slot }}
</div>