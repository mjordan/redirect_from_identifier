<?php

namespace Drupal\redirect_from_identifier\Plugin\DataSource;

use Drupal\redirect_from_identifier\Plugin\DataSource\RedirectFromIdentifierDataSourceInterface;

/**
 * Data source that gets node IDs from a query against configurable fields.
 *
 */
class Field implements RedirectFromIdentifierDataSourceInterface {

  /**
   * Gets the data.
   *
   * @return array
   *   An array of associative arrays, each with version ID => node ID.
   *
   *   Note: We need to figure out how to handle multiple entity types
   *   and multiple fields in the config.
   */
  public function getData($identifier) {
    $config = \Drupal::config('redirect_from_identifier.settings');
    $fields = explode(',', $config->get('redirect_from_identifier_target_fields'));

    $ids = [];
    foreach ($fields as $field_name) {
      $query = \Drupal::entityQuery('node');
      $query->condition(trim($field_name), $identifier, '=');
      $results = $query->execute();
      $ids = array_merge($ids, array_values($results));
    }

    return $ids;
  }

}
