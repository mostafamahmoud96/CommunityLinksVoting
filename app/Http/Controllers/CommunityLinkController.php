<?php

namespace App\Http\Controllers;
use Illuminate\Flash\FlashServiceProvider;
use Illuminate\Http\Request;
use App\Models\CommunityLink;
use App\Models\Channel;
use App\Models\CommunityLinksVote;
use Auth;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel=null)
    {
        // $orderBy= request()->exists('popular') ? 'vote_count' : 'updated_at' ;
        // $links = CommunityLink::query()->with('votes','creator','channel')
        //     ->toBase()
        //     ->selectRaw('link, COUNT(link) AS count')
        //     ->join('community_links_votes AS CLV','CLV.community_link_id', 'community_links.id')
        //     ->where('approved', '1')
        //     ->groupBy('link')
        //     ->when($orderBy == 'vote_count', function ($query) {
            //         $query->orderByDesc('count');
            //     })
            //     ->when($orderBy == 'popular', function ($query) {
                //         $query->orderByDesc('community_links.updated_at');
                //     })
                //     ->get();
                // dd($links);
                $orderBy= request()->exists('popular') ? 'vote_count' : 'updated_at' ;
                $links= CommunityLink::with('votes','creator','channel')
                ->forChannel($channel)
        ->where('approved',1)
        ->leftJoin('community_links_votes','community_links_votes.community_link_id', '=' ,'community_links.id')
        ->selectRaw(
            'community_links.*, count(community_links_votes.id) as vote_count'
            )
        ->groupBy('community_links.id')
        ->orderBy($orderBy,'desc')
        // ->latest('updated_at')
        ->Paginate(3);
        $channels= Channel::orderBy('title','asc')->get();
        return view('community.index',\compact('links','channels','channel'));
        // dd($links);
        // $votes=CommunityLinksVote::where('user_id',Auth::id())->pluck('community_link_id');
        // dd($votes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'channel_id'=>'required|exists:channels,id',
            'title'=>'required',
            'link'=>'required|active_url'
        ]);
        CommunityLink::from(auth()->user())
        ->contribute($request->all());
        // if(auth()->user()->isTrusted()){
            
        // }

        return back()->with('success', 'link created successfully.');    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
