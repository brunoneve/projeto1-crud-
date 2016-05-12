<?php

namespace CursoCode\Http\Controllers;

use CursoCode\Services\ProjectMemberService;
use Illuminate\Http\Request;


class ProjectMemberController extends Controller
{

    /**
     * @var ProjectMemberService
     */
    private $service;

    /**
     * ProjectMemberController constructor.
     * @param ProjectMemberService $service
     */
    public function __construct(ProjectMemberService $service)
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
     * @param  int  $member_id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id, $member_id)
    {
        return $this->service->find($project_id,$member_id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $project_id
     * @param  int  $member_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project_id, $member_id)
    {
        return $this->service->update($request->all(), $member_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $project_id
     * @param  int  $member_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id, $member_id)
    {
        return $this->service->destroy($project_id, $member_id);
    }
}
