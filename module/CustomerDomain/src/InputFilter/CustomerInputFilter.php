<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerDomain\InputFilter;

use Zend\Filter\StringTrim;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\InArray;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

/**
 * Class CustomerInputFilter
 *
 * @package CustomerDomain\InputFilter
 */
class CustomerInputFilter extends InputFilter
{
    /**
     *
     */
    public function init()
    {
        $firstName = $this->factory->createInput(['name' => 'first_name']);
//        $firstName->setRequired(true);
        $firstName->getFilterChain()->attachByName(StringTrim::class);
        $firstName->getValidatorChain()->attachByName(
            NotEmpty::class,
            [
                'message'                => 'Bitte Vornamen eingeben!',
                'break_chain_on_failure' => true,
            ]
        );
        $firstName->getValidatorChain()->attachByName(
            StringLength::class,
            [
                'min'     => 2,
                'max'     => 64,
                'message' => 'Vorname ist zu kurz oder lang',
            ]
        );

        $lastName = $this->factory->createInput(['name' => 'last_name']);
        $lastName->setRequired(true);
        $lastName->getFilterChain()->attachByName(StringTrim::class);
        $lastName->getValidatorChain()->attachByName(
            NotEmpty::class,
            [
                'message'                => 'Bitte Nachnamen eingeben!',
                'break_chain_on_failure' => true,
            ]
        );
        $lastName->getValidatorChain()->attachByName(
            StringLength::class,
            [
                'min'     => 2,
                'max'     => 64,
                'message' => 'Nachname ist zu kurz oder lang',
            ]
        );

        $country = $this->factory->createInput(['name' => 'country']);
        $country->setRequired(true);
        $country->getValidatorChain()->attachByName(
            InArray::class,
            [
                'haystack' => ['de', 'at', 'ch'],
                'message'  => 'Unbekanntes Land',
            ]
        );

        $email = $this->factory->createInput(['name' => 'email']);
        $email->setRequired(true);
        $email->getValidatorChain()->attachByName(
            NotEmpty::class,
            [
                'message'                => 'Bitte E-Mail Adresse eingeben!',
                'break_chain_on_failure' => true,
            ]
        );
        $email->getValidatorChain()->attachByName(
            EmailAddress::class,
            [
                'message' => 'E-Mail ist falsch',
            ]
        );

        $password = $this->factory->createInput(['name' => 'password']);
        $password->setRequired(false);


        $this->add($firstName);
        $this->add($lastName);
        $this->add($country);
        $this->add($email);
        $this->add($password);
    }
}
