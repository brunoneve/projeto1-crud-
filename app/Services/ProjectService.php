<?php

namespace CursoCode\Services;


use CursoCode\Repositories\ProjectRepository;
use CursoCode\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;
    /**
     * @var ProjectValidator
     */
    protected $validator;

    /**
     * ProjectService constructor.
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
     */
    public function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }


    /**
     * @return array|mixed
     */
    public function all()
    {
        try{
            return $this->repository->with(['owner','client'])->all();

        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Nenhum registro encontrado.'
            ];
        }
    }


    /**
     * @param $id
     * @return array|mixed
     */
    public function find($id)
    {
        try{
            if($this->checkPermissionProject($id) == false)
            {
                return [
                    "error" => true,
                    "message" => "Você não tem permissão para visualizar esse projeto!"
                ];
            }
            return $this->repository->with(['owner','client','members'])->find($id);

        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Projeto não localizado.'
            ];
        }
    }


    /**
     * @param array $data
     * @return array|mixed
     */
    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();

            return $this->repository->create($data);

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
     * @param array $data
     * @param $id
     * @return array|mixed
     */
    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();

            if($this->checkOwner($id) == false)
            {
                return [
                    "error" => true,
                    "message" => "Você não tem permissão para visualizar esse projeto!"
                ];
            }

            return $this->repository->update($data,$id);

        } catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Ocorreu algum erro ao atualizar o registro.'
            ];
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        try {

            if($this->checkOwner($id) == false)
            {
                return [
                    "error" => true,
                    "message" => "Você não tem permissão para remover esse projeto."
                ];
            }

            $this->repository->delete($id);
            return [
                'success' => true,
                "message" => 'Projeto excluído com sucesso.'
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error'      => true,
                'message'    => 'Projeto não localizado.'
            ];
        } catch (QueryException $e) {
            return [
                'error'      => true,
                'message'    => 'Este Projeto não pode ser excluído, pois existe um ou mais membros vinculados a ele.'
            ];
        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Falha ao excluir Projeto. Tente novamente.'
            ];
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function checkPermissionProject($id)
    {
        $userId = \Authorizer::getResourceOwnerId();

        if($this->repository->isOwner($id,$userId) or $this->repository->hasMember($id,$userId))
        {
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function checkOwner($id)
    {
        $userId = \Authorizer::getResourceOwnerId();

        if($this->repository->isOwner($id,$userId))
        {
            return true;
        }
        return false;
    }
}