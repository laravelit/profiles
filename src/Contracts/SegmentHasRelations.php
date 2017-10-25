<?php

namespace Laravelit\Roles\Contracts;

interface SegmentHasRelations
{
    /**
     * Segment belongs to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profiles();

    /**
     * Segment belongs to many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users();
}
