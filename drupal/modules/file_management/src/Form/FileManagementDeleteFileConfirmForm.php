<?php

namespace Drupal\file_management\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Defines a confirmation form for deleting mymodule data.
 */
class FileManagementDeleteFileConfirmForm extends ConfirmFormBase {

  /**
   * The file to be deleted.
   *
   * @var \Drupal\file\FileInterface
   */
  protected $file;

  /**
   * The ID of the item to delete.
   *
   * @var String
   */
  protected $id;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'file_management_delete';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Do you want to delete the file "%label" ?', ['%label' => $this->file->label()]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    $route_overview = 'file_management_view.overview';
    $route_provider = \Drupal::service('router.route_provider');

    if (count($route_provider->getRoutesByNames([$route_overview])) === 1) {
      return new Url($route_overview);
    }

    // Fallback to the standard files view if File Management View was not used.
    return Url::fromRoute('view.files.page_1');
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->t('This could break some pages and media entities if they use this file.');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Yes.');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelText() {
    return $this->t('No, go back.');
  }

  /**
   * {@inheritdoc}
   *
   * @param \Drupal\file\FileInterface $file
   *   (optional) The file to be deleted.
   */
  public function buildForm(array $form, FormStateInterface $form_state, $file = NULL) {
    $this->file = $file;
    $this->id = $file->id();
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    if (file_exists($this->file->getFileUri())) {
      $this->file->delete();
      \Drupal::messenger()->addMessage($this->t('File "%label" has been deleted.', [
        '%label' => $this->file->label(),
      ]), 'status');
    }
    else {
      \Drupal::messenger()->addMessage($this->t('File "%label" could not be deleted.', [
        '%label' => $this->file->label(),
      ]), 'error');
    }
  }

}