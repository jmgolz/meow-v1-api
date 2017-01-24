<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        
    }

    public function api_root(){
        echo "<h1>IT WORKS!</h1>";
    }

    public function create_new_product(){

    }

    public function get_product(Request $request, $id){
        $mock_products = array(
            array('name' => 'product one'),
            array('name' => 'product two')
        );

        return response()->json($mock_products[$id]);
    }

    public function update_product(){

    }

    public function delete_product(){

    }
}
