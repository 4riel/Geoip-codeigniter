<?php (defined('BASEPATH') OR defined('SYSPATH')) or die('No direct access allowed.');

/**
* Geoip Location Online Class using api of ipinfodb.com
*
* @package          CodeIgniter
* @subpackage       Application/Libraries
* @category         Libraries
* @resource         api.ipinfodb.com
* @autor            Ariel Marti
*/
// ------------------------------------------------------------------------

/*
Instructions:

//IMPORTANTE: primero debes crearte una cuenta gratis en http://api.ipinfodb.com y obtener una clave y cambiar el valor de $_key en la clase
//IMPORTANT:you must first create an free account in http://api.ipinfodb.com and obtain a key and change the value of $_key in the class

//Load the library.
$this->load->library('geoip');

//Ingresa una IP o nada, en su defecto se carga: $this->CI->input->ip_address()
//Enter an IP Address or null,default load: $this->CI->input->ip_address()
$this->geoip->geolocalization("181.110.XXX.XXX");

//Una vez cargado puedes obtener los detalles de geo localizacion del usuario mediante su IP
//Once loaded you can get user's geo location details by IP address

echo $this->geoip->info->countryName; //return Argentina
echo $this->geoip->info->cityName; //return Buenos Aires

RETURNED DATA JSON OBJECT
{
	"statusCode" : "OK",
	"statusMessage" : "",
	"ipAddress" : "181.110.XXX.XXX",
	"countryCode" : "AR",
	"countryName" : "Argentina",
	"regionName" : "Distrito Federal",
	"cityName" : "Buenos Aires",
	"zipCode" : "1871",
	"latitude" : "35.6552",
	"longitude" : "-31.57*2",
	"timeZone" : "-03:00"
}
*/

class Geoip{
    //CI
    protected $CI;
    protected $_gi;

    //CLASS
    protected $_Ip;
    protected $_Data;
    //Clave Obtenida | Key obtained.
    protected $_key = "ENTER YOUR KEY ACCOUNT HERE BITCH";

    function __construct()
    {
        if (!isset($this->CI))
        {
            $this->CI =& get_instance();
        }
    }

    function __destruct() {

        if (isset($this->_gi))
        {
            geoip_close($this->_gi);
        }
    }

    function geolocalization($ip = null)
    {
        if ($this->_Set_IP($ip)) {
            $this->_Data = json_decode(file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=$this->_key&ip=$ip&format=json"));
            return true;
        }
        else
            return false;
    }

    function info() {
        return $this->_Data;
    }


    private function _Set_IP($ip=null){

        if($ip==null)
        {
            $ip = $this->CI->input->ip_address();
        }

        $this->_Ip = $ip;
        return $this->CI->input->valid_ip($this->_Ip);
    }



}
