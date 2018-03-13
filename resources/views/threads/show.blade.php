@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="#">{{ $thread->owner->name }}</a> posted: {{ $thread->title }}</div>

                <div class="panel-body">
                    
                       <article>
                       	   <div class="body">{{ $thread->body }}</div>
                       </article>
                    
                </div>
            </div>
<?php $replies =  $thread->replies()->paginate(1); ?>

            @foreach ($replies as $reply)
               @include('threads.reply')            
            @endforeach


{{ $replies->links() }}
 @if (auth()->check())
     
            <form method="POST" action="{{ $thread->path() }}/replies" class="form-group">
               {{ csrf_field() }}
                 <div class="form-group">
                    <textarea rows="5" class="form-control" name='body' id="body" placeholder="Have something to Say?"></textarea>
                     
                 </div>
                 <div class="form-group">
                    <input type="submit" class="btn btn-default" name="addreply" />
                 </div>
            </form>
            @else
       <p class="text-center">Please <a href="/login">sign in</a> to participate in this discussion</p>
    @endif
   
       

    
          </div>


          <div class="col-md-4">
}
<div class="panel panel-default">
               
                <div class="panel-body">
                    <p>This thread was published {{ $thread->created_at->diffForHumans() }} by 
                    <a href="#">{{ $thread->owner->name }}</a> and currently has {{ $thread->replies_count }} {{ str_plural('reply',$thread->replies_count) }}</p>
                    
                </div>
            </div>

            
          </div>
      
    </div>

    



</div>
@endsection
