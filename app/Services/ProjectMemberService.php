<?php

namespace CursoCode\Services;


use CursoCode\Repositories\ProjectMemberRepository;
use CursoCode\Validators\ProjectMemberValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectMemberService
{
    /**
     * @var ProjectMemberRepository
     */
    protected $repository;
    /**
     * @var ProjectMemberValidator
     */
    protected $validator;

    /**
     * ProjectService constructor.
     * @param ProjectMemberRepository $repository
     * @param ProjectMemberValidator $validator
     */
    public function __construct(ProjectMemberRepository $repository, ProjectMemberValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param $id
     * @return array|mixed
     */
    public function all($id)
    {
        try{
           return $this->repository->findWhere(['project_id' => $id]);
        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Nenhum membro encontrado para esse projeto.'
            ];
        }
    }

    /**]
     * @param $id
     * @param $task_id
     * @return array|mixed
     */
    public function find($id,$task_id)
    {
        try{
            return $this->repository->findWhere(['project_id' => $id, 'id' => $task_id]);

        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Membro não localizada.'
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
            $this->repository->delete($id);
            return [
                'success' => true,
                "message" => 'Membro excluída com sucesso.'
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error'      => true,
                'message'    => 'Membro não localizado.'
            ];
        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Falha ao excluir membro. Tente novamente.'
            ];
        }
    }
}