<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityLink;
use App\Models\CommunityLinksVote;


class VoteController extends Controller
{
     public function store(CommunityLink $link)
     {
        
      CommunityLinksVote::firstOrNew([
           'user_id'=>auth()->id(),
           'community_link_id'=>$link->id
       ])->toggle();


            return back();

     }
}
