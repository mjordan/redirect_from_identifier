<?php

namespace Drupal\redirect_from_identifier\Plugin\DataSource;

use Drupal\redirect_from_identifier\Plugin\DataSource\RedirectFromIdentifierDataSourceInterface;

/**
 * Data source that gets node IDs from a query against configurable fields.
 *
 */
class Field implements RedirectFromIdentifierDataSourceInterface {

  /**
   * Gets the node IDs corresponding to the value in a field.
   *
   * @return array
   *   An array of associative arrays, each with version ID => node ID.
   */
  public function getData($identifier) {
    $config = \Drupal::config('redirect_from_identifier.settings');
    $fields = preg_split("/\\r\\n|\\r|\\n/", $config->get('redirect_from_identifier_target_fields'));

    $ids = [];
    foreach ($fields as $field_name) {
      $query = \Drupal::entityQuery('node');
      $query->condition(trim($field_name), trim($identifier), '=');
      $results = $query->execute();
      if (count($results) == 0) {
        continue;
      }
      $ids = array_merge($ids, array_values($results));
    }

    return $ids;
  }

}
