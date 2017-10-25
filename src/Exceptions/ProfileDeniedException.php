<?php

namespace Laravelit\Profiles\Exceptions;

class ProfileDeniedException extends AccessDeniedException
{
    /**
     * Create a new profile denied exception instance.
     *
     * @param string $profile
     */
	public function __construct($profile)
    {
    	$this->message = sprintf("You don't have a required ['%s'] profile.", $profile);
    }
}
