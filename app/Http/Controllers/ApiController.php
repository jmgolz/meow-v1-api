<?php
namespace App\Http\Controllers;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Kreait\Firebase\Configuration;
use Kreait\Firebase\Firebase;

class ApiController extends BaseController
{
    private $mock_products = array(
            array(
                'title' => 'product one',
                'description' => 'this is product one',
                'in_stock' => false,
                'product_code' => 1024
            ),
            array(
                'title' => 'product two',
                'description' => 'this is product TWO',
                'in_stock' => true,
                'product_code' => 3412
            )
    );
    
    private $firebase_client;
    private $firebase_config;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->firebase_config = new Configuration();
        $this->firebase_config->setAuthConfigFile( base_path('firebase.json') );
        $this->firebase_client = new Firebase('https://meow-api.firebaseio.com/', $this->firebase_config);
    }

    public function get_all_products(){
        $result = $this->firebase_client->get('products');
        return response()->json($result);
    }

    public function get_product(Request $request, $id){
        $result = $this->firebase_client->get('products/'.$id);
        return response()->json($result);
    }

    public function api_root(){
        //echo "<h1>IT WORKS!</h1>";
        $api_instance = new \Swagger\Client\Api\ProductsApi();
        $result = $api_instance->productsGet();
        echo "<pre>".print_r($result, true)."</pre>";
    }

    public function create_new_product(Request $request){
        $result = $this->firebase_client->push($request->all(), 'products');
        return response()->json($result);
    }

    /* Uses Patch HTTP method to make updates.
     * json merge structure is:
     * [{ "op": "replace", "path": "/{key to replace}", "value": "Your replacement value here" }]
     * content type is "application/json-patch+json"
     */
    public function update_product(Request $request){
        // $keyToUpdate = ltrim($request->all()[0]['path'],"/");
        // $newValue = $request->all()[0]['value'];
        
        //$result = $this->firebase_client->update([$keyToUpdate => $newValue], 'products/'.$id );
        //return response()->json($result);
        return response()->json($request->all());
        // echo "<pre>".print_r($request->all(), true)."</pre>";


    }

    public function delete_product(Request $request, $id){
        $result = $this->firebase_client->delete('products/'.$id);
        return response()->json($result);
    }
}
