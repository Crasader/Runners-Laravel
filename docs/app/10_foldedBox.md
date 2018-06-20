# Folded Box

Folded box is a little component that allows you to fold/unfold a section in a page.
To use it you need :

## Insert the component

Add the component in our page

```html
<!-- The base component needs 2 parameters -->
<!-- true/false if the box is folded or not by default -->
<!-- an unique id, it will be used by the JS to target the box -->
@foldable(['folded' => true, 'id' => 'more-infos-zone'])
  <!-- The foldedTitle is the html displayed when the box is folded -->
  @slot('foldedTitle')
    <h2 class="title is-4">Plus d'infos...</h2>
  @endslot
  <!-- The unFoldedTitle is the html displayed when the box is open -->
  @slot('unFoldedTitle')
    <h2 class="title is-4">Plus d'infos (masquer)</h2>
  @endslot
  <!-- The content of the box -->
  <div>
    ....
  </div>
@endfoldable
```

The main JS of Runners will register the boy automatically by specific id.

<br>
<br>
<br>
<hr>

**Helpful links :**

<hr>
<div align="center">

**[<- Prev](9_notifications.md) // [Summary](../README.md) // [Next ->](../README.md)**

</div>
