
@extends('layouts.app')
@section('content')
<div class="col-md-8">

<h1> 
<a href="/communities">Community </a>

 </h1>
 <ul class="nav nav-tabs">
 <li class="{{request()->exists('popular') ? '' : 'active' }}"> 
 <a href="{{request()->url()}}"> Most Recent </a>
 </li>
 <li class="{{request()->exists('popular') ? 'active' : '' }}">
 <a href="?popular"> Most Popular </a>
 </li>

 </ul>
@include('community.list')
</div>
@include('community.add-link')
</div>
@endsection
 