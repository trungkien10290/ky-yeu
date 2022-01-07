<?php

namespace App\Services;

class AdService
{
    private $host = "";
    private $port = "";

    public function __construct()
    {
        $this->host = env('LDAP_HOST', '10.14.0.9');
        $this->port = env('LDAP_PORT', 389);
    }

    private function connect()
    {
        $conn = ldap_connect($this->host, $this->port);
        ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);

        return $conn;
    }

    private function close($conn)
    {
        ldap_unbind($conn);
    }

    public function bind($user, $password)
    {
        try {
            $conn = $this->connect();

            ldap_bind($conn, $user, $password);

            $this->close($conn);

            return true;
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return false;
        }
    }
}
