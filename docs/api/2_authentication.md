# Api authentication

The api authentication use the default laravel token driver. You just need to pass a barrer token in the headers of your request to authenticate the user.
This tokens are stored in the users table on the column `api_token`.

To test the [mobile app](https://github.com/CPNV-ES/runners) just copy a valid api_token from the database, and fill it in the login page of the app.

## Headers

You need to add a header like this:
```
Authorization: Bearer Ah1mPoahgeKDGdyneM5m60jCbFWj8hDQo0dGqxAE7mC8uojlzHT7dFsEe1WI
```

<br>
<br>
<br>
<hr>

**Helpful links :**
* [Homestead docs](https://laravel.com/docs/5.5/homestead)

<hr>
<div align="center">

**[<- Prev](./1_arch.md) // [Summary](../README.md) // [Next ->](../README.md)**

</div>