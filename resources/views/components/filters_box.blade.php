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
                    <div class="column is-4">
                        <p class="title is-6">
                            Filtrer :
                        </p>
                        <label class="checkbox">
                            <input type="checkbox">
                            Remember me
                        </label>
                        <label class="checkbox">
                            <input type="checkbox">
                            Remember me
                        </label>
                        <label class="checkbox">
                            <input type="checkbox">
                            Remember me
                        </label>
                    </div>

                    {{-- SEARCH FILTER --}}
                    <div class="column is-4">
                        <p class="title is-6">
                            Rechercher :
                        </p>
                        <input
                            class="input"
                            name="needle"
                            type="text"
                            placeholder="Rechercher dans {{ $filters["search"] }}"
                            value="{{ old("needle") }}">
                        <input
                            class="input"
                            type="hidden"
                            name="search"
                            value="{{ $filters["search"] }}"
                            type="text">
                    </div>

                    {{-- SORT FILTER --}}
                    <div class="column is-4">
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
