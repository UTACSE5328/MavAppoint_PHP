<?php
use App\Application;

if (!function_exists('config')) {
    /**
     * Gets the values in config file
     *
     * @param string $key
     * @param null $default
     * @return mixed
     */
    function config($key, $default = null)
    {
        if (isset(Application::$container["config"])) {
            $config = Application::$container["config"];
            $keys = explode(".", $key);
            foreach ($keys as $key) {
                if (!isset($config[$key])) {
                    return $default;
                }
                $config = $config[$key];
            }
            return $config;
        }

        return $default;
    }
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;

            case 'false':
            case '(false)':
                return false;

            case 'empty':
            case '(empty)':
                return '';

            case 'null':
            case '(null)':
                return;
        }

        if (startsWith($value, '"') && endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('startsWith')) {
    /**
     * Determine if a given string starts with a given substring.
     *
     * @param  string $haystack
     * @param  string|array $needles
     * @return bool
     */
    function startsWith($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ($needle != '' && mb_strpos($haystack, $needle) === 0) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('endsWith')) {
    /**
     * Determine if a given string ends with a given substring.
     *
     * @param  string $haystack
     * @param  string|array $needles
     * @return bool
     */
    function endsWith($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ((string)$needle === mb_substr($haystack, mb_strlen($needle), null, 'UTF-8')) {
                return true;
            }
        }

        return false;
    }
}

if( !function_exists('mav_encrypt')) {
    /**
     * encrypt data
     *
     * @param $data
     * @return string
     */
    function mav_encrypt($data){
        return my_simple_crypt($data, "e");
    }
}

if( !function_exists('mav_decrypt')) {
    /**
     * decrypt data
     *
     * @param $encrypted
     * @return string
     */
    function mav_decrypt($encrypted){
        return my_simple_crypt($encrypted, "d");
    }
}

function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }

    return $output;
}