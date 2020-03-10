<?php

namespace Drupal\redirect_from_identifier\Plugin\DataSource;

use Drupal\redirect_from_identifier\Plugin\DataSource\RedirectFromIdentifierDataSourceInterface;

/**
 * Data source that gets media counts by MIME type.
 *
 */
class Field implements RedirectFromIdentifierDataSourceInterface {

  /**
   * Returns the data source's name.
   *
   * @return string
   *   The name of the data source.
   */
  public function getName() {
    return t('Field value');
  }

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
    // Only one entity, at least for now.
    $entity = $config->get('redirect_from_identifier_target_entities');
    $fields = explode(',', $config->get('redirect_from_identifier_target_fields'));

    $query = \Drupal::entityQuery($entity);
    $ids = [];
    // Using multiple fields doesn't work yet, we probably need to use an orCondition or something.
    foreach ($fields as $field) {
      $query->condition($field, $identifier, '=');
      $results = $query->execute();
      $ids = array_merge($ids, array_values($results));
    }

    return $ids;
  }

}
