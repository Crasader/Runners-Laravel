# Users permissions managment

We manage the permissions with the laravel [policies](https://laravel.com/docs/5.5/authorization#creating-policies) system and a dedicated table in the database.

All users are attached to a role, and all role defines a list of permissions. So the user permissions for a given action a define by his role. All this permissions are manageable, by editing the database (soon, directly from the web app). The permissions are stored in the `permissions` column of the `roles` table in json format.

The `permissions` json is simple, a key with the permission name, and a boolean to allow or deny it for the edited role.

## Athorization process

1. The `auth` middleware check if the user is authenticated
2. The controller action call the policy to check the user permission for the related action
3. The policy call the model to check the permissions in the database
4. If the permission is true, the action is authorized, if not laravef fires a `unauthorized` exeption.

## Permissions list

For the **superuser** :  
The superuser have acces to all the roles, and it's not possible to remouve permissions for this role.

For the **admin** role :
* 'start_run'            => true
* 'end_run'              => true
* 'force_start_run'      => true
* 'force_end_run'        => true
* 'create_runners'       => true
* 'create_coordinators'  => true
* 'create_admin'         => false
* 'destroy_runners'      => true
* 'destroy_coordinators' => true
* 'destroy_admin'        => false
* 'manage-schedules'     => true

For the **coordinator** role :
* 'start_run'            => true
* 'end_run'              => true
* 'force_start_run'      => true
* 'force_end_run'        => true
* 'create_runners'       => true
* 'create_coordinators'  => false
* 'create_admin'         => false
* 'destroy_runners'      => true
* 'destroy_coordinators' => false
* 'destroy_admin'        => false
* 'manage-schedules'     => true

For the **runner** role :
* 'start_run'            => true
* 'end_run'              => true
* 'force_start_run'      => false
* 'force_end_run'        => false
* 'create_runners'       => false
* 'create_coordinators'  => false
* 'create_admin'         => false
* 'destroy_runners'      => false
* 'destroy_coordinators' => false
* 'destroy_admin'        => false
* 'manage-schedules'     => false

<br>
<br>
<br>
<hr>

**Helpful links :**

<hr>
<div align="center">

**[<- Prev](#) // [Summary](../README.md) // [Next ->](#)**

</div>