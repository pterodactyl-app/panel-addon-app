<?php

namespace YWatchman\Panel_Console\Requests;

use YWatchman\Panel_Console\Requests\ClientPermissionsRequest;
use Pterodactyl\Http\Requests\Api\Client\ClientApiRequest;

class DeleteFileRequest extends ClientApiRequest implements ClientPermissionsRequest
{
    /**
     * Returns the permissions string indicating which permission should be used to
     * validate that the authenticated user has permission to perform this action aganist
     * the given resource (server).
     *
     * @return string
     */
    public function permission(): string
    {
        return 'delete-files';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'file' => 'required|string',
        ];
    }
}
