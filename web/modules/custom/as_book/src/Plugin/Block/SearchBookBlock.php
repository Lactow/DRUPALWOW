<?php

namespace Drupal\as_book\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'SearchBookBlock' block.
 * Can take in $_GET the string for search and pass it to DB
 *
 * @Block(
 *  id = "search_book_block",
 *  admin_label = @Translation("Search book block"),
 * )
 */
class SearchBookBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form= \Drupal::formBuilder()->getForm('Drupal\as_book\Form\searchBookForm');

    $build = [];
    $build['search_book_block'] = $form;

    return $build;
  }

}
