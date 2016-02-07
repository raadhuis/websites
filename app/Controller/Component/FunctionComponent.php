<?php
App::uses('Component', 'Controller');

class FunctionComponent extends Component
{
    public function domainToUsername($domain, $charLimit = 10)
    {
        $domain = str_replace('.', '', $domain);
        $domain = str_replace('-', '', $domain);
        $domain = substr($domain, 0, $charLimit);
        return $domain;
    }

    public function generatePassword($length = 10)
    {
        $password = "";

        $possible = "234678&%^*9#@!bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

        $maxlength = strlen($possible);

        if ($length > $maxlength) {
            $length = $maxlength;
        }

        $i = 0;

        while ($i < $length) {

            // pick a random character from the possible ones
            $char = substr($possible, mt_rand(0, $maxlength - 1), 1);

            // have we already used this character in $password?
            if (!strstr($password, $char)) {
                // no, so it's OK to add it onto the end of whatever we've already got...
                $password .= $char;
                // ... and increase the counter by one
                $i++;
            }

        }

        // done!
        return $password;

    }

    public function socket($da_host, $da_username, $da_password)
    {
        App::import('Vendor', 'directadmin/httpsocket');
        $sock = new HTTPSocket;
        $sock->connect($da_host, '2222');
        $sock->set_login($da_username, $da_password);
        return $sock;
    }

    public function add_pointerdomain($da_host, $domain, $da_domain, $username, $password)
    {
        $sock = $this->socket($da_host, $username, $password);

        $sock->query('/CMD_API_DOMAIN_POINTER',
            array(
                'action' => 'add',
                'domain' => $da_domain,
                'from' => $domain,
                'alias' => 'yes'
            ));
        $result = $sock->fetch_parsed_body();

        if ($result['error'] != "0") {
            pr($result);
            die();
            return false;
        }
        return true;
    }

    function create_db($da_host, $da_username, $da_password, $database_name, $database_username, $database_password)
    {
        $sock = $this->socket($da_host, $da_username, $da_password);

        $sock->query('/CMD_API_DATABASES',
            array(
                'name' => $database_name,
                'user' => $database_username,
                'passwd' => $database_password,
                'passwd2' => $database_password,
                'action' => 'create'
            ));

        $result = $sock->fetch_parsed_body();

        if ($result['error'] != "0") {
            pr($result);
            echo "<b>Error adding database:<br>\n";
            echo $result['text'] . "<br>\n";
            echo $result['details'] . "<br></b>\n";
            var_dump($result);
        }
    }

    function create_user($da_host, $da_username, $da_password, $username, $domain, $email, $password, $package, $ip)
    {
        $sock = $this->socket($da_host, $da_username, $da_password);

        $sock->query('/CMD_API_ACCOUNT_USER',
            array(
                'action' => 'create',
                'add' => 'Submit',
                'username' => $username,
                'email' => $email,
                'passwd' => $password,
                'passwd2' => $password,
                'domain' => $domain,
                'package' => $package,
                'ip' => $ip,
                'notify' => 'no'
            ));
        $result = $sock->fetch_parsed_body();
        if ($result['error'] != "0") {
            return false;
        }
        return true;
    }
}

?>