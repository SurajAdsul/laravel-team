<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'owner_id'];


    /**
     * One-to-Many relation with the TeamInvite model
     * @return mixed
     */
    public function invites()
    {
        return $this->hasMany(TeamInvite::class, 'team_id', 'id');
    }

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, TeamUser::class, 'team_id', 'id')->withTimestamps();
    }

}
