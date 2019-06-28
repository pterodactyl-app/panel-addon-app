<?php
namespace YWatchman\Panel_Console\Contracts\Daemon;

use stdClass;
use Psr\Http\Message\ResponseInterface;
use Pterodactyl\Contracts\Repository\Daemon\FileRepositoryInterface as BaseRepositoryInterface;

interface FileRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Delete a file or folder for the server.
     *
     * @param string $location
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteFile(string $location): ResponseInterface;
}
