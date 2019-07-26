<?php

namespace Drupal\lightning_scheduler;

use Drupal\content_moderation\Permissions as BasePermissions;

/**
 * @internal
 *   This is an internal part of Lightning Scheduler and may be changed or
 *   removed at any time without warning. It should not be used by external
 *   code in any way.
 */
final class Permissions extends BasePermissions {

  /**
   * {@inheritdoc}
   */
  public function transitionPermissions() {
    $permissions = parent::transitionPermissions();

    foreach ($permissions as $permission => $info) {
      unset($permissions[$permission]);

      $permission = preg_replace('/^use /', 'schedule ', $permission);

      /** @var \Drupal\Core\StringTranslation\TranslatableMarkup $title */
      $title = $info['title'];
      $info['title'] = $this->t('%workflow workflow: Schedule %transition transition.', $title->getArguments());

      $permissions[$permission] = $info;
    }
    return $permissions;
  }

}
