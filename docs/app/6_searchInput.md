# Search inputs

Search input is a blade component designed to provides autocompletion on fields.
To use it you need :

## Setup a search route

You need to implement a search route on the crud you want to make the search. This route will be acceded by the web routes,
not the api routes, but he returns JSON. Because the api don't use the same authentication system as api.

An example on users names :
1. Setup the route
```php
Route::post('users/search', 'User\UserController@search')->name('users.search');
```
2. Setup a method to search the data's
```php
public function search(Request $request)
{
    if ($request->needle) {
        $results = User::search($request->needle)->get();
        return UserSearchResource::collection($results);
    } else {
        return response()->json([], 200);
    }
    return response()->json([], 200);
}
```
3. Create an API resource that serialize the eloquent results to json
```php
class UserSearchResource extends Resource
{
    public function toArray($request)
    {
        return [
            'name' => $this->fullname
        ];
    }
}
```

## Add the component on our page

Now you need to import the search component in our page :
```html
@component('components/horizontal_search_input', [
    'name'        => 'field name',
    'placeholder' => 'A placeholder',
    'type'        => 'text',
    'icon'        => 'fa-user',
    'value'       => 'Eventual default value',
    'searchUrl'   => route('users.search'),
    'errors'      => $errors
    ])
@endcomponent
```

## Import the javascript

Finally you need to import the searchField.js class, and initialize all search fields on our page :
```js
import { SearchField } from '../../features/searchField'

// Scan the page and get all the search fields
let fields = document.querySelectorAll('[id^="search-input-"]')

// Initialize all the search fields
for (let el of fields) {
  let field = new SearchField(el)
  field.observe()
}
```

<br>
<br>
<br>
<hr>

**Helpful links :**

<hr>
<div align="center">

**[<- Prev](./5_status.md) // [Summary](../README.md) // [Next ->](./7_filterSystem.md)**

</div>