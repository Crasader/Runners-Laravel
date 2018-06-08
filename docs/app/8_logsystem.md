# Notifications

To provide an easy way to sent notifications to users we use the laravel [built-in notifications system](https://laravel.com/docs/5.6/notifications).
It allows you to easyly create ne notifications in the app. The database notifications are preconfigured, and a dedicated page for consulting notifications is available.

## Add new notification

1. You need to create a new [Notification class](https://laravel.com/docs/5.6/notifications#creating-notifications) and specify notification contents and channels.
2. You need to [send the notification](https://laravel.com/docs/5.6/notifications#sending-notifications) via the `Notification` facade.
```php
// Send the InvoicePaid notification to an array of users
Notification::send($users, new InvoicePaid($invoice));
```

## Display database notifications
1. In our notification class you need to add database in our via channels
```php
// App\Notifications\MyNewAwesomeNotification

public function via($notifiable)
{
    return ['database'];
}
```
2. You need to define a to array method thats converts notification datas into associative array to store it in the database. Thats allow you to retrive this data in the notification layout.
```php
// App\Notifications\MyNewAwesomeNotification

public function toArray($notifiable)
{
    return [
        'notification_data' => $this->datas->notificationData,
        'anorther_notification_data' => $this->datas->anotherNotificationData,
    ];
}
```
3. Create a new notification type view in the `views/notifications/layouts/YourNotificationName` to provide a confinient layout for displaying the notification (in the show route of the notifications crud). See the [UnHandledExceptionNotification](../../resources/views/notifications/layouts/UnHandledExceptionNotification.blade.php) for example.
4. Register our notification type the the 2 notification types componenets, thats allow you to convert the complete notification type namespace to an user friendly name, and to load the desired notification layort.
```html
<!-- In resources/views/components/notifications/notification_types.blade.php -->
<!-- Add a case that retrun a tag with the notification name -->
@case('App\Notifications\MyNewAwesomeNotification')
    <span class="tag {{ $slot }} is-white">Ma nouvelle notification</span>
    @break

<!-- In resources/views/components/notifications/nrender_notification.blade.php -->
<!-- Add a case with and include statment that point to our new notification layout -->
@case('App\Notifications\MyNewAwesomeNotification')
    @include('notifications.layouts.MyNewAwesomeNotification', ['notification' => $notification])
    @break
```

## Other notifications channels

You can easily add other channels to our notification, like mail..


<br>
<br>
<br>
<hr>

**Helpful links :**

* [Laravel notifications](https://laravel.com/docs/5.6/notifications)

<hr>
<div align="center">

**[<- Prev](7_filterSystem.md) // [Summary](../README.md) // [Next ->](9_notifications.md)**

</div>
