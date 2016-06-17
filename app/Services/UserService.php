<?php

namespace CursoCode\Services;

use CursoCode\Repositories\UserRepository;

class UserService
{
    private $repository;
    
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        try {
            return $this->repository->all();
        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Nenhum registro encontrado.'
            ];
        }
    }

    public function find($id)
    {
        try {
            return $this->repository->find($id);
        } catch (\Exception $e) {
            return [
                "error"      => true,
                "message"    => 'Registro não encontrado.'
            ];
        }
    }
}