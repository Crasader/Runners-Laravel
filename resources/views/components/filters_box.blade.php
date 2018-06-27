{{--
  -- Filters box
  -- Display a box for filtering results in the page
  -- Work with the corresponding javascript and right controller implementations
  -- See docs to use it correctly
  --
  -- @author Bastien Nicoud
  --}}

@push('scripts')
    <script src="{{ mix('js/features/filters.js') }}"></script>
@endpush

<form id="filtering-form" action="" method="GET">
    <div class="columns">
        <div class="column is-12">
            <div class="box has-background-light">
                <div class="columns is-multiline">

                    {{-- CHECKBOX FILTERS --}}
		    {{-- MAX 3 fields (you can add more put layout can be ridiculous) --}}
@if(isset($filters['filtredColumns']))
                    @foreach($filters['filtredColumns'] as $columns => $fields)
                        <div class="column">
                            <input
                                class="input"
                                type="hidden"
                                name="filter-column"
                                value="{{ $columns }}"
                                type="text">
                            <p class="title is-6 has-text-centered">
                                Filtrer {{ $columns }} :
                            </p>
                            <div class="columns is-multiline is-gapless">
                                @foreach($fields as $key => $val)
                                    <div class="column is-half">
                                        <div class="control">
                                            <label class="checkbox">
                                                <input
                                                    name="filter[]"
                                                    value="{{ $key }}"
                                                    type="checkbox"
                                                    {{ in_array($key, request()->query('filter', [])) ? 'checked' : '' }}>
                                                {{ $val }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
			@endforeach
			@endif

                    {{-- SEARCH FILTER --}}
                    @if (isset($filters["search"]))
                        <div class="column">
                            <p class="title is-6 has-text-centered">
                                Rechercher :
                            </p>
                            <input
                                class="input"
                                name="needle"
                                type="text"
                                placeholder="Rechercher dans {{ $filters["search"] }}"
                                value="{{ request()->needle }}">
                            <input
                                class="input"
                                type="hidden"
                                name="search"
                                value="{{ $filters["search"] }}"
                                type="text">
                        </div>
                    @endif

                    {{-- SORT FILTER --}}
                    @if (isset($filters["orderBy"]))
                        <div class="column">
                            <p class="title is-6 has-text-centered">
                                Trier par :
                            </p>
                            <div class="select">
                                <select name="order">
                                    @foreach($filters["orderBy"] as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="select">
                                <select name="direction">
                                    <option value="asc">Croissant</option>
                                    <option value="desc">Décroissant</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    {{-- SUBMIT BUTTON --}}
                    <div class="column is-12">
                        <div class="buttons has-addons is-centered">
                            <button type="submit" class="button">Filtrer les résultats</button>
                            @if (request()->query())
                                <a class="button" href="{{ route(request()->route()->getName()) }}">Enlever les filtres</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
