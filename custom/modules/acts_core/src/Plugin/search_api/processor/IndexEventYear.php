<?php

namespace Drupal\acts_core\Plugin\search_api\processor;

use Drupal\node\NodeInterface;
use Drupal\search_api\Datasource\DatasourceInterface;
use Drupal\search_api\IndexInterface;
use Drupal\search_api\Item\ItemInterface;
use Drupal\search_api\Processor\ProcessorPluginBase;
use Drupal\search_api\Processor\ProcessorProperty;

/**
 * Adds a separate integer year field to indexed events.
 *
 * @SearchApiProcessor(
 *   id = "index_event_year",
 *   label = @Translation("Event Year Index"),
 *   description = @Translation("Adds a separate integer year field to indexed events, for use with the year range facet."),
 *   stages = {
 *     "add_properties" = 0,
 *   },
 *   locked = true,
 *   hidden = true,
 * )
 */
class IndexEventYear extends ProcessorPluginBase {

  /**
   * Only enabled for node indexes.
   *
   * {@inheritdoc}
   */
  public static function supportsIndex(IndexInterface $index) {
    foreach ($index->getDatasources() as $datasource) {
      if ($datasource->getEntityTypeId() == 'node') {
        return TRUE;
      }
    }
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getPropertyDefinitions(?DatasourceInterface $datasource = NULL) {
    $properties = [];

    if (!$datasource) {
      $definition = [
        'label' => $this->t('Event Year'),
        'description' => $this->t('Year the event took place.'),
        'type' => 'integer',
        'is_list' => FALSE,
        'processor_id' => $this->getPluginId(),
      ];
      $properties['event_year'] = new ProcessorProperty($definition);
    }

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function addFieldValues(ItemInterface $item) {
    $node = $item->getOriginalObject()->getValue();

    if ($node instanceof NodeInterface && $node->bundle() == 'event') {
      $fields = $this->getFieldsHelper()
        ->filterForPropertyPath($item->getFields(), NULL, 'event_year');

      foreach ($fields as $field) {
        if (!empty($node->get('field_event_search_date')->date)) {
          $year = (int) $node->get('field_event_search_date')->date->format('Y');
          $field->addValue($year);
        }
      }
    }
  }

}
