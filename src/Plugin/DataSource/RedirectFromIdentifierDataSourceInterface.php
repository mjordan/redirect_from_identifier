<?php

namespace Drupal\redirect_from_identifier\Plugin\DataSource;

/**
 * Gets data for redirecting the user.
 */
interface RedirectFromIdentifierDataSourceInterface {

  /**
   * Returns the data source's name.
   *
   * @return string
   *   The name of the data source as it appears in the reports form.
   */
  public function getName();

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
