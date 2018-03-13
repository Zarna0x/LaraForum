@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Thread</div>

                <div class="panel-body">
                   <form action="/threads" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                       <label for="channel_id">Channel: </label>
                       <select name="channel_id" required id="channel_id" class="form-control">
                         @foreach($channels::all() as $channel)
                           <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                         @endforeach
                       </select>
                    </div>
                   	  <div class="form-group">
                   	  	 <label for="title">Title:</label>
                   	  	 <input type="text" name="title" required id="title" value="{{ old('title') }}" class="form-control" placeholder="title">
                   	  </div>

                   	  <div class="form-group">
                   	  	 <label for="body">Body:</label>
                   	  	 <textarea type="text" name="body" rows="8" required value="{{ old('body') }}"id="body" class="form-control" placeholder="Body"></textarea>
                   	  </div>
                      
                      <div class="form-group">
                      	<input type="submit" value="Publish" class="btn btn-primary">
                      </div>
                         @if(count($errors))
                            <ul class="alert alert-danger">
                              @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach                              
                            </ul>
                         @endif
                   </form>
                </div>
            </div>
        </div>
    </div>


    
</div>
@endsection
