<?php
namespace YWatchman\Panel_Console\Repositories\Daemon;

use Psr\Http\Message\ResponseInterface;
use Pterodactyl\Repositories\Daemon\FileRepository as Repository;
use YWatchman\Panel_Console\Contracts\Daemon\FileRepositoryInterface;

class FileRepository extends Repository implements FileRepositoryInterface
{
    /**
     * Delete a file or folder for the server.
     *
     * @param string $location
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteFile(string $location): ResponseInterface
    {
        return $this->getHttpClient()->request('POST', 'server/file/delete',
            [
                'json' => [
                    'items' => [$location],
                ],
            ]
        );
    }

    /**
     * Creates a new directory for the server in the given $path.
     *
     * @param string $name
     * @param string $path
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createFolder(string $name, string $path): ResponseInterface
    {
        return $this->getHttpClient()->request('POST', 'server/file/folder',
            [
                'json' => [
                    'path' => $path.$name
                ]
            ]
        );
    }

}
