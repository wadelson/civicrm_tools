<?php

namespace Drupal\civicrm_tools_rest\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\civicrm_tools\CiviCrmApiInterface;

/**
 * Class SettingsForm.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * Drupal\civicrm_tools\CiviCrmApiInterface definition.
   *
   * @var \Drupal\civicrm_tools\CiviCrmApiInterface
   */
  protected $civicrmApi;

  /**
   * Constructs a new SettingsForm object.
   */
  public function __construct(
    ConfigFactoryInterface $config_factory,
      CiviCrmApiInterface $civicrm_tools_api
    ) {
    parent::__construct($config_factory);
    $this->civicrmApi = $civicrm_tools_api;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('civicrm_tools.api')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'civicrm_tools_rest.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'civicrm_tools_rest_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('civicrm_tools_rest.settings');
    $groups = [];
    $groupsData = $this->civicrmApi->getAll('Group', []);
    foreach ($groupsData as $group) {
      $groups[$group['id']] = $group['name'];
    }
    $form['group_limit'] = [
      '#type' => 'select',
      '#title' => $this->t('Group limit'),
      '#description' => $this->t('Limit the groups that are exposed by the web service. If empty all groups will be exposed.'),
      '#options' => $groups,
      '#size' => 5,
      '#default_value' => $config->get('group_limit'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('civicrm_tools_rest.settings')
      ->set('group_limit', $form_state->getValue('group_limit'))
      ->save();
  }

}
