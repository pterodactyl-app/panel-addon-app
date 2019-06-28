<?php

namespace YWatchman\Panel_Console\Requests;

interface ClientPermissionsRequest
{
    /**
     * Returns the permissions string indicating which permission should be used to
     * validate that the authenticated user has permission to perform this action aganist
     * the given resource (server).
     *
     * @return string
     */
    public function permission(): string;
}
