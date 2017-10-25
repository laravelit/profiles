<?php

namespace Laravelit\Profiles\Models;

use Laravelit\Profiles\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use Laravelit\Profiles\Traits\SegmentHasRelations;
use Laravelit\Profiles\Contracts\SegmentHasRelations as SegmentHasRelationsContract;

class Segment extends Model implements SegmentHasRelationsContract
{
    use Slugable, SegmentHasRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'model'];

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
