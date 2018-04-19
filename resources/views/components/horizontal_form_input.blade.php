{{--
  -- Horizontal form input
  -- Allows you to easy bootstrap form inputs with errors and bulma styling
  --
  -- @author Bastien Nicoud
  --}}

<div class="field">
    <p class="control is-expanded has-icons-left">
        <input class="input {{ $errors->has($name) ? ' is-danger' : '' }}"
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ old($name) }}"
            placeholder="{{ $placeholder }}">
        <span class="icon is-small is-left">
            <i class="fas {{ $icon }}"></i>
        </span>
    </p>
    @if ($errors->has($name))
        <p class="help is-danger">{{ $errors->first($name) }}</p>
    @endif
</div>