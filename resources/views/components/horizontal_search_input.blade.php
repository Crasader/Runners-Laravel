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

{{-- Set the $errorName if not provided by the user --}}
{{-- We use specific error name for arrays, but laravel not use the same syntax as html for array forms --}}
@php
if (!isset($errorName)) {
    $errorName = $name;
}
@endphp

<div class="field {{ isset($button) ? 'is-grouped' : '' }}">
    <div id="search-field-{{ $name }}" class="autocomplete control is-expanded has-icons-left">
        {{-- The input, with specific ID and data-atribute to be detected by javascript --}}
        <input
            id="search-input-{{ $name }}"
            data-search-api-url="{{ $searchUrl }}"
            class="input {{ $errors->has($errorName) ? ' is-danger' : '' }}"
            type="{{ $type }}"
            name="{{ $name }}"
            autocomplete="off"
            @if(old($errorName))
                value="{{ old($errorName) }}"
            @elseif(isset($value))
                value="{{ $value }}"
            @endif
            placeholder="{{ $placeholder }}">
        <span class="icon is-small is-left">
            <i class="fas {{ $icon }}"></i>
        </span>
        {{-- Error display --}}
        @if ($errors->has($errorName))
            <div class="help is-danger">{{ $errors->first($errorName) }}</div>
        @endif
    </div>
    {{-- Display a right button if the slot button is defined --}}
    @if(isset($button))
        <div class="control">
            {{ $button }}
        </div>
    @endif
    {{ $slot }}
</div>