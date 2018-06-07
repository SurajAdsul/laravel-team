<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'current_team_id'
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
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, TeamUser::class, 'user_id', 'team_id')->withTimestamps();
    }

    /**
     * has-one relation with the current selected team model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currentTeam()
    {
        return $this->hasOne(Team::class, 'id', 'current_team_id');
    }

    /**
     * One-to-Many relation with the invite model
     * @return mixed
     */
    public function invites()
    {
        return $this->hasMany(TeamInvite::class, 'email', 'email');
    }

}
