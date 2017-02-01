<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Kreait\Firebase\Configuration;
use Kreait\Firebase\Firebase;

class ApiController extends BaseController
{
    
    private $firebase_client;
    private $firebase_config;
    private $db;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request){        
        $this->db = explode("/", $request->path())[1];
        
        $this->firebase_config = new Configuration();
        $this->firebase_config->setAuthConfigFile( base_path('firebase.json') );
        $this->firebase_client = new Firebase('https://meow-api.firebaseio.com/', $this->firebase_config);
    }

    public function get_all_products(Request $request){
        $result = $this->firebase_client->get($this->db);
        return response()->json($result);
    }

    public function get_product(Request $request, $id){
        $result = $this->firebase_client->get($this->db.'/'.$id);
        return response()->json($result);
    }

    public function api_root(){
        return "it works";
    }

    public function create_new_product(Request $request){
        $result = $this->firebase_client->push($request->all(), $this->db);
        return response()->json($result);
    }

    /* Uses Patch HTTP method to make updates.
     * content type is "application/json-patch+json"
     */
    public function update_product(Request $request){
        $result = $this->firebase_client->update([$request->all()['key'] => $request->all()['value']], $this->db.'/'.$request->all()['product_id']);
        return response()->json($result);
    }

    public function delete_product(Request $request, $id){
        $result = $this->firebase_client->delete($this->db.'/'.$id);
        return response()->json($result);
    }
}
