{{--
  -- Filters box
  -- Display a box for filtering results in the page
  -- Work with the corresponding javascript and right controller implementations
  -- See docs to use it correctly
  --
  -- @author Bastien Nicoud
  --}}

<form action="" method="GET">
    <div class="columns is-multiline has-background-light">
        <div class="column is-3">
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
        <div class="column is-3">
            <p class="title is-6">
                Rechercher
            </p>
            <input class="input" type="hidden" name="search" value="name" type="text">
            <input class="input" name="needle" type="text" placeholder="Text input" value="{{ old("needle") }}">
        </div>
        <div class="column is-3">
            <p class="title is-6">
                Trier par :
            </p>
            <div class="select">
                <select name="order">
                    <option value="planned_at">Prévu A</option>
                    <option value="started_at">Démarré à</option>
                </select>
            </div>
            <div class="select">
                <select name="direction">
                    <option value="asc">Croissant</option>
                    <option value="desc">Décroissant</option>
                </select>
            </div>
        </div>
        <div class="column is-3">
            <p class="title is-6">
                Entre :
            </p>
            <input class="input" type="text" placeholder="Text input">
            <input class="input" type="text" placeholder="Text input">
        </div>
        <div class="column is-12">
            <button type="submit" class="button is-danger is-centered">Filtrer</button>
        </div>
    </div>
</form>
