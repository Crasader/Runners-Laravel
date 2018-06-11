{{--
  -- Horizontal form input
  -- Allows you to easy bootstrap form inputs with errors and bulma styling
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
    <p class="control is-expanded has-icons-left">
        <input class="input {{ $errors->has($errorName) ? ' is-danger' : '' }}"
            type="{{ $type }}"
            name="{{ $name }}"
            @if(old($errorName))
                value="{{ old($errorName) }}"
            @elseif(isset($value))
                value="{{ $value }}"
            @endif
            placeholder="{{ $placeholder }}">
        <span class="icon is-small is-left">
            <i class="fas {{ $icon }}"></i>
        </span>
        @if ($errors->has($errorName))
            <p class="help is-danger">{{ $errors->first($errorName) }}</p>
        @endif
    </p>
    @if(isset($button))
        <p class="control">
            {{ $button }}
        </p>
    @endif
    {{ $slot }}
</div>