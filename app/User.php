<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Determine if the user user is trusted.
     *
     * @return bool
     */
    public function isTrusted()
    {
        return (bool) $this->trusted;
    }

    /**
     * Fetch all link that the user has voted up.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function votes()
    {
        return $this->belongsToMany(
            CommunityLink::class, 'community_links_votes'
        )->withTimestamps();
    }

    /**
     * Toggle a vote for a given link.
     *
     * @param CommunityLink $link
     */
    public function toggleVoteFor(CommunityLink $link)
    {
        CommunityLinkVote::firstOrNew([
            'user_id'           => $this->id,
            'community_link_id' => $link->id,
        ])->toggle();
    }

    /**
     * Determine if the user voted for the given link.
     *
     * @param CommunityLink $link
     *
     * @return mixed
     */
    public function votedFor(CommunityLink $link)
    {
        return $this->votes->contains($link);
    }
}
