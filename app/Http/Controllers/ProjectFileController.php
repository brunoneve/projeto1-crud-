<?php

namespace CursoCode\Http\Controllers;

use CursoCode\Services\ProjectFileService;
use CursoCode\Services\ProjectService;
use Illuminate\Http\Request;


class ProjectFileController extends Controller
{

    /**
     * @var ProjectFileService
     */
    private $service;
    /**
     * @var ProjectService
     */
    private $projectService;

    /**
     * ProjectFileController constructor.
     * @param ProjectFileService $service
     * @param ProjectService $projectService
     */
    public function __construct(ProjectFileService $service, ProjectService $projectService)
    {
        $this->service = $service;
        $this->projectService = $projectService;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function index($id)
    {
        return $this->service->all($id);
    }

    /**
     * @param Request $request
     * @param $project_id
     */
    public function store(Request $request, $project_id)
    {

        $file = $request->file('file');

        if(!empty($file))
        {
            $ext = $file->getClientOriginalExtension();
            $data['extension'] = $ext;
        }

        $data['file'] = $file;
        $data['name'] = $request->name;
        $data['project_id'] = $project_id;
        $data['description'] = $request->description;

        $this->service->create($data);

    }

    public function show($id)
    {
        return $this->service->find($id);
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }
    
    public function showFile($id)
    {
        return $this->service->downloadFile($id);
    }

    /**
     * @param $project_id
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
