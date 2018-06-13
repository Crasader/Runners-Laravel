{{--
  -- Foldable box
  -- Ad Js comportement to fold / unfold the content passed in the slot
  --
  -- * The id must be unique on all folded box of the page
  --
  -- @author Bastien Nicoud
  --}}

<div id="folded-title-{{ $id }}" class="{{ $folded ? '' : 'is-hidden' }} cursor-pointer">
    {{ $foldedTitle }}
</div>
<div id="unfolded-title-{{ $id }}" class="{{ $folded ? 'is-hidden' : '' }} cursor-pointer">
    {{ $unFoldedTitle }}
</div>
<div id="unfolded-box-{{ $id }}" data-folded-box-id="{{ $id }}" class="{{ $folded ? 'is-hidden' : '' }}">
    {{ $slot }}
</div>