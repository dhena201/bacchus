<?php

/**
 * Adegga API Core Wrapper
 * Handles basic requests and parameters
 * https://github.com/corefactor/Adegga-PHP-API-Wrapper
 * @package AdeggaAPI
 * @author Rui Cruz
 */
Class AdeggaCore {
        
        protected $api_key = null;
        
        protected $request_format = null;
        
        protected $api_endpoint = 'http://api.adegga.com/rest/v1.0/';
        
        private $log = null;
        
        protected $cache_folder = null;
        
        protected $cache_identifier = 'adegga';
        
        protected $cache_lifetime = null;
        
        
        function __construct($api_key, $cache_folder = null, $cache_lifetime = '+5 minutes', $api_endpoint = null) {

                $this->api_key = $api_key['api_key'];
            
                $this->cache_folder = $cache_folder;
                
                $this->cache_lifetime = $cache_lifetime;
                
                if (!is_null($api_endpoint)) {
                        
                        $this->api_endpoint = $api_endpoint;
                        
                }
                
        }
        
        /**
         * Handmade API requests
         *
         * @param string $method 
         * @param array $params 
         * @param string $format 
         * @return mixed
         * @author Rui Cruz
         */
        public function get($method, $params = array(), $format = 'json') {
                
                if (empty($this->api_key)) {
                        trigger_error('No API key defined', E_USER_ERROR);
                        return false;
                }
                
                $this->request_format = $format;
                
                if (method_exists($this, $method)) {
                        
            $result = call_user_func_array(array($this, $method), $params);
                        return $result;
                        
        } else {

                        #trigger_error(sprintf('Method: %s not defined in the API Wrapper', $method), E_USER_ERROR);
                        return $this->makeRequest($method, $params);
        
                }
        
        }
        
        protected function buildRequest($method, $params = null) {
                
                $param_str = null;
                
                foreach($params as $param) {
                        $param_str .= '/' . $param;
                }

                return sprintf('%s%s%s/&format=%s&key=%s', $this->api_endpoint, $method, $param_str, $this->request_format, $this->api_key);
                
        }
        
        protected function makeRequest($method, $params = null) {

                $request_url = $this->buildRequest($method, $params);
                
                # CHECK CACHE
                $response = $this->getCache($request_url);
                
                if ($response === false) {
                
                        $response = file_get_contents($request_url);
                        
                        if ($response !== false) {
                                
                                $this->setCache($request_url, $response);
                                
                        }
                        
                }
                
                if ($this->request_format == 'json' && $response !== false) {
                        
                        $response = json_decode($response);
                        
                }
                
                $this->log($request_url, $response);
                
                return $response;
                
        }
        
        
        protected function setCache($request_url, $response) {
                
                if (is_null($this->cache_folder)) return false;
                
                $request_url_hash = $this->cache_identifier . '_' . md5($request_url);
                
                file_put_contents($this->cache_folder . $request_url_hash, $response);
                
        }
        
        /**
         * Get cached response for the given URL
         *
         * @param string $request_url 
         * @return mixed
         * @author Rui Cruz
         */
        protected function getCache($request_url) {
                
                if (is_null($this->cache_folder)) return false;
                
                $request_url_hash = $this->cache_identifier . '_' . md5($request_url);
                
                if (!file_exists($this->cache_folder . $request_url_hash)) {
                        
                        return false;
                        
                } elseif ( strtotime($this->cache_lifetime, filemtime($this->cache_folder . $request_url_hash)) < time() ) {
                        
                        # CACHE EXPIRED, REMOVE FILE
                        unlink($this->cache_folder . $request_url_hash);
                        return false;
                        
                } else {
                        
                        return file_get_contents($this->cache_folder . $request_url_hash);
                        
                }
                
        }
        
        /**
         * Logs every request URL and response
         *
         * @param string $request_url 
         * @param mixed $response 
         * @return void
         * @author Rui Cruz
         */
        protected function log($request_url, $response) {
                
                $this->log[] = array('request' => $request_url, 'response' => $response);
                
        }
        
        /**
         * Returns the request / response log
         *
         * @return array
         * @author Rui Cruz
         */
        public function getLog() {
                
                return $this->log;
                
        }
        
}