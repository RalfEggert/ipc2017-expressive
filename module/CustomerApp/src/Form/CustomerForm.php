<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerApp\Form;

use Zend\Form\Element\Email;
use Zend\Form\Element\Password;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

/**
 * Class CustomerForm
 *
 * @package CustomerApp\Form
 */
class CustomerForm extends Form
{

    /**
     *
     */
    public function init()
    {
        $this->setName('customer_form');
        $this->setAttribute('class', 'form-horizontal');

        $firstName = $this->factory->createElement(['type' => Text::class]);
        $firstName->setName('first_name');
        $firstName->setLabel('Vorname');
        $firstName->setAttribute('class', 'form-control');

        $lastName = $this->factory->createElement(['type' => Text::class]);
        $lastName->setName('last_name');
        $lastName->setLabel('Nachname');
        $lastName->setAttribute('class', 'form-control');

        /** @var Select $country */
        $country = $this->factory->createElement(['type' => Select::class]);
        $country->setName('country');
        $country->setLabel('Land');
        $country->setAttribute('class', 'form-control');
        $country->setValueOptions(
            [
                'de' => 'Deutschland',
                'ch' => 'Schweiz',
                'at' => 'Österreich',
            ]
        );

        /** @var Email $email */
        $email = $this->factory->createElement(['type' => Email::class]);
        $email->setName('email');
        $email->setLabel('E-Mail Adresse');
        $email->setAttribute('class', 'form-control');

        /** @var Password $password */
        $password = $this->factory->createElement(['type' => Password::class]);
        $password->setName('password');
        $password->setLabel('Passwort');
        $password->setAttribute('class', 'form-control');

        /** @var Submit $submit */
        $submit = $this->factory->createElement(['type' => Submit::class]);
        $submit->setName('save_customer');
        $submit->setValue('Speichern');
        $submit->setAttribute('class', 'btn btn-primary');

        $this->add($firstName);
        $this->add($lastName);
        $this->add($country);
        $this->add($email);
        $this->add($password);
        $this->add($submit);
    }

}