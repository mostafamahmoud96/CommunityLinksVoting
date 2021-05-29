<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityLinksVote extends Model
{
    use HasFactory;
    protected $table = 'community_links_votes';
    protected $guarded=[];

    public function toggle()
    {
        if($this->exists){
            return $this->delete();
        }

      return  $this->save();
    }
  
    
}
