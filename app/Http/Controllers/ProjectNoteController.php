<?php

namespace CursoCode\Http\Controllers;

use CursoCode\Services\ProjectNoteService;
use Illuminate\Http\Request;


class ProjectNoteController extends Controller
{

    /**
     * @var ProjectNoteService
     */
    private $service;

    /**
     * ProjectController constructor.
     * @param ProjectNoteService $service
     */
    public function __construct(ProjectNoteService $service)
    {
        $this->service = $service;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function index($id)
    {
        return $this->service->all($id);//(['project_id' => $id]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $note_id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $note_id)
    {
        return $this->service->find($id,$note_id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $note_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $note_id)
    {
        return $this->service->update($request->all(), $note_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $note_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $note_id)
    {
        return $this->service->destroy($note_id);
    }
}
