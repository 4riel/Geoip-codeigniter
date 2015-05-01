# Geolocalization IP Online
Sencilla libreria para el framework Codeigniter, para localizar una ip mediante la api online de ipinfodb.com.
Simple library for CodeIgniter framework to locate ip by online ipinfodb.com APIs.


##Instructions:

###IMPORTANTE: primero debes crearte una cuenta gratis en http://api.ipinfodb.com y obtener una clave y cambiar el valor de $_key en la clase
###IMPORTANT:you must first create an free account in http://api.ipinfodb.com and obtain a key and change the value of $_key in the class

Load the library.
´$this->load->library('geoip');´

//Ingresa una IP o nada, en su defecto se carga: $this->CI->input->ip_address()
//Enter an IP Address or null,default load: $this->CI->input->ip_address()
´$this->geoip->geolocalization("181.110.XXX.XXX");´

//Una vez cargado puedes obtener los detalles de geo localizacion del usuario mediante su IP
//Once loaded you can get user's geo location details by IP address

´echo $this->geoip->info->countryName; //return Argentina
echo $this->geoip->info->cityName; //return Buenos Aires´

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

