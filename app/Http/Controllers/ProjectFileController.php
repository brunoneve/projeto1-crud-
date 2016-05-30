<?php

namespace CursoCode\Http\Controllers;

use CursoCode\Services\ProjectFileService;
use Illuminate\Http\Request;


class ProjectFileController extends Controller
{

    /**
     * @var ProjectFileService
     */
    private $service;

    /**
     * ProjectFileController constructor.
     * @param ProjectFileService $service
     */
    public function __construct(ProjectFileService $service)
    {
        $this->service = $service;
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

    /**
     * @param $project_id
     * @param $id
     * @return array
     */
    public function destroy($project_id, $id)
    {
        return $this->service->destroy($project_id, $id);
    }
}
