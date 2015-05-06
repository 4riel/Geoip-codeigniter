<?php (defined('BASEPATH') OR defined('SYSPATH')) or die('No direct access allowed.');

/**
* Geoip Location Online Class using api of ipinfodb.com
*
* @package          CodeIgniter
* @subpackage       Application/Libraries
* @category         Libraries
* @resource         api.ipinfodb.com
* @autor            Ariel Marti
*
* Instructions in readme
Recuerda que si la clave no funciona, obtenla en http://www.ipinfodb.com/
Remember if the key doesn't work, get in http://www.ipinfodb.com/
*
* $this->load->library('geoip');
* $this->geoip->geolocalization("181.110.XXX.XXX");
* echo $this->geoip->info->countryName; //return Argentina
* echo $this->geoip->info->cityName; //return Buenos Aires
*
* RETURNED DATA JSON OBJECT
*{
*    "statusCode" : "OK",
*    "statusMessage" : "",
*    "ipAddress" : "181.110.XXX.XXX",
*    "countryCode" : "AR",
*    "countryName" : "Argentina",
*    "regionName" : "Distrito Federal",
*    "cityName" : "Buenos Aires",
*    "zipCode" : "1871",
*    "latitude" : "35.6552",
*    "longitude" : "-31.57*2",
*    "timeZone" : "-03:00"
*}
*/

// ------------------------------------------------------------------------




class Geoip{
    //CI
    protected $CI;
    protected $_gi;

    //CLASS
    protected $_Ip;
    protected $_Data;
    //Clave Obtenida | Key obtained.
    protected $_key = "48e9a12e7c98df764fca3b69ec790aa799bcf34dc14e42aa2925ef870fd5d22b";

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
