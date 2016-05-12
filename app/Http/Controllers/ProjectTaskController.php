<?php

namespace CursoCode\Http\Controllers;

use CursoCode\Services\ProjectTaskService;
use Illuminate\Http\Request;


class ProjectTaskController extends Controller
{

    /**
     * @var ProjectTaskService
     */
    private $service;

    /**
     * ProjectController constructor.
     * @param ProjectTaskService $service
     */
    public function __construct(ProjectTaskService $service)
    {
        $this->service = $service;
    }

    /**
     * @param $project_id
     * @return mixed
     */
    public function index($project_id)
    {
        return $this->service->all($project_id);
    }


    /**
     * @param Request $request
     * @return array|mixed
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $project_id
     * @param  int  $task_id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id, $task_id)
    {
        return $this->service->find($project_id,$task_id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $project_id
     * @param  int  $task_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project_id, $task_id)
    {
        return $this->service->update($request->all(), $task_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $project_id
     * @param  int  $task_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id, $task_id)
    {
        return $this->service->destroy($task_id);
    }
}
