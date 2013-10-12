<?php
require_once dirname(__FILE__) . '\..\location.php';
require_once dirname(__FILE__) . '\..\weather.php';
require_once dirname(__FILE__) . '\..\locationController.php';
 
class WeatherTest extends PHPUnit_Framework_TestCase {
   
    protected function setUp() {
     parent::setUp ();
   
    }
         
    function testCanCreateALocation() {
      $location = new Location();
      echo "Location created";
    }
    
    function testCanSetAndGetALocation() {
      $location = new Location();
      $location->setLatLng('52.430286407471','-1.7572659254074');
      
      $array = array('lat' => '52.430286407471', 'lng' => '-1.7572659254074');
      
      $this->assertEquals($array,$location->getLatLng());
      
      print_r($location->getLatLng());
    }
    
    function testCanCreateAWeather() {
      $weather = new Weather();
      echo "weather created";
    }
    
    function testCanCreateALocationController() {
      $locationController = new LocationController();
      echo "LocationController created";
    }
    
    function testCanRetrieveLocationLatLng(){
      $locationController = new LocationController();
      $locationController->getLocation("b92 0pu");
      
      $location = new Location();
      $location->setLatLng('52.430286407471','-1.7572659254074');
      echo "LocationController created";
    }
   
    protected function tearDown() {
   
     parent::tearDown();
    }
   
    static function main() {
   
     $suite = new PHPUnit_Framework_TestSuite( __CLASS__);
     PHPUnit_TextUI_TestRunner::run( $suite);
    }   
 
}
if(!defined('PHPUnit_MAIN_METHOD')) {
       WeatherTest::main();
   }