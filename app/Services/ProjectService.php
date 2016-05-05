<?php

namespace CursoCode\Services;


use CursoCode\Repositories\ProjectRepository;
use CursoCode\Validators\ProjectValidator;
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
        }
    }

    /**
     * @param $id
     * @return array
     */
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