<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Exceptions\CommunityLinkAlreadySubmitted;
use App\Http\Requests\CommunityLinkForm;
use App\Queries\CommunityLinksQuery;

class CommunityLinksController extends Controller
{
    /**
     * Show all community links.
     *
     * @param Channel $channel
     * @return \Illuminate\View\View
     */
    public function index(Channel $channel = null)
    {
        $links = (new CommunityLinksQuery)->get(
            request()->exists('popular'), $channel
        );

        $channels = Channel::orderBy('title', 'asc')->get();

        return view('community.index', compact('links', 'channels', 'channel'));
    }

    /**
     * Publish a new community link.
     *
     * @param CommunityLinkForm $form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommunityLinkForm $form)
    {
        try {
            $form->persist();

            if (auth()->user()->isTrusted()) {
                flash('Thanks for the contribution!', 'success');
            } else {
                flash()->overlay('This contribution will be approved shortly.', 'Thanks!');
            }
        } catch (CommunityLinkAlreadySubmitted $e) {
            flash()->overlay(
                "We'll instead bump the timestamps and bring that link back to the top. Thanks!",
                'That Link Has Already Been Submitted'
            );
        }

        return back();
    }
}
