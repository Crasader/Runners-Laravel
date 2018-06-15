# Users permissions management

We manage the permissions with the laravel [policies](https://laravel.com/docs/5.5/authorization#creating-policies) system and a dedicated table in the database.

All users are attached to a role, and all role defines a list of permissions.
So the user permissions for a given action a define by his role.
All this permissions are manageable, by editing the database (soon, directly from the web app).
The permissions are stored in the `permissions` column of the `roles` table in json format.

The `permissions` json is simple, a key with the permission name, and a boolean to allow or deny it for the edited role.

## Authorization process

1. The `auth` middleware check if the user is authenticated
2. The controller action call the policy to check the user permission for the related action
3. The policy call the model to check the permissions in the database
4. If the permission is true, the action is authorized, if not laravel fires a `unauthorized` exception.

## Permissions naming

The permissions name follow a simple pattern :

* If the model not require fine permission, we just want to authorize all actions on this model,
we use the `manage` keyword to define the permission. (Ex: `manage_groups`)
* If we want fine permissions for all the actions we use the action keyword to define the permission. (Ex: `create_groups`, `view_groups`...)
* In specific case, we use specific keywords like `force_start_run`, this situations don't follow the two precedent rules.

## Permissions list

For the **superuser** :
The superuser have access to all the roles, and it's not possible to remove permissions for this role.

Permissions assignable for **all other users** :
* 'start_run'                  => true or false
* 'end_run'                    => true or false
* 'force_start_run'            => true or false
* 'force_end_run'              => true or false
* 'manage_runs'                => true or false
* 'create_users'               => true or false
* 'delete_users'               => true or false
* 'manage_schedules'           => true or false
* 'manage_artists'             => true or false
* 'manage_waypoints'           => true or false
* 'manage_groups'              => true or false
* 'manage_roles'               => true or false
* 'manage_cars'                => true or false
* 'manage_car_types'           => true or false
* 'manage_other_users'         => true or false
* 'manage_my_comments'         => true or false
* 'manage_other_user_comments' => true or false
* 'view_comments'              => true or false
* 'manage_logs'                => true or false

<br>
<br>
<br>
<hr>

**Helpful links :**
* [Laravel authorization system](https://laravel.com/docs/5.6/authorization)

<hr>
<div align="center">

**[<- Prev](./3_architecture.md) // [Summary](../README.md) // [Next ->](./5_status.md)**

</div>