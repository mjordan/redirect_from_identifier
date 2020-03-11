<?php

namespace Drupal\redirect_from_identifier\Plugin\DataSource;

/**
 * Gets data for redirecting the user.
 */
interface RedirectFromIdentifierDataSourceInterface {

  /**
   * Gets the data.
   *
   * @param string $identifier
   *    The value to use in the query that gets the entity ID/
   *
   * @return array
   *   An associative array of entity ID => value pairs (usually only one member).
   */
  public function getData($identifier);

}
