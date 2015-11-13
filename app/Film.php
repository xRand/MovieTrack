<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Film extends Model
{

    //for saving in db
    protected $fillable = [
        'title',
        'date',
        'description',
        'genre',
        'director',
        'poster'
    ];

    protected $dates = ['date']; //for carbon object


    //zagatovka zaprosov
    public function scopeReleased($query)
    {
        $query->where('date', '>=', Carbon::now());
    }

    public function scopeFindById($query, $id)
    {
        $film = $query->where('id', '=', $id)->first();
        if (is_null($film)) {
            abort(404);
        }
        return $film;
    }


    //mutator TEST
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value);
    }

    //accessor for date format
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }


    //A films that belong to the user.
    public function users()
    {
        return $this->belongsToMany('App\User', 'subscription')->withTimestamps();
    }

    //Check if current user has subscription
    public function getSubStatus()
    {
        $user_id = Auth::user()->id;
        if ($this->users->find($user_id)) return true;
        else return false;
    }






    /**
     * Save a new model and return the instance.
     *
     * @param  array $attributes
     * @return static
     */
    public static function create(array $attributes = [])
    {
        $model = new static($attributes);

        $model->save();

        return $model;
    }

    /**
     * Save the model to the database.
     *
     * @param  array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        $query = $this->newQueryWithoutScopes();

        // If the "saving" event returns false we'll bail out of the save and return
        // false, indicating that the save failed. This provides a chance for any
        // listeners to cancel save operations if validations fail or whatever.
        if ($this->fireModelEvent('saving') === false) {
            return false;
        }

        // If the model already exists in the database we can just update our record
        // that is already in this database using the current IDs in this "where"
        // clause to only update this model. Otherwise, we'll just insert them.
        if ($this->exists) {
            $saved = $this->performUpdate($query, $options);
        }

        // If the model is brand new, we'll insert it into our database and set the
        // ID attribute on the model to the value of the newly inserted row's ID
        // which is typically an auto-increment value managed by the database.
        else {
            $saved = $this->performInsert($query, $options);
        }

        if ($saved) {
            $this->finishSave($options);
        }

        return $saved;
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return bool|int
     */
    public function update(array $attributes = [])
    {
        if (! $this->exists) {
            return $this->newQuery()->update($attributes);
        }

        return $this->fill($attributes)->save();
    }
}
