# Filter system

The pages that requires filtering use a global filtering system designed for the app.
These filers will automaticaly scope the eloquent query using the GET parameters (like paginate).

## How to use

To correctly use the filters you need :

* The model must implement the `Filterable` trait (located as `App\Extensions\Filters`)
* You need to add the `filter_box` component to the page you want to filter.

## Blade componennt

First, you need to add the filter component in the page you vant to add filtering capabilities.

```php
{{-- Filters --}}
@component('components/filters_box', ['filters' => [
    // Specify the columns and the values you want to filter from the model
    "filtredColumns" => [
        "status" => [
            "not-present" => "Pas présent",
            "not-requested" => "Non demandé",
            "free" => "Libre",
            "requested" => "Demandé",
            "gone" => "En run"
        ],
    ],
    // Sets the column used for the search
    "search" => "firstname",
    // Sets the columns usable for orderning
    "orderBy" => [
        "lastname" => "Nom de famille",
        "firstname" => "Prénom",
        "email" => "E-mail",
        "phone_number" => "Tel",
        "status" => "Status",
    ]
]])
@endcomponent
```

## Model scoping with the trait

Add the Filterable trait to the model you want to add filtering capabilities :

```php
use App\Extensions\Filters\Filterable;

class User extends Model
{
    use Filterable;

    // Users model methods...
}
```

Then in the controller you retrive the datas from the model, use the filter scope on our eloquent request :

```php
class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::filter($request, 'lastname', 'asc')->paginate(20);
    }
```
Filter nedds 3 parameters :
1. The current request
2. The column for default ordering
3. The direction for the ordering


<br>
<br>
<br>
<hr>

**Helpful links :**

* [Eloquent scopes](https://laravel.com/docs/5.6/eloquent#query-scopes)

<hr>
<div align="center">

**[<- Prev](6_status.md) // [Summary](../README.md) // [Next ->](8_logsystem.md)**

</div>