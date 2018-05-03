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

<div class="field">
    <p id="search-field-{{ $name }}" class="autocomplete control is-expanded has-icons-left">
        {{-- The input, with specific ID and data-atribute to be detected by javascript --}}
        <input
            id="search-input-{{ $name }}" 
            data-search-api-url="{{ $searchUrl }}"
            class="input {{ $errors->has($name) ? ' is-danger' : '' }}"
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
    </p>
    @if ($errors->has($name))
        <p class="help is-danger">{{ $errors->first($name) }}</p>
    @endif
    {{ $slot }}
</div>