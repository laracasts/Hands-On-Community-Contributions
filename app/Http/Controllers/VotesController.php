<?php

namespace App\Http\Controllers;

use App\CommunityLink;

class VotesController extends Controller
{
    /**
     * Create a new votes controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Toggle a vote for the given link.
     *
     * @param  CommunityLink $link
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommunityLink $link)
    {
        auth()->user()->toggleVoteFor($link);

        return back();
    }
}
