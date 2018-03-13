<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
#use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadTest extends TestCase
{
	use DatabaseMigrations;

    public $thread;
   
    public function setUp()
    {
    	 parent::setUp();
    	 $this->thread = factory('App\Thread')->create();
    }

	/** @test */

	public function a_thread_has_a_creator()
	{

		$this->assertInstanceOf('App\User',$this->thread->owner);
	}

	
	/** @test */
	public function a_thread_can_add_reply () 
	{
		$this->thread->addReply([
           'body' => 'foobar',
           'user_id' => 1
		]);

		$this->assertCount(1,$this->thread->replies);
	}

	/** @test */
	public function a_thread_can_make_a_string_path()
	{
		$thread = create('App\Thread');
        
		$this->assertEquals('/threads/'.$thread->channel->slug.'/'.$thread->id,$thread->path());
	}
}
