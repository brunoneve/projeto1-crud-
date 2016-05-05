<?php

namespace CursoCode\Services;


use CursoCode\Repositories\ClientRepository;
use CursoCode\Validators\ClientValidator;
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
        }
    }


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
        }
    }

    public function destroy($id)
    {
        try{
            $client = $this->repository->find($id);

            if($client){
                $this->repository->delete($id);

                return [
                    'success' => true,
                    'message' => 'Client successfully deleted'
                ];
            }

        }catch (\Exception $e) {
            return [
                'success' => 'false',
                'message' => "Could not delete the Client {$id}"
            ];
        }
    }
}