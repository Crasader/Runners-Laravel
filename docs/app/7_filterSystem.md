# Filter system

The pages that requires filtering use a global filtering system designed for the app.
These filers will automaticaly scope the eloquent query using the GET parameters (like paginate).

## How to use

To correctly use the filters you need :

* The model must implement the `Filterable` trait (located as `App\Extensions\Filters`)
* You need to add the `filter_box` component to the page you want to filter.

## Blade componennt

## Model scoping with the trait


<br>
<br>
<br>
<hr>

**Helpful links :**

* [Eloquent scopes](https://laravel.com/docs/5.6/eloquent#query-scopes)

<hr>
<div align="center">

**[<- Prev](6_status.md) // [Summary](../README.md) // [Next ->](#)**

</div>