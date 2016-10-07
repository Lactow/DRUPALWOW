<?php

namespace Drupal\as_book\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'BookingBlock' block.
 *
 * @Block(
 *  id = "booking_block",
 *  admin_label = @Translation("Booking block"),
 * )
 */
class BookingBlock extends BlockBase {

  
  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
         'book_id' => $this->t(''),
         'user_id' => $this->t(''),
         'book_me' => $this->t('submit'),
        ] + parent::defaultConfiguration();
  
 }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['book_id'] = [
      '#type' => 'hidden',
      '#title' => $this->t('book_id'),
      '#description' => $this->t(''),
      '#default_value' => $this->configuration['book_id'],
      '#weight' => '0',
    ];
    $form['user_id'] = [
      '#type' => 'hidden',
      '#title' => $this->t('user_id'),
      '#description' => $this->t(''),
      '#default_value' => $this->configuration['user_id'],
      '#weight' => '0',
    ];
    $form['book_me'] = [
      '#type' => 'submit',
      '#title' => $this->t('Book me !'),
      '#description' => $this->t(''),
      '#default_value' => $this->configuration['book_me'],
      '#weight' => '0',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['book_id'] = $form_state->getValue('book_id');
    $this->configuration['user_id'] = $form_state->getValue('user_id');
    $this->configuration['book_me'] = $form_state->getValue('book_me');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['booking_block_book_id']['#markup'] = '<p>' . $this->configuration['book_id'] . '</p>';
    $build['booking_block_user_id']['#markup'] = '<p>' . $this->configuration['user_id'] . '</p>';
    $build['booking_block_book_me']['#markup'] = '<p>' . $this->configuration['book_me'] . '</p>';

    return $build;
  }

}
