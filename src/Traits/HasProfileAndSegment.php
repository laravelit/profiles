<?php

namespace Laravelit\Profiles\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

trait HasProfileAndsegment
{
    /**
     * Property for caching profiles.
     *
     * @var \Illuminate\Database\Eloquent\Collection|null
     */
    protected $profiles;

    /**
     * Property for caching segments.
     *
     * @var \Illuminate\Database\Eloquent\Collection|null
     */
    protected $segments;

    /**
     * User belongs to many profiles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profiles()
    {
        return $this->belongsToMany(config('profiles.models.profile'))->withTimestamps();
    }

    /**
     * Get all profiles as collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProfiles()
    {
        return (!$this->profiles) ? $this->profiles = $this->profiles()->get() : $this->profiles;
    }

    /**
     * Check if the user has a profile or profiles.
     *
     * @param int|string|array $profile
     * @param bool $all
     * @return bool
     */
    public function match($profile, $all = false)
    {
        if ($this->isPretendEnabled()) {
            return $this->pretend('match');
        }

        return $this->{$this->getMethodName('match', $all)}($profile);
    }

    /**
     * Check if the user has at least one profile.
     *
     * @param int|string|array $profile
     * @return bool
     */
    public function matchOne($profile)
    {
        foreach ($this->getArrayFrom($profile) as $profile) {
            if ($this->hasProfile($profile)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the user has all profiles.
     *
     * @param int|string|array $profile
     * @return bool
     */
    public function matchAll($profile)
    {
        foreach ($this->getArrayFrom($profile) as $profile) {
            if (!$this->hasProfile($profile)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if the user has profile.
     *
     * @param int|string $profile
     * @return bool
     */
    public function hasProfile($profile)
    {
        return $this->getProfiles()->contains(function ($key) use ($profile) {
            return $profile == $key->id || Str::is($profile, $key->slug);
        });
    }

    /**
     * Attach profile to a user.
     *
     * @param int|\Laravelit\Profiles\Models\Profile $profile
     * @return null|bool
     */
    public function attachProfile($profile)
    {
        return (!$this->getProfiles()->contains($profile)) ? $this->profiles()->attach($profile) : true;
    }

    /**
     * Detach profile from a user.
     *
     * @param int|\Laravelit\Profiles\Models\Profile $profile
     * @return int
     */
    public function detachProfile($profile)
    {
        $this->profiles = null;

        return $this->profiles()->detach($profile);
    }

    /**
     * Detach all profiles from a user.
     *
     * @return int
     */
    public function detachAllProfiles()
    {
        $this->profiles = null;

        return $this->profiles()->detach();
    }

    /**
     * Get all segments from profiles.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function profilesegments()
    {
        $segmentModel = app(config('profiles.models.segment'));

        if (!$segmentModel instanceof Model) {
            throw new InvalidArgumentException('[profiles.models.segment] must be an instance of \Illuminate\Database\Eloquent\Model');
        }

        return $segmentModel::select(['segments.*', 'segment_profile.created_at as pivot_created_at', 'segment_profile.updated_at as pivot_updated_at'])
                ->join('segment_profile', 'segment_profile.segment_id', '=', 'segments.id')->join('profiles', 'profiles.id', '=', 'segment_profile.profile_id')
                ->whereIn('profiles.id', $this->getProfiles()->lists('id')->toArray()) ->orWhere('profiles.level', '<', $this->level())
                ->groupBy(['segments.id', 'pivot_created_at', 'pivot_updated_at']);
    }

    /**
     * User belongs to many segments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function usersegments()
    {
        return $this->belongsToMany(config('profiles.models.segment'))->withTimestamps();
    }

    /**
     * Get all segments as collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getsegments()
    {
        return (!$this->segments) ? $this->segments = $this->profilesegments()->get()->merge($this->usersegments()->get()) : $this->segments;
    }

    /**
     * Check if the user has a segment or segments.
     *
     * @param int|string|array $segment
     * @param bool $all
     * @return bool
     */
    public function enque($segment, $all = false)
    {
        if ($this->isPretendEnabled()) {
            return $this->pretend('enque');
        }

        return $this->{$this->getMethodName('enque', $all)}($segment);
    }

    /**
     * Check if the user has at least one segment.
     *
     * @param int|string|array $segment
     * @return bool
     */
    public function enqueOne($segment)
    {
        foreach ($this->getArrayFrom($segment) as $segment) {
            if ($this->hassegment($segment)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the user has all segments.
     *
     * @param int|string|array $segment
     * @return bool
     */
    public function enqueAll($segment)
    {
        foreach ($this->getArrayFrom($segment) as $segment) {
            if (!$this->hassegment($segment)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if the user has a segment.
     *
     * @param int|string $segment
     * @return bool
     */
    public function hasSegment($segment)
    {
        return $this->getsegments()->contains(function ($key, $value) use ($segment) {
            return $segment == $value->id || Str::is($segment, $value->slug);
        });
    }

    
    /**
     * Attach segment to a user.
     *
     * @param int|\Laravelit\Profiles\Models\segment $segment
     * @return null|bool
     */
    public function attachsegment($segment)
    {
        return (!$this->getsegments()->contains($segment)) ? $this->usersegments()->attach($segment) : true;
    }

    /**
     * Detach segment from a user.
     *
     * @param int|\Laravelit\Profiles\Models\segment $segment
     * @return int
     */
    public function detachsegment($segment)
    {
        $this->segments = null;

        return $this->usersegments()->detach($segment);
    }

    /**
     * Detach all segments from a user.
     *
     * @return int
     */
    public function detachAllsegments()
    {
        $this->segments = null;
        
        return $this->usersegments()->detach();
    }

    /**
     * Check if pretend option is enabled.
     *
     * @return bool
     */
    private function isPretendEnabled()
    {
        return (bool) config('profiles.pretend.enabled');
    }

    /**
     * Allows to pretend or simulate package behavior.
     *
     * @param string $option
     * @return bool
     */
    private function pretend($option)
    {
        return (bool) config('profiles.pretend.options.' . $option);
    }

    /**
     * Get method name.
     *
     * @param string $methodName
     * @param bool $all
     * @return string
     */
    private function getMethodName($methodName, $all)
    {
        return ((bool) $all) ? $methodName . 'All' : $methodName . 'One';
    }

    /**
     * Get an array from argument.
     *
     * @param int|string|array $argument
     * @return array
     */
    private function getArrayFrom($argument)
    {
        return (!is_array($argument)) ? preg_split('/ ?[,|] ?/', $argument) : $argument;
    }

    /**
     * Handle dynamic method calls.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (starts_with($method, 'match')) {
        	return $this->match(snake_case(substr($method, 2), config('profiles.separator')));
        } elseif (starts_with($method, 'enque')) {
        	return $this->enque(snake_case(substr($method, 3), config('profiles.separator')));
        }
        return parent::__call($method, $parameters);
    }
}
