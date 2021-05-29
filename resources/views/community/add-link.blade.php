<div class="col-md-4">
<h3>    
Contribute a link
</h3>
<div class="panel panel-default">
<div class="panel-body">
<form  method="Post" action="/communities">
{{csrf_field()}}
<div class="form-group">
<select class="form-control" name="channel_id">
<option selected disabled> Pick a Channel </option>
@foreach($channels as $channel)
<option value="{{$channel->id}}" {{ old('channel_id') == $channel->id ? 'selected':''}}>{{$channel->title}} </option>
@endforeach
</select>
 @if ($errors->has('channel_id'))
<span class="text-danger">{{ $errors->first('channel_id') }}</span>
  @endif
</div>

<label for="title">Title </label>
<input type="text"  class="form-control form-control-sm"
 id="title" 
name="title"
value="{{old('title')}}"
 placeholder="what is the title of your article">
 @if ($errors->has('title'))
<span class="text-danger">{{ $errors->first('title') }}</span>
  @endif

</div>
<div class="form-group">
<label for="link">Link </label>
<input type="text" class="form-control form-control-sm"id="link"  name="link"
value="{{old('link')}}"
placeholder="what is the URl of your article">
@if ($errors->has('link'))
<span class="text-danger">{{ $errors->first('link') }}</span>
 @endif
</div>
<div class="form-group">
<button class="btn btn-primary">
Contribute Link
</button>
</div>
</form>
</div>
</div>
</div>
