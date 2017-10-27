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
     * Profile belongs to many spaces.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function spaces()
    {
    	return $this->belongsToMany(config('spaces.models.space'))->withTimestamps();
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
    
    /**
     * Attach space to a profile.
     *
     * @param int|\Laravelit\Profiles\Models\Space $space
     * @return int|bool
     */
    public function attachSpace($space){
    	return (!$this->spaces()->get()->contains($space)) ? $this->spaces()->attach($space) : true;
    }
    
    /**
     * Detach space from a profile.
     *
     * @param int|\Laravelit\Profiles\Models\Space $space
     * @return int
     */
    public function detachSpace($space){
    	return $this->spaces()->detach($space);
    }
    
    /**
     * Detach all spaces.
     *
     * @return int
     */
    public function detachAllSpaces(){
    	return $this->spaces()->detach();
    }
}
