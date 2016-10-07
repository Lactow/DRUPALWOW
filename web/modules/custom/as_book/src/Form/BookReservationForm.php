<?php

namespace Drupal\as_book\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class BookReservationForm.
 *
 * @package Drupal\as_book\Form
 */
class BookReservationForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'book_reservation_form';
  }

  /**
   * va construire un form, pour l'afficher en html
   * $form : renderable_array
   * *for_state : etat du formulaire (post/get like). Objet
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    //gestion de permission pour voir le bloc ou nonl
    $user = \Drupal::currentUser();
    if($user->hasPermission('access book resa control center')){

      $form['book_id'] = [
        '#type' => 'hidden',
        '#title' => $this->t('book_id'),
      ];
      $form['user_id'] = [
        '#type' => 'hidden',
        '#title' => $this->t('user_id'),
      ];

      $form['submit'] = [
          '#type' => 'submit',
          '#value' => t('Book me !'),
      ];

      return $form;
    }
    return ['#markup'=>'access denied'];
  }

  /**
    * validation du form
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    //si la val des champs === formstate val

  }

  /**
   * recuperation du form
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
        drupal_set_message($key . ': ' . $value);
    }
//on recup l'obj ici
    $node = \Drupal\node\Entity\Node::create([
      'title'   => 'Reservation numero : '.$book_id.'-'.$user_id,
      'status'  => 1,
      'field_book'  => $book_id,
      'field_member' => $user_id
    ]);
    // la fonction save est dispo direectement comme cela, des qu'on a mis son
    // namespace.
    if($node->save()){
      drupal_set_message('resa ok', 'status');
    }
    else{
      drupal_set_message('reso nok pb', 'status');
    }
  //  $node->get('field_book')->getValue();
  }

}
