<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Configuration;
use Kreait\Firebase\Firebase;

class SwaggerClient extends BaseController{
    private $firebase_client;
    private $firebase_config;
    private $swagger_products_instance;
    private $swagger_product_instance;

    public function __construct(){
        $this->firebase_config = new Configuration();
        $this->firebase_config->setAuthConfigFile( base_path('firebase.json') );
        $this->firebase_client = new Firebase('https://meow-api.firebaseio.com/', $this->firebase_config);
        
        $this->swagger_products_instance = new \Swagger\Client\Api\ProductsApi();
        $this->swagger_product_instance = new \Swagger\Client\Api\ProductApi();
    }
    
    public function swaggerGetAllProducts(){
        $result = $this->swagger_products_instance->productsGet();
        return $response->json($result);
    }

    public function swaggerGetSpecificProductInformation(Request $request, $id){
        $result = $this->swagger_product_instance->productIdGet($id);
        return $response->json($result);
    }
    public function swaggerAddNewProduct(Request $request){
        $result = $this->swagger_product_instance->productPut($id);
        return $response->json($result);
    }
    public function swaggerUpdateProductInformation(Request $request){
        $result = $this->swagger_product_instance->productPatch();
        return $response->json($result);
    }
    public function swaggerDeleteProduct(Request $request, $id){
        $result = $this->swagger_product_instance->productDelete($id);
        return $response->json($result);
    }
}