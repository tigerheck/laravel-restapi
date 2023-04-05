<?php
namespace TigerHeck\RestApi;

use Illuminate\Support\Facades\Http;
 
class RestApiService {
    
    private $base_url;
    private $token;
    private $http;

    public function __construct($base_url, $token)
    {
        $this->base_url = $base_url;
        $this->token = $token;
        $this->http = $this->http();
    }

    public function http(){
        return Http::withToken($this->token)->baseUrl($this->base_url);
    }

    public function getForms($access_by = null) {
        return self::responseCollection( $this->http->get('/platform/v1/forms'), $access_by);
    }

    public function allClients($input = [],$access_by = null) {
        return self::responseCollection( $this->http->get('/platform/v1/clients', $input), $access_by);
    }

    public function createClient($input,$access_by = null) {
        return self::responseCollection( $this->http->post('/platform/v1/clients', $input), $access_by);
    }

    public function getClient($id, $access_by = null){
        return self::responseCollection( $this->http->get('/platform/v1/clients/'.$id), $access_by);
    }

    public function updateClient($id, $input, $access_by = null){
        return self::responseCollection( $this->http->put('/platform/v1/clients/'.$id, $input), $access_by);
    }

    public function deleteClient($id, $access_by = null){
        return self::responseCollection( $this->http->delete('/platform/v1/clients/'.$id), $access_by);
    }

    private function responseCollection($response, $access_by) {
        if($response->successful()) {
            $data = $response->json($access_by);
            return collect($data);
        }
        return $response->json();
    }
}