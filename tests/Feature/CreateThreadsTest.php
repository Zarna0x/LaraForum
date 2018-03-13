<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadsTest extends TestCase
{
	use DatabaseMigrations;
    
    /** @test  */
    public function guests_may_not_create_threads()
    {

       $this->expectException('Illuminate\Auth\AuthenticationException');
       $thread = make('App\Thread');
       $this->post('threads',$thread->toArray());
    }

    /** @test  */
    public function an_authenticated_user_can_create_new_forum_threads () 
    {
    	// get new authenticated user
        
        $this->signIn();        


        //send post request to threads page
        $thread = make('App\Thread');


        $response = $this->post('/threads',$thread->toArray());
        
        // var_dump($response->headers->get('Location'));
        // die;

        $this->get($response->headers->get('Location'))->assertSee($thread->title)
             ->assertSee($thread->body);


    }

    /** @test  */

    public function guest_cant_see_create_thread_page()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->get('/threads/create');
    }

   /** @test  */
   public function a_thread_requires_a_title()
   {
     $this->expectException('Illuminate\Validation\ValidationException');
     $this->publishThread(['title'=>null]);     
  }    
  

  public function publishThread($overrides = [])
  {
    $this->signIn();
    
     $thread = make('App\Thread',$overrides);

     ####  dd($thread);
     $this->post('/threads',$thread->toArray()); 
     
  }
}
