<?php

namespace Drupal\redirect_from_identifier\Routing;

use Symfony\Component\Routing\Route;

/**
 * Defines routes based on configured paths.
 */
class IdentifierRoutes {

  /**
   * {@inheritdoc}
   */
  public function routes() {
    $config = \Drupal::config('redirect_from_identifier.settings');
    $paths = preg_split("/\\r\\n|\\r|\\n/", $config->get('redirect_from_identifier_routes'));
    
    $routes = [];
    $counter = -1;
    foreach ($paths as $path) {
      $counter++;
      $routes['redirect_from_identifier.' . $counter] = new Route(
        trim($paths[$counter]),
        [
          '_controller' => '\Drupal\redirect_from_identifier\Controller\RedirectFromIdentifierController::main',
          '_title' => 'Please note'
        ],
        [
          '_permission'  => 'access content',
        ]
      );
    }
    return $routes;
  }

}
