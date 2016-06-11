<?php

namespace CursoCode\Services;


use CursoCode\Repositories\ClientRepository;
use CursoCode\Validators\ClientValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService
{
    /**
     * @var ClientRepository
     */
    protected $repository;
    /**
     * @var ClientValidator
     */
    protected $validator;

    public function __construct(ClientRepository $repository, ClientValidator $validator)
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
            return $this->repository->skipPresenter()->all();

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
            return $this->repository->skipPresenter()->find($id);

        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Cliente não localizado.'
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
                "message" => 'Cliente excluído com sucesso.'
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error'      => true,
                'message'    => 'Cliente não localizado.'
            ];
        } catch (QueryException $e) {
            return [
                'error'      => true,
                'message'    => 'Este Cliente não pode ser excluído, pois existe um ou mais projetos vinculados a ele.'
            ];
        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Falha ao excluir Cliente. Tente novamente.'
            ];
        }

    }
}