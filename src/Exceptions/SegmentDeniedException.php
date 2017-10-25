<?php

namespace Laravelit\Profiles\Exceptions;

class SegmentDeniedException extends AccessDeniedException
{
    /**
     * Create a new segment denied exception instance.
     *
     * @param string $segment
     */
    public function __construct($segment)
    {
    	$this->message = sprintf("You don't have a required ['%s'] segment.", $segment);
    }
}
