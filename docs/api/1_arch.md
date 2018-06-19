# Api architecture

## Files

* Routes are in `routes/api.php``
* Controllers are grouped in `Http/Controllers/api/``
* All json response are generated with laravel resources, located in `Http/Controllers/Resources/`

## Note for search field

In the back-office we use search fields, with autocomplete,
this fields use an ajax call to suggest the user.
!!! We don't use api routes for this ajax call's !!! this routes are registered in the `routes/web.php`
because they need to use the same authentication system as the back office. See [search fields doc](../app/6_searchInput.md) for details


<br>
<br>
<br>
<hr>

**Helpful links :**
* [Laravel routing](https://laravel.com/docs/5.6/routing#basic-routing)

<hr>
<div align="center">

**[<- Prev](../README.md) // [Summary](../README.md) // [Next ->](2_authentication.md)**

</div>