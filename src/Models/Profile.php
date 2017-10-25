<?php

namespace Laravelit\Profiles\Models;

use Laravelit\Profiles\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use Laravelit\Profiles\Traits\ProfileHasRelations;
use Laravelit\Profiles\Contracts\ProfileHasRelations as ProfileHasRelationsContract;

class Profile extends Model implements ProfileHasRelationsContract
{
	use Slugable, ProfileHasRelations;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'level'];

    /**
     * Create a new model instance.
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if ($connection = config('profiles.connection')) {
            $this->connection = $connection;
        }
    }
}
