<?php

// ejemplo de autenticación
$ldaprdn  = $_POST["usuario"];   // ldap rdn or dn
$ldappass = $_POST["contra"];   // associated password

// conexión al servidor LDAP
$ldapconn = ldap_connect("ambiente.gob.sv")
    or die("Could not connect to LDAP server.");

if ($ldapconn) {

    // realizando la autenticación
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

    // verificación del enlace
    if ($ldapbind) {
        echo "LDAP bind successful...";
    } else {
        echo "LDAP bind failed...";
    }

}

?>