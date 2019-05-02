<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User ; 
class ViewPapersTest extends TestCase
{

    use RefreshDatabase ; 


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_it_can_view_papers()
    {
        // user_error()
        $user = factory(User::class)->create(['username'=>'johndoe']);

        // paper -> test
        $paper = factory(Paper::class)->make([
            'title'   => 'My First Tweet'
        ]);

        $user->papers()->save($paper);

    } 

    public function test_that_we_can_view_followed_papers()
    {
           // we need a logged on user

        $user =  factory(User::class)->create()  ; 




    }

}
