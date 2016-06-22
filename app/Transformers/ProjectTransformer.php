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
            'id' => $project->id,
            'client_id' => (int) $project->client_id,
            'owner_id' => (int) $project->owner_id,
            'progress' => (int) $project->progress,
            'status' => $project->status,
            'name' => $project->name,
            'description' => $project->description,
            'due_date' => $project->due_date,
            'created' => $project->created_at,
            'updated' => $project->updated_at,
        ];
    }



    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }


    public function includeClient(Project $project)
    {
        return $this->item($project->client, new ClientTransformer());
    }


    public function includeTasks(Project $project)
    {
        return $this->collection($project->tasks, new ProjectTaskTransformer());
    }


    public function includeNotes(Project $project)
    {
        return $this->collection($project->notes, new ProjectNoteTransformer());
    }

    public function includeFiles(Project $project)
    {
        return $this->collection($project->files, new ProjectFileTransformer());
    }
}