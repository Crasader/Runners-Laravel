# Users permissions managment

We manage the permissions with the laravel [policies](https://laravel.com/docs/5.5/authorization#creating-policies) system and a dedicated table in the database.

All users are attached to a role, and all role defines a list of permissions. So the user permissions for a given action a define by his role. All this permissions are manageable, by editing the database (soon, directly from the web app). The permissions are stored in the `permissions` column of the `roles` table in json format.

The `permissions` json is simple, a key with the permission name, and a boolean to allow or deny it for the edited role.

## Athorization process

1. The `auth` middleware check if the user is authenticated
2. The controller action call the policy to check the user permission for the related action
3. The policy call the model to check the permissions in the database
4. If the permission is true, the action is authorized, if not laravef fires a `unauthorized` exeption.

## Permissions namming

The permissions name follow a simple pattern :

* If the model not require fine permission, we just want to authorize all actions on this model, we use the `manage` keword to define the permission. (Ex: `manage_groups`)
* If we want fine permissions for all the actions we use the action keyword to define the permission. (Ex: `create_groups`, `view_groups`...)
* In specific case, we use specific keywords like `force_start_run`, this situations dond follow the two precedent rules.

## Permissions list

For the **superuser** :
The superuser have acces to all the roles, and it's not possible to remouve permissions for this role.

Permissions assignables for **all other users** :
* 'start_run'                  => true or flase
* 'end_run'                    => true or flase
* 'force_start_run'            => true or flase
* 'force_end_run'              => true or flase
* 'manage_runs'                => true or flase
* 'create_users'               => true or flase
* 'delete_users'               => true or flase
* 'manage_schedules'           => true or flase
* 'manage_artists'             => true or flase
* 'manage_waypoints'           => true or flase
* 'manage_groups'              => true or flase
* 'manage_roles'               => true or flase
* 'manage_cars'                => true or flase
* 'manage_car_types'           => true or flase
* 'manage_other_users'         => true or flase
* 'manage_my_comments'         => true or flase
* 'manage_other_user_comments' => true or flase
* 'view_comments'              => true or flase
* 'manage_logs'                => true or flase

<br>
<br>
<br>
<hr>

**Helpful links :**
* [Laravel authorization system](https://laravel.com/docs/5.6/authorization)

<hr>
<div align="center">

**[<- Prev](#) // [Summary](../README.md) // [Next ->](#)**

</div>