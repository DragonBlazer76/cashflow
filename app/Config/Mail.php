<?php
/**
 * Mailer Configuration
 *
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */

use Nova\Config\Config;


Config::set('mail', array(
    'driver' => 'smtp',
    'host'   => 'smtp.webfaction.com',
    'port'   => 587,
    'from'   => array(
        'address' => 'parse@cashflow.to',
        'name'    => 'Admin',
    ),
    'encryption' => 'tls',
    'username'   => 'parser',
    'password'   => 'Cashflow_to!',
    'sendmail'   => '/usr/sbin/sendmail -bs',

    // Whether or not the Mailer will pretend to send the messages.
    'pretend' => false,
));
