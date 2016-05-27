<?php

namespace CursoCode\Transformers;

use CursoCode\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{

    public function transform(Project $project)
    {
        return [
            'project_id' => $project->id,
            'owner_id' => $project->owner_id,
            'project' => $project->name,
            'description' => $project->description,
            'progress' => $project->progress,
            'status' => $project->status,
            'due_date' => $project->due_date,
            'created' => $project->created_at,
            'updated' => $project->updated_at,
        ];
    }
}