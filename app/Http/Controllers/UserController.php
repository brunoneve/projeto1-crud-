<?php

namespace CursoCode\Http\Controllers;
use CursoCode\Services\UserService;

class UserController extends Controller
{

    /**
     * @var UserService
     */
    private $service;

    /**
     * UserController constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function authenticated()
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->service->find($userId);
    }

    public function index()
    {
        return $this->service->all();
    }

}