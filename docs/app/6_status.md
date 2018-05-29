# The status possible to assing to a model

**!! WARNING !! needs to be updated**

## App\User

| status key name | displayable value               |
|-----------------|---------------------------------|
| active          | Actif                           |
| gone            | Est parti en run                |
| not_present     | L'utilisateur n'est pas présent |
| free            | Disponible                      |

## App\Car

| status key name | displayable value                              |
|-----------------|------------------------------------------------|
| taken           | Utilisé                                        |
| free            | Disponible                                     |
| problem         | La voiture n'est pas en état de fonctionnement |

## App\Run

| status key name | displayable value                              |
|-----------------|------------------------------------------------|
| gone            | Démarré                                        |
| error           | Il manque des information pour démarrer le run |
| finished        | le run est terminé                             |
| missing_cars    | Il manque des voiture pour démarrer le run     |
| empty           | vide                                           |
| ready           | Le run est prêt à être lancé                   |
| needs_filling   | En train d'être finalisé                       |
| drafting        | En train d'être organisé                       |

## App\RunSubscription

| status key name | displayable value                                                                             |
|-----------------|-----------------------------------------------------------------------------------------------|
| ready_to_go     | Pret                                                                                          |
| missing_user    | Il manque un chauffeur                                                                        |
| missing_car     | Il manque une voiture                                                                         |
| needs_filling   | Il faut encore remplir les imformations pour l'utilisateur, la voiture, ou le type de voiture |
| gone            | Le run est parti                                                                              |
| error           | Il y a un problèmr grave avec le convoi                                                       |
| finished        | Ce convoi est terminé                                                                         |


<br>
<br>
<br>
<hr>

**Helpful links :**

<hr>
<div align="center">

**[<- Prev](#) // [Summary](../README.md) // [Next ->](#)**

</div>