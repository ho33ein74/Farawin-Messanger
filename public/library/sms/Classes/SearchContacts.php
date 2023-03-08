<?php
    /**
     * @author Pejman Kheyri
     * @author Pejman Kheyri
     * @copyright © 2018 The Ide Pardazan (ipe.ir) PHP Group. All rights reserved.
     * @link https://web.sms.ir/ Documentation of PayamakSefid RESTful API PHP sample.
     * @version 1.0
     */
    
    class PayamakSefid_SearchContacts {
        
        /**
         * Search Contacts Url.
         *
         * @return string Indicates the Url
         */
        protected function SearchContactsUrl() {
            return "https://api.sms.ir/users/v1/Contacts/SearchContacts";
        }
        /**
         * gets Api Token Url.
         *
         * @return string Indicates the Url
         */
        protected function getApiTokenUrl(){
            return "https://api.sms.ir/users/v1/Token/GetToken";
        }
        
        /**
         * gets config parameters for sending request.
         *
         * @param string $APIKey API Key
         * @param string $SecretKey Secret Key
         * @return void
         */
        public function __construct($APIKey,$SecretKey){
            $this->APIKey = $APIKey;
            $this->SecretKey = $SecretKey;
        }
        /**
         * Search Contacts.
         *
         * @param string $prefix prefix
         * @param string $firstname firstname
         * @param string $lastname lastname
         * @param string $mobile mobile
         * @param string $groupId groupId
         * @param string $pageId pageId
         * @return string Indicates the Search Contacts result
         */
        public function SearchContacts($prefix,$firstname,$lastname,$mobile,$groupId,$pageId) {
            
            $token = $this->GetToken($this->APIKey, $this->SecretKey);
            if($token != false){
                $url = $this->SearchContactsUrl()."?prefix=".$prefix."&firstname=".$firstname."&lastname=".$lastname."&mobile=".$mobile."&groupId=".$groupId."&pageId=".$pageId;
                $SearchContacts = $this->execute($url, $token);
                
                $object = json_decode($SearchContacts);
                if(is_object($object)){
                    $result = $object;
                } else {
                    $result = 'Error Getting Object.';
                }
                
            } else {
                $result = 'Error Getting Token Key.';
            }
            return $result;
        }
        
        /**
         * gets token key for all web service requests.
         *
         * @return string Indicates the token key
         */
        private function GetToken(){
            $postData = array(
                'UserApiKey' => $this->APIKey,
                'SecretKey' => $this->SecretKey
            );
            $postString = json_encode($postData);
            $ch = curl_init($this->getApiTokenUrl());
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_POST, count($postString));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
            
            $result = curl_exec($ch);
            curl_close($ch);
            
            $response = json_decode($result);
            
            if(is_object($response)){
                if($response->IsSuccessful == true){
                    @$resp = $response->TokenKey;
                } else {
                    $resp = false;
                }
            }
            
            return $resp;
        }
        
        /**
         * executes the main method.
         *
         * @param string $url url
         * @param string $token token string
         * @return string Indicates the curl execute result
         */
        private function execute($url, $token){
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'x-sms-ir-secure-token: '.$token
            ));
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }
    }
?>