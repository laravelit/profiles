<?php

namespace Laravelit\Profiles\Contracts;

interface ProfileHasRelations
{
    /**
     * Profile belongs to many segments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function segments();
    
    /**
     * Profile belongs to many spaces.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function spaces();

    /**
     * Profile belongs to many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users();

    /**
     * Attach segment to a profile.
     *
     * @param int|\Laravelit\Profiles\Models\Segment $segment
     * @return int|bool
     */
    public function attachSegment($segment);

    /**
     * Detach segment from a profile.
     *
     * @param int|\Laravelit\Profiles\Models\Segment $segment
     * @return int
     */
    public function detachSegment($segment);

    /**
     * Detach all segments.
     *
     * @return int
     */
    public function detachAllSegments();
    
    /**
     * Attach space to a profile.
     *
     * @param int|\Laravelit\Profiles\Models\Space $space
     * @return int|bool
     */
    public function attachSpace($space);
    
    /**
     * Detach space from a profile.
     *
     * @param int|\Laravelit\Profiles\Models\Space $space
     * @return int
     */
    public function detachSpace($space);
    
    /**
     * Detach all spaces.
     *
     * @return int
     */
    public function detachAllSpaces();
}
