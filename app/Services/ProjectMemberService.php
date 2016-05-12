<?php

namespace CursoCode\Services;


use CursoCode\Repositories\ProjectMemberRepository;
use CursoCode\Repositories\ProjectRepository;
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
     * @var ProjectRepository
     */
    protected $projectRepository;

    /**
     * @var ProjectMemberValidator
     */
    protected $validator;

    /**
     * ProjectService constructor.
     * @param ProjectMemberRepository $repository
     * @param ProjectMemberValidator $validator
     */
    public function __construct(ProjectMemberRepository $repository, ProjectRepository $projectRepository, ProjectMemberValidator $validator)
    {
        $this->repository = $repository;
        $this->projectRepository = $projectRepository;
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
     * @param $member_id
     * @return array|mixed
     */
    public function find($id,$member_id)
    {
        try{
            return $this->repository->findWhere(['project_id' => $id, 'member_id' => $member_id]);

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

            $retorno = $this->projectRepository->addMember($data['project_id'], $data['member_id']);

            return [
                'success' => $retorno,
                "message" => 'Membro adicionado ao projeto.'
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
     * @param $project_id
     * @param $member_id
     * @return array
     */
    public function destroy($project_id, $member_id)
    {
        try {
            $this->projectRepository->removeMember($project_id, $member_id);
            return [
                'success' => true,
                "message" => 'Membro excluído com sucesso.'
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