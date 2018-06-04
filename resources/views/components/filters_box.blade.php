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
                    @foreach($filters['filtredColumns'] as $columns => $fields)
                        <div class="column">
                            <input
                                class="input"
                                type="hidden"
                                name="filter-column"
                                value="{{ $columns }}"
                                type="text">
                            <p class="title is-6">
                                Filtrer {{ $columns }} :
                            </p>
                            @foreach($fields as $key => $val)
                                <label class="checkbox">
                                    <input name="filter[]" value="{{ $key }}" type="checkbox">
                                    {{ $val }}
                                </label>
                            @endforeach
                        </div>
                    @endforeach

                    {{-- SEARCH FILTER --}}
                    <div class="column">
                        <p class="title is-6">
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

                    {{-- SORT FILTER --}}
                    <div class="column">
                        <p class="title is-6">
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

                    {{-- SUBMIT BUTTON --}}
                    <div class="column is-12">
                        <div class="buttons has-addons is-centered">
                            <button type="submit" class="button">Filtrer les résultats</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
