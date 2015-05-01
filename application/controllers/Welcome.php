<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->library('geoip');
		$this->geoip->geolocalization('181.110.139.199');
		echo "Country: ". $this->geoip->info()->countryName ."<br>";
		echo "Country Code: " . $this->geoip->info()->countryCode ."<br>";
		echo "City: " . $this->geoip->info()->cityName ."<br>"; 
		echo "Region: " . $this->geoip->info()->regionName ."<br>";
		
		echo "Zip Code: " . $this->geoip->info()->zipCode ."<br>";
		echo "Time Zone: " . $this->geoip->info()->timeZone ."<br>";
		echo "Latitude: " . $this->geoip->info()->latitude ."<br>";
		echo "Longitude: " . $this->geoip->info()->longitude ."<br>";

	}
}
