<?php

namespace Laravelit\Profiles\Contracts;

use Illuminate\Database\Eloquent\Model;

interface HasProfileAndSegments
{
    /**
     * User belongs to many profiles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profiles();

    /**
     * Get all profiles as collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProfiles();

    /**
     * Check if the user has a profile or profiles.
     *
     * @param int|string|array $profile
     * @param bool $all
     * @return bool
     */
    public function is($profile, $all = false);

    /**
     * Check if the user has all profiles.
     *
     * @param int|string|array $profile
     * @return bool
     */
    public function isAll($profile);

    /**
     * Check if the user has at least one profile.
     *
     * @param int|string|array $profile
     * @return bool
     */
    public function isOne($profile);

    /**
     * Check if the user has profile.
     *
     * @param int|string $profile
     * @return bool
     */
    public function hasProfile($profile);

    /**
     * Attach profile to a user.
     *
     * @param int|\Laravelit\Profiles\Models\Profile $profile
     * @return null|bool
     */
    public function attachProfile($profile);

    /**
     * Detach profile from a user.
     *
     * @param int|\Laravelit\Profiles\Models\Profile $profile
     * @return int
     */
    public function detachProfile($profile);

    /**
     * Detach all profiles from a user.
     *
     * @return int
     */
    public function detachAllProfiles();

    /**
     * Get profile level of a user.
     *
     * @return int
     */
    public function level();

    /**
     * Get all segments from profiles.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function profileSegments();

    /**
     * User belongs to many segments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function userSegments();

    /**
     * Get all segments as collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSegments();

    /**
     * Check if the user has a segment or segments.
     *
     * @param int|string|array $segment
     * @param bool $all
     * @return bool
     */
    public function can($segment, $all = false);

    /**
     * Check if the user has all segments.
     *
     * @param int|string|array $segment
     * @return bool
     */
    public function canAll($segment);

    /**
     * Check if the user has at least one segment.
     *
     * @param int|string|array $segment
     * @return bool
     */
    public function canOne($segment);

    /**
     * Check if the user has a segment.
     *
     * @param int|string $segment
     * @return bool
     */
    public function hasSegment($segment);

    /**
     * Check if the user is allowed to manipulate with entity.
     *
     * @param string $providedSegment
     * @param \Illuminate\Database\Eloquent\Model $entity
     * @param bool $owner
     * @param string $ownerColumn
     * @return bool
     */
    public function allowed($providedSegment, Model $entity, $owner = true, $ownerColumn = 'user_id');

    /**
     * Attach segment to a user.
     *
     * @param int|\Laravelit\Profiles\Models\Segment $segment
     * @return null|bool
     */
    public function attachSegment($segment);

    /**
     * Detach segment from a user.
     *
     * @param int|\Laravelit\Profiles\Models\Segment $segment
     * @return int
     */
    public function detachSegment($segment);

    /**
     * Detach all segments from a user.
     *
     * @return int
     */
    public function detachAllSegments();
}
