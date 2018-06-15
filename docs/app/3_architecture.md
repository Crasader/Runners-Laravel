# Application architecture

Runners use the default laravel template, and we strive to follow the "laravel best practice's" !
Globally the app is build around MVC pattern ! But laravel introduce other patterns to manage specific situations.
In the next lines where going to explain the global architecture of the app !

## Laravel lifecycle

1. Web server send the request to the index.php file.
2. The app bootstraps.
3. Laravel loads service providers.
4. Laravel kernel handle the request.
5. Pass it trough the router.
6. Next, the request pass trough the app middleware stack.
7. Laravel dispatch the request to the dedicated controller.
8. The request if validated by custom Request.
9. The controller verify user permissions.
10. The controller calls business logic (Eloquent Models)
11. Depending performed actions, events/notifications are fired and treated.
12. The controller return a response.
13. The response call corresponding view (Blade template / API resource).


<br>
<br>
<br>
<hr>

**Helpful links :**

<hr>
<div align="center">

**[<- Prev](./2_assets.md) // [Summary](../README.md) // [Next ->](4_permissions.md)**

</div>