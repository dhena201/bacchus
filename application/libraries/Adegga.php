<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Extends AdeggaCore with Public methods 
 * https://github.com/corefactor/Adegga-PHP-API-Wrapper
 * @package AdeggaAPI
 * @author Rui Cruz
 */
class Adegga extends AdeggaCore {
        
        /**
         * Overload the AdeggaCore constructor to set the default $request_format
         *
         * @param string $api_key 
         * @param string $request_format 
         * @param string $api_endpoint 
         * @author Rui Cruz
         */
        function __construct($api_key, $cache_folder = null, $cache_lifetime = '+1 hour', $request_format = 'json', $api_endpoint = null) {
                
                parent::__construct($api_key, $cache_folder, $cache_lifetime, $api_endpoint = null);
             
                $this->request_format = $request_format;
        
        }
        
        /**
         * Get wine information using an AVIN code
         *
         * @param string $avin 
         * @param int $vintage 
         * @param int $country 
         * @param int $type 
         * @param string $producer 
         * @return mixed wine list
         * @author Rui Cruz
         */
        public function getWineByAvin($avin, $vintage = null, $country = 0, $type = 0, $producer = null) {
                
                $args = func_get_args();
                
                $response = $this->makeRequest('GetWineByAvin', $args);
                
                if ($response !== false) {
                        
                        return $response->response->aml->wines->wine[0];
                        
                }
                
                return false;
                
        }
        
        /**
         * Get producer information using the producer ID
         *
         * @param int $id
         * @param int $country
         * @return void
         * @author Rui Cruz
         */
        public function getProducerByID($id, $country = 0) {
                
                $args = func_get_args();
                
                $response = $this->makeRequest('GetProducerByID', $args);
                
                if ($response !== false) {
                        
                        return $response->response->aml->producers->producer[0];
                        
                }
                
                return false;
                
        }
        
		/**
         *Gets a list of countries you can use for filtering wines and producers.
         *
         * @param null
         * @return array country list
         * @author Lou Schlessinger
         */
        public function GetCountries() {
                
                $args = func_get_args();
                
                $response = $this->makeRequest('GetCountries', $args);
                
                if ($response !== false) {
                        
                        return $response->response->aml->countries->country;
                        
                }
                
                return false;
                
        }      
		
		/**
         * Gets a list of wine types you can filter wines and producers
         *
         * @param null
         * @return array wine type list
         * @author Lou Schlessinger
         */
        public function GetWineTypes() {
                
                $args = func_get_args();
                
                $response = $this->makeRequest('GetWineTypes', $args);
                
                if ($response !== false) {
                        
                	return $response->response->aml->wine_types->wine_type;
                        
                }
                
                return false;
                
        }      
		
		/**
         * Gets a producer by name.
         *
         * @param string $producer_name
         * @param int $country
         * @param int $page
         * @param string $sortorder --- asc/desc
         * @param string $sortby --- name/longname/country
         * @return array producers list
         * @author Lou Schlessinger
         */
        public function GetProducersByName($producer_name, $country = 0, $page = 1, $sortorder = 'desc', $sortby = 'name') {

                $args = func_get_args();
  				
				// prep the name query for the url
				$args[0] = rawurlencode($producer_name);
                $response = $this->makeRequest('GetProducersByName', $args);
                
                if ($response !== false) {
                        
                	return $response->response->aml->producers->producer;
                        
                }
                
                return false;
                
        }  
		
		/**
         * Gets wine by name
         *
         * @param string $wine_name
         * @param int $vintage
         * @param int $country
         * @param int $type
         * @param string $producer
         * @param int $page
         * @param string $sortorder --- asc/desc
         * @param string $sortby --- name/vintage/producer/adeggarating
         * @return array wine list
         * @author Lou Schlessinger
         */
        public function GetWinesByName($wine_name, $vintage = null, $country = 0, $type = 0, $producer = null, $page = 1, $sortorder = 'desc', $sortby = 'name') {

                $args = func_get_args();
  				
				// prep the name query for the url
				$args[0] = rawurlencode($wine_name);
                $response = $this->makeRequest('GetWinesByName', $args);
                
                if ($response !== false) {
                        
                	return $response->response->aml;
                        
                }
                
                return false;
                
        }  
}