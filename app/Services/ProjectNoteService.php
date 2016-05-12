<?php

namespace CursoCode\Services;


use CursoCode\Repositories\ProjectNoteRepository;
use CursoCode\Validators\ProjectNoteValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService
{
    /**
     * @var ProjectNoteRepository
     */
    protected $repository;
    /**
     * @var ProjectNoteValidator
     */
    protected $validator;

    /**
     * ProjectService constructor.
     * @param ProjectNoteRepository $repository
     * @param ProjectNoteValidator $validator
     */
    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
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
                "message"    => 'Nenhuma anotação encontrado para esse projeto.'
            ];
        }
    }

    /**]
     * @param $id
     * @param $note_id
     * @return array|mixed
     */
    public function find($id,$note_id)
    {
        try{
            return $this->repository->findWhere(['project_id' => $id, 'id' => $note_id]);

        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Nota não localizada.'
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
                "message" => 'Nota excluída com sucesso.'
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error'      => true,
                'message'    => 'Projeto não localizado.'
            ];
        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Falha ao excluir Nota. Tente novamente.'
            ];
        }
    }
}