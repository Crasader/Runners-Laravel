{{--
  -- Filters box
  -- Display a box for filtering results in the page
  -- Work with the corresponding javascript and right controller implementations
  -- See docs to use it correctly
  --
  -- @author Bastien Nicoud
  --}}


<div class="columns has-background-light">
    <div class="column is-6">
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
            Trier par :
        </p>
        <div class="select">
            <select>
                <option>Select dropdown</option>
                <option>With options</option>
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
</div>