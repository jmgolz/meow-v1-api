<?php
namespace App\Http\Controllers;
putenv('GOOGLE_APPLICATION_CREDENTIALS='.__DIR__.'/../firebase.json');

use Illuminate\Http\Request;
use Kreait\Firebase\Configuration;
use Kreait\Firebase\Firebase;

class ApiController extends Controller
{
    private $mock_products = array(
        "products" => array(
            array(
                'title' => 'product one',
                'description' => 'this is product one',
                'in_stock' => false
            ),
            array(
                'title' => 'product two',
                'description' => 'this is product TWO',
                'in_stock' => true
            )
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
        $this->firebase_config->setAuthConfigFile(__DIR__.'/../firebase.json');

        $this->firebase_client = new Firebase('https://meow-api.firebaseio.com/', $this->firebase_config);

    }

    public function get_all_products(){
        return response()->json($this->mock_products);
    }

    public function get_product(Request $request, $id){
        return response()->json($this->mock_products['products'][$id]);
    }

    public function api_root(){
        echo "<h1>IT WORKS!</h1>";
    }

    public function create_new_product(){

    }


    public function update_product(){

    }

    public function delete_product(){

    }
}
