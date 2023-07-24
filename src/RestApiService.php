<?php
namespace TigerHeck\RestApi;

use Illuminate\Support\Facades\Http;
use TigerHeck\RestApi\Models\RestapiToken;
 
class RestApiService {
    
    private $base_url;
    private $client_id;
    private $scope;
    private $client_secret;
    private $grant_type;
    private $url_access_token;
    private $http;

    public function __construct()
    {
        $this->base_url = config('restapi.base_url');
        $this->client_id =  config('restapi.clientId');
        $this->scope = config('restapi.scopes');
        $this->client_secret = config('restapi.clientSecret');
        $this->grant_type = config('restapi.grant_type');
        $this->url_access_token = config('restapi.urlAccessToken');
        $this->http = $this->http();
    }

    public function http(){
        $accessToken = $this->getAccessToken();
        return Http::withToken($accessToken)->baseUrl($this->base_url);
    }

    private function getAccessToken($token_type = 'Bearer') {
        $model = RestapiToken::where('token_type', 'Bearer')->whereRaw("TIME_TO_SEC(TIMEDIFF(CURRENT_TIMESTAMP, created_at)) < expires_in")->first();
        if(!$model) {
            $model = $this->generateAccessToken();
        }
        if($model && $model instanceof RestapiToken) {
            return $model->access_token;
        }
        
        return false;
    }


    public function generateAccessToken() {
        $access_request_data = config('restapi.access_request_data') ?? [];

        $response = Http::asForm()->post($this->url_access_token,[
            "client_id"     =>  $this->client_id,
            "scope"         =>  $this->scope,
            "client_secret" =>  $this->client_secret,
            "grant_type"    =>  $this->grant_type,
        ] + (is_array($access_request_data) ? $access_request_data : []));
        
        $data = $response->json();
        if($response->successful()) {
            return $this->storeAccessToken( $data );
        }
        if(isset($data['error_description']) && is_string($data['error_description'])) {            
            throw new \Exception($data['error_description']);
        }
        return $data;
    }

    private function storeAccessToken($data) {
        return $data ? RestapiToken::create($data) : false;
    }

    public function get($endpoint = '/', $data = '', $access_by = null) {
        return self::responseCollection( $this->http->get($endpoint, $data), $access_by);
    }

    public function post($endpoint = '/', $data = [], $access_by = null) {
        return self::responseCollection( $this->http->post($endpoint, $data), $access_by);
    }

    public function put($endpoint = '/', $data = [], $access_by = null) {
        return self::responseCollection( $this->http->put($endpoint, $data), $access_by);
    }

    public function patch($endpoint = '/', $data = [], $access_by = null) {
        return self::responseCollection( $this->http->patch($endpoint, $data), $access_by);
    }

    public function delete($endpoint = '/', $data = [], $access_by = null) {
        return self::responseCollection( $this->http->delete($endpoint, $data), $access_by);
    }

    private function responseCollection($response, $access_by) {
        if($response->successful()) {
            $data = $response->json($access_by);
            return collect($data);
        }
        return $response->json();
    }
}