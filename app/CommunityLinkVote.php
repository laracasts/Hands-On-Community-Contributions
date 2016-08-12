<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityLinkVote extends Model
{
    /**
     * The associated table name.
     *
     * @var string
     */
    protected $table = 'community_links_votes';

    /**
     * The fillable fields for the table.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'community_link_id'];

    /**
     * Toggle the existence of the row.
     *
     * @return mixed
     */
    public function toggle()
    {
        if ($this->exists) {
            return $this->delete();
        }

        return $this->save();
    }
}
