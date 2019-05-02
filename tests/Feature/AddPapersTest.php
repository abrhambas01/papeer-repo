<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddPapersTest extends TestCase
{
    /*View papers..*/


    /*don't use tdd*/
    public function it_adds_papers_on_the_site()
    {
    	$this->withExceptionHandling() ;
    }
}
