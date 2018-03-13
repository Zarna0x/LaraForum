<?php

namespace Tests\Feature;

use Tests\TestCase;
#use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
#use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadsTest extends TestCase
{

     use DatabaseMigrations;
     

     public $thread;


     public function setUp ()
     {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
     } 


    /** @test */
    public function a_user_can_view_all_threads () 
    {
        
        // test if user sees thread title
        $response = $this->get('/threads')
                    ->assertSee($this->thread->title);


        
    }

    /** @test */
     public function a_user_can_view_single_thread () 
     {
        $response = $this->get($this->thread->path())
                    ->assertSee($this->thread->title);

     }

     /** @test */
     public function a_user_can_read_replies_associated_with_a_thread () 
     {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        //We should see reply on threads page now
        $this->get($this->thread->path())->assertSee($reply->body);
     }

     /** @test */
     public function a_thread_belongs_to_a_channel () 
     {
       // $thread = create('App\Thread');

        $this->assertInstanceOf('App\Channel',$this->thread->channel);
     }

     /** @test */
     public function a_user_can_filter_threads_according_to_a_tag () 
     {
         $channel = create('App\Channel');
         $threadInChannel    = create('App\Thread',['channel_id' => $channel->id]);
         $threadNotInChannel = create('App\Thread'); 
        $this->get('/threads/'.$channel->slug)
             ->assertSee($threadInChannel->title)
             ->assertDontSee($threadNotInChannel->title);
     }

     /** @test */
     public function a_user_can_filter_threads_by_any_username()
     {
        $this->signIn(create('App\User',['name' => 'JohnDoe']));
         

        $threadByJohn = create('App\Thread',['user_id' => \Auth::user()->id]);
        $otherThread  = create('App\Thread');

        $this->get('threads?by=JohnDoe')
             ->assertSee($threadByJohn->title)
             ->assertDontSee($otherThread->title);
        
     }

}