<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
	use DatabaseMigrations;
   
   /** @test */
   public function unauthenticated_users_should_not_add_replies ()
   {
     $this->expectException('Illuminate\Auth\AuthenticationException');

     $this->post('/threads/some-channel/1/replies',[]);
   }
    
    /** @test */
   public function an_authenticated_user_can_participate_in_forum_threads()
   {
       $user = create('App\User');
       $this->be($user);
      // var_dump($user->name.' - '.$user->id);
       //var_dump(\Auth::user()->name.' - '.\Auth::user()->id);
   	


      // Create User
   	 $user = create('App\User');

   	 //Create Thread
   	 $thread = create('App\Thread');

   	 // User adds reply to the thread (we send post request)
   	 $reply = make('App\Reply');
       #var_dump($reply->toArray());
     	 $this->post('/threads/'.$thread->channel->slug.'/'.$thread->id.'/replies',$reply->toArray());


       // test is reply is visible on the page
       

       #$this->get($thread->path())->assertSee($reply->body);
   }
}
