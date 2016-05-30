<?php

namespace CursoCode\Services;


use CursoCode\Repositories\ProjectFileRepository;
use CursoCode\Validators\ProjectFileValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjectFileService
{
    /**
     * @var ProjectFileRepository
     */
    protected $repository;
    /**
     * @var ProjectFileValidator
     */
    protected $validator;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;

    /**
     * ProjectFileService constructor.
     * @param ProjectFileRepository $repository
     * @param ProjectFileValidator $validator
     * @param Filesystem $filesystem
     * @param Storage $storage
     */
    public function __construct(ProjectFileRepository $repository, ProjectFileValidator $validator, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }


    /**
     * @param array $data
     * @return array|mixed
     */
    public function create(array $data)
    {

        try {
            $this->validator->with($data)->passesOrFail();

            $projectFile = $this->repository->skipPresenter()->create($data);
            $this->storage->put($projectFile->getFileName(), $this->filesystem->get($data['file']));

            return [
                'success' => true,
                'message' => 'Arquivo anexado com sucesso.'
            ];

        } catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Ocorreu algum erro ao gravar o registro.'
            ];
        }
    }

    /**
     * @param $project_id
     * @param $id
     * @return array
     */
    public function destroy($project_id, $id)
    {
        try {
            $projectFile = $this->repository->find($id);

            if ($this->storage->exists($projectFile->getFileName()))
            {
                $this->storage->delete($projectFile->getFileName());
            }

            $this->repository->delete($id);

            return [
                'success' => true,
                "message" => 'Arquivo excluído com sucesso.'
            ];

        } catch (ModelNotFoundException $e) {
            return [
                'error'      => true,
                'message'    => 'Arquivo não localizado.'
            ];
        } catch (QueryException $e) {
            return [
                'error'      => true,
                'message'    => 'Esse arquivo não pode ser excluído.'
            ];
        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Falha ao excluir arquivo. Tente novamente.'
            ];
        }
    }

}