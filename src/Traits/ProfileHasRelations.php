<?php

namespace Laravelit\Profiles\Traits;

trait ProfileHasRelations
{
    /**
     * Profile belongs to many segments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function segments()
    {
        return $this->belongsToMany(config('profiles.models.segment'))->withTimestamps();
    }

    /**
     * Profile belongs to many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(config('auth.model'))->withTimestamps();
    }

    /**
     * Attach segment to a profile.
     *
     * @param int|\Laravelit\Profiles\Models\Segment $segment
     * @return int|bool
     */
    public function attachSegment($segment)
    {
        return (!$this->segments()->get()->contains($segment)) ? $this->segments()->attach($segment) : true;
    }

    /**
     * Detach segment from a profile.
     *
     * @param int|\Laravelit\Profiles\Models\Segment $segment
     * @return int
     */
    public function detachSegment($segment)
    {
        return $this->segments()->detach($segment);
    }

    /**
     * Detach all segments.
     *
     * @return int
     */
    public function detachAllSegments()
    {
        return $this->segments()->detach();
    }
}
