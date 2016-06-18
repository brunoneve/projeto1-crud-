<?php

namespace CursoCode\Transformers;

use CursoCode\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'members', 'client', 'tasks', 'notes', 'files'
    ];

    /**
     * @param Project $project
     * @return array
     */
    public function transform(Project $project)
    {
        return [
            'project_id' => $project->id,
            'client_id' => $project->client_id,
            'owner_id' => $project->owner_id,
            'name' => $project->name,
            'description' => $project->description,
            'progress' => $project->progress,
            'status' => $project->status,
            'due_date' => $project->due_date,
            'created' => $project->created_at,
            'updated' => $project->updated_at,
        ];
    }


    /**
     * @param Project $project
     * @return \League\Fractal\Resource\Collection
     */
    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }

    /**
     * @param Project $project
     * @return \League\Fractal\Resource\Item
     */
    public function includeClient(Project $project)
    {
        return $this->item($project->client, new ClientTransformer());
    }

    /**
     * @param Project $project
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTasks(Project $project)
    {
        return $this->collection($project->tasks, new ProjectTaskTransformer());
    }

    /**
     * @param Project $project
     * @return \League\Fractal\Resource\Collection
     */
    public function includeNotes(Project $project)
    {
        return $this->collection($project->notes, new ProjectNoteTransformer());
    }

    /**
     * @param Project $project
     * @return \League\Fractal\Resource\Collection
     */
    public function includeFiles(Project $project)
    {
        return $this->collection($project->files, new ProjectFileTransformer());
    }
}