# The status possible to assign to a model

All the status depending on it's model.
From the [v2.0.0-beta.4](https://github.com/CPNV-ES/Runners-Laravel/releases/tag/v2.0.0-beta.4) the users status are moved into a
dedicated table. In future versions he would be a good idea to assemble all the status still stored in model table,
in the dedicated statuses table.

## App\User

| status key name | displayable value                                            |
|-----------------|--------------------------------------------------------------|
| free            | Active user                                                  |
| requested       | A demand is send to the user, but no response for the moment |
| not-present     | User not present in this edition of paleo                    |
| not-requested   | No demand sent to this user                                  |
| taken           | Actually in run                                              |

## App\Car

| status key name | displayable value                              |
|-----------------|------------------------------------------------|
| taken           | Actually in run                                |
| free            | Free                                           |
| problem         | It seems to be a problem with the car          |

## App\Run

| status key name | displayable value                                  |
|-----------------|----------------------------------------------------|
| gone            | Started run                                        |
| error           | Error with the run                                 |
| finished        | Finished run                                       |
| ready           | Ready to go                                        |
| needs_filling   | Not complete                                       |
| drafting        | In creation phase (not displayed in the mobile app |

## App\RunSubscription

A field is intended for this status, but actually not used.                                                                    |


<br>
<br>
<br>
<hr>

**Helpful links :**

<hr>
<div align="center">

**[<- Prev](4_permissions.md) // [Summary](../README.md) // [Next ->](./6_searchInput.md)**

</div>