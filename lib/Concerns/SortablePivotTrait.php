<?php

namespace Lib\Concerns;
use Illuminate\Databse\Eloquent\Model;
use Lib\Models\Relationships\SortableBelongsToMany;
/**
* Most of this is copied from Illuminate\Databse\Eloquent\Concerns\HasRelationships
*/
trait SortablePivotTrait{
  /**
   * Create a new model instance for a related model.
   *
   * @param  string  $class
   * @return mixed
   */
  protected function newRelatedInstance($class)
  {
      return tap(new $class, function ($instance) {
          if (! $instance->getConnectionName()) {
              $instance->setConnection($this->connection);
          }
      });
  }
  public function sortableBelongsToMany($related,$orderColumn = null, $table =null, $foreignKey = null, $otherKey = null, $relation = null)
  {
    // If no relationship name was passed, we will pull backtraces to get the
    // name of the calling function. We will use that function name as the
    // title of this relation since that is a great convention to apply.
    if (is_null($relation)) {
        $relation = $this->guessBelongsToManyRelation();
    }

    // First, we'll need to determine the foreign key and "other key" for the
    // relationship. Once we have determined the keys we'll make the query
    // instances as well as the relationship instances we need for this.
    $instance = $this->newRelatedInstance($related);

    $foreignKey = $foreignKey ?: $this->getForeignKey();

    $otherKey = $otherKey ?: $instance->getForeignKey();

    // If no table name was provided, we can guess it by concatenating the two
    // models using underscores in alphabetical order. The two model names
    // are transformed to snake case from their default CamelCase also.
    if (is_null($table)) {
        $table = $this->joiningTable($related);
    }
    $query = $instance->newQuery();
    return new SortableBelongsToMany($query, $this, $table, $foreignKey, $otherKey, $relation, $orderColumn);
  }
}
