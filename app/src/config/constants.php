<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


# archivo de estaticos, enlaces
$is_local = false;
$url_base = ($is_local) ? 'http://192.168.0.198/' : 'http://179.49.60.158/';



#constanres definicion
$enterprises_data = array(
    'test' => array (
        'nombre' => 'AMBIENTE DE PRUEBAS TEST LOCAL',
        'enterprise' => 'test',
        'ruc' => '1722919725001',
        'direccion'=> 'COLON 1133 Y AMAZONAS',
        'telefono'=> '022405911',
        'email' => 'eduardouio7@gmail.com',
        'path_log' => '/var/www/html/src/logs/',
        'url_logo' => 'https://sts-ndt.com/cordovez/statics/img/logo_test.png',
        'url_favicon' => 'https://sts-ndt.com/cordovez/statics/img/imnac.ico',
        'base_url' => $url_base,
        'sgi_url' => 'http://179.49.60.158:5001/',
        'db' => [
            'hostname' => 'host.docker.internal',
            'username' => 'cordovez',
            'password' => 'E##$%%lian.2011',
            'database' => 'appCordovez',
        ]

    ),
    'cordovez' => array(
        'nombre' => 'AGENCIAS Y REPRESENTACIONES CORDOVEZ S.A.',
        'enterprise' => 'cordovez',
        'ruc' => '1790023516001',
        'direccion' => 'AV. 10 DE AGOSTO N.57-186 Y LEONARDO MURIALDO ',
        'telefono' => '022405911',
        'email'  => 'sgi@cordovez.com.ec',
        'path_log' => '/var/www/html/cordovez/src/logs/',
        'url_logo' => 'https://sts-ndt.com/cordovez/statics/img/logo_cordovez.jpg',
        'url_favicon' => 'https://sts-ndt.com/cordovez/statics/img/cordovez.ico',
        'base_url' => 'http://179.49.60.158:8888/cordovez/',
        'local_url' => 'http://192.168.0.198/cordovez/app/',
        'sgi_url' => 'http://179.49.60.158:5001/',
        'db' => [
            'hostname' => '192.168.0.198',
            'username' => 'appCordovez',
            'password' => '\DBGfW<7;vBa5(LB',
            'database' => 'cordovezApp',
        ]
    ),
    'imnac' => array (
        'nombre' => 'IMNAC IMPORTADORA NACIONAL CIA LTDA',
        'enterprise' => 'imnac',
        'ruc' => '1792324289001',
        'direccion'=> 'LA PAZ PAUL RIVET 227 Y JAMES ORTON',
        'telefono'=> '022405911',
        'email' => 'sgi@imnac.com.ec',
        'path_log' => '/var/www/html/imnac/src/logs/',
        'url_logo' => 'https://sts-ndt.com/cordovez/statics/img/logo_imnac.jpg',
        'url_favicon' => 'https://sts-ndt.com/cordovez/statics/img/imnac.ico',
        'base_url' => 'http://179.49.60.158:8888/imnac/',
        'local_url' => 'http://192.168.0.198/imnac/app/',
        'sgi_url' => 'http://179.49.60.158:5002/',
        'db' => [
            'hostname' => '192.168.0.198',
            'username' => 'appCordovez',
            'password' => '\DBGfW<7;vBa5(LB',
            'database' => 'imnacApp',
        ]
    ),
     'rev' => array (
        'nombre' => 'REV ECUADOR S.A.',
        'enterprise' => 'rev',
        'ruc' => '1792233763001',
        'direccion'=> '10 DE AGOSTO 9922 Y LEONARDO MURIALDO',
        'telefono'=> '022409237',
        'email' => 'evillota@vinesa.com.ec',
        'path_log' => '/var/www/html/rev/src/logs/',
        'url_logo' => 'https://sts-ndt.com/cordovez/statics/img/logo_rev.jpg',
        'url_favicon' => 'https://sts-ndt.com/cordovez/statics/img/rev.ico',
        'base_url' => 'http://179.49.60.158:8888/rev/',
        'local_url' => 'http://192.168.0.198/rev/app/',
        'sgi_url' => 'http://179.49.60.158:5004/',
        'db' => [
            'hostname' => '192.168.0.198',
            'username' => 'appCordovez',
            'password' => '\DBGfW<7;vBa5(LB',
            'database' => 'revApp',
        ]
    ),
    'vid' => array(
        'nombre' => 'VIDINTERNACIONAL S.A.',
        'enterprise' => 'vid',
        'ruc' => '1791771907001',
        'direccion'=> 'AV. 10 DE AGOSTO N.57-186 Y LEONARDO MURIALDO',
        'telefono'=> '022405911',
        'email' => 'sgi@vidinternacional.com.ec',
        'path_log' => '/var/www/html/vid/src/logs/',
        'url_logo' => 'https://sts-ndt.com/cordovez/statics/img/logo_vid.jpg',
        'url_favicon' => 'https://sts-ndt.com/cordovez/statics/img/vid.ico',
        'base_url' => 'http://179.49.60.158:8888/vid/',
        'local_url' => 'http://192.168.0.198/vid/app/',
        'sgi_url' => 'http://179.49.60.158:5003/',
        'db' => [
            'hostname' => '192.168.0.198',
            'username' => 'appCordovez',
            'password' => '\DBGfW<7;vBa5(LB',
            'database' => 'vidApp',
        ]
    ));

#Selecciona la empresa para la instancia
$selected_enterprise = $enterprises_data['test'];
