<?php

namespace Drupal\redirect_from_identifier\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Controller.
 */
class RedirectFromIdentifierController extends ControllerBase {

  /**
   * Redirect the user to the appropriate node.
   *
   * @param string $identifier
   *    The identifier to look up.
   */
  public function main($identifier) {
    // @todo: Perform security checks on the identifier.
    // if (!is_numeric($first) || !is_numeric($second)) {
      // We will just show a standard "access denied" page in this case.
      // throw new AccessDeniedHttpException();
    // }

    $global $base_url;
    $data_source = \Drupal::service('redirect_from_identifier.datasource.field');
    $ids = $data_source->getData(trim($identifier));

    // If there's more than one member of $ids, render the template with all corresponding URLs.

    $target_url = $base_url . '/node/' . $ids[0];
    devel_debug($target_url);
    $response = new RedirectResponse($target_url);
    $response->send();
  }

}
