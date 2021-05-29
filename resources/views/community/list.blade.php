<ul class="list-group">
@if(count($links))
@foreach($links as $link)
<li class="list-group-item" style="margin-right:1em;
display:inline-block;
margin-bottom:10px"> 
<form method="POST" action="/votes/{{$link->id}}">
{{csrf_field()}}
<button class=" btn {{Auth::check() && Auth::user()->votedFor($link) ? 'btn-success': 'btn-dark'}}">
{{$link->votes->count()}}
</button>
</form>
<a href="/community/{{$link->channel->slug}}" class="label label-default"style="background:{{$link->channel->color}}">
PHP </a>
<a href="btn btn-primary stretched-link" target="_blank">
{{$link->title}}

</a>
<small class="form-text text-muted">
Contributed By : <a href="#" >{{$link->creator->name}}</a>
{{$link->updated_at->diffForHumans()}}
</small>
</li>
@endforeach
@else 
<li class="links__link">
No Contribution Yet.
</li>
@endif
</ul>
{{$links->appends(request()->query())->links()}}