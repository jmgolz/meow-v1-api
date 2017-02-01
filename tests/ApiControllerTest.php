<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Request;

class ApiControllerTest extends TestCase
{
    private $mock_products;

    public function setUp(){
        parent::setUp();
        
        $this->mock_products = array(
            "-KbS_SquaqDVuX4sd3mI" => array(
                "description" => "this watch - it's GREAT!",
                "in_stock" => true,
                "title" => "Some watch thing"
            ),

            "-KbjyPuz0MKJZhsQ_sQ2" => array(
                "description" => "But now THIS watch...the BEST!",
                "in_stock" => true,
                "title" => "mega cool watch"
            )
        );        
    }
    
    public function testGetAllProductsAgainstMock(){
        $this->json('GET', '/api/tests')->seeJson(["tests" => $this->mock_products]);
    }

    public function testGetProductAgainstMock(){
        //stub
    }
}