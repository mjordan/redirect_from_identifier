<?php

namespace Drupal\redirect_from_identifier\Command;

use Drush\Commands\DrushCommands;

/**
 * Drush commandfile.
 */
class RedirectFromIdentifierCommands extends DrushCommands {

  /**
   * @param int $identifier
   *   The identifier to look up.
   *
   * @command redirect_from_identifier:query
   * @usage redirect_from_identifier:query 123foo
   */
   public function query($identifier) {
     $data_source = \Drupal::service('redirect_from_identifier.datasource.field');
     $ret = $data_source->getData($identifier);
     var_dump($ret);
   }
}
