<?php

namespace YWatchman\Panel_Console\Controllers\Api\User;

use Exception;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Pterodactyl\Http\Controllers\Api\Client\ClientApiController as Controller;
use Pterodactyl\Models\Server;
use YWatchman\Panel_Console\Contracts\Daemon\FileRepositoryInterface;
use YWatchman\Panel_Console\Requests\CreateFolderRequest;
use YWatchman\Panel_Console\Requests\DeleteFileRequest;
use YWatchman\Panel_Console\Requests\GetFileContentsRequest;
use YWatchman\Panel_Console\Requests\ListFilesRequest;
use YWatchman\Panel_Console\Requests\WriteFileContentRequest;

class FilemanagerController extends Controller
{
    /**
     * @var \YWatchman\Panel_Console\Contracts\Daemon\FileRepositoryInterface
     * @var \Illuminate\Contracts\Config\Repository                           $config
     */
    private $repository;

    public function __construct(FileRepositoryInterface $repository, ConfigRepository $config)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->config = $config;
    }

    public function getDirectoryListing(ListFilesRequest $request)
    {
        try {
            return response()->json([
                'contents' => $this->repository->setServer($request->getModel(Server::class))->getDirectory(
                  $request->get('directory') ?? '/'
                ),
            ]);
        } catch (Exception $e) {
            return response(null, 404);
        }
    }

    public function getFileContents(GetFileContentsRequest $request)
    {
        try {
            return Response::create(
                $this->repository->setServer($request->getModel(Server::class))->getContent(
                    $request->get('file'), $this->config->get('pterodactyl.files.max_edit_size')
                )
            );
        } catch (Exception $e) {
            return response(null, 404);
        }
    }

    public function writeFileContent(WriteFileContentRequest $request)
    {
        $this->repository->setServer($request->getModel(Server::class))->putContent(
            $request->get('file'),
            $request->getContent()
        );

        return response(null, 204);
    }

    public function deleteFile(DeleteFileRequest $request)
    {
        $this->repository
            ->setServer($request->getModel(Server::class))
            ->deleteFile($request->input('file')); // This function doesn't exist YET!

        return response(null, 204);
    }

    /**
     * Creates a new folder on the server.
     *
     * @param \Pterodactyl\Http\Requests\Api\Client\Servers\Files\CreateFolderRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function createDirectory(CreateFolderRequest $request): Response
    {
        $this->repository
            ->setServer($request->getModel(Server::class))
            ->createFolder($request->input('name'), $request->input('directory', '/'));

        return response(null, 204);
    }
}
