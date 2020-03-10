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
   *
   * @return object|string
   *    If there is only one entity found, redirect to it. If more than
   *    one, return a themed list of entities to the user. If nothing found,
   *    return/throw a 404 response.
   */
  public function main($identifier) {
    // @todo: Perform security checks on the identifier, maybe
    // allowing admins to enter a set of non-alphnumeric characterw
    // they will permit in incoming identifiers, e.g., ':_-'.
    // if ()) {
      // throw new AccessDeniedHttpException();
    // }

    $data_source = \Drupal::service('redirect_from_identifier.datasource.field');
    $ids = $data_source->getData(trim($identifier));

    // @todo: don't use this, return a 404.
    if (count($ids) === 0) {
      return [
        '#markup' => $this->t('Sorry, nothing found that uses that identifier')
      ];
    }
    // If there's more than one member of $ids, render the template with all corresponding URLs.
    if (count($ids) === 1) {
      global $base_url;
      $target_url = $base_url . '/node/' . $ids[0];
      $response = new RedirectResponse($target_url);
      $response->send();
      return $response;
    }
    if (count($ids) > 1) {
      return [
        '#ids' => $ids,
        '#theme' => 'redirect_from_identifier',
      ];
    }
  }

}
