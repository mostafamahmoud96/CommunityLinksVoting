<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityLinksVote;

class CommunityLink extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function creator()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public static function from(User $user)
    {
       $link=new static;
       $link->user_id=$user->id;
       if($user->isTrusted()){
           $link->approve();
       }
       return $link;
    }

    public function approve()
    {
        $this->approved = true;

        return $this;
    }

    public function contribute($attributes)
    {
        if($existing = $this->hasAlreadyBeenSubmited($attributes['link'])){
          return   $existing->touch();
          throw new CommunityLinkAlreadySubmitted;
        }
        return $this->fill($attributes)->save();
        
    }
    public function scopeForChannel($builder , $channel)
    {
        if($channel)
        {
            return $builder->where('channel_id',$channel->id);
        }
        return $builder;
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    protected function hasAlreadyBeenSubmited($link)
    {
        return static::where('link',$link)->first();
    }
    
    public function votes()
    {
    return $this->hasMany(CommunityLinksVote::class,'community_link_id');
    }

}
