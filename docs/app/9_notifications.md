# Log System

You can easyly add loging for our diferents models, thats allow you to conserve a stack of all the actions performed in the app.
For loging actions we use the eloquent events and laravel subscriber system.
Thats allo you to easyly add logging on any model as you want, after attaching these events,
all actions performed in the model will be saved in the logs table, and can be acceced by the log page.

## How to attach it to a model

For a Model to be logged, you need to perform little changes on the model :

### Model relation

Add a polymorphic relation to the log model.

```php
/**
 * MODEL RELATION
 * Gets the logs corresponding to this model
 */
public function logs()
{
    return $this->morphMany(Log::class, 'loggable');
}
```

### Attaching events

Next you need to register the events you want to log for the model.
In runners you can log 4 events :
* `created`
* `updated`
* `deleted`
* `restored`
The restored event can only be addet to medels that uses soft deletes.

Here the code to add in the model to fire events :

```php
/**
 * MODEL EVENTS
 * The event map for the model.
 *
 * @var array
 */
protected $dispatchesEvents = [
    'created'  => LogDatabaseCreateEvent::class,
    'updated'  => LogDatabaseUpdateEvent::class,
    'deleted'  => LogDatabaseDeleteEvent::class,
    'restored' => LogDatabaseRestoreEvent::class
];
```

## Retriving logs

After this manipulations, all the events will be logged in the logs table.
You can retrieve logs for a specific model by accesing the polymorphic relation you added below.
Example to retrive runs logs.

```php
$run = Run::first();
$run->logs();
```

## Custom logs

You can crete our own custom events for log actions in logs table.

1. Create a custom [event](https://laravel.com/docs/5.6/events#defining-events)
2. Add a method to the LogEventSubscriber to handle this even an log it in the database (or create our own event listener for mor control)
3. Fire your event, and watch the logs

<br>
<br>
<br>
<hr>

**Helpful links :**

* [Eloquent events](https://laravel.com/docs/5.6/eloquent#events)
* [Laravel events](https://laravel.com/docs/5.6/events#event-subscribers)

<hr>
<div align="center">

**[<- Prev](7_filterSystem.md) // [Summary](../README.md) // [Next ->](./10_foldedBox.md)**

</div>
