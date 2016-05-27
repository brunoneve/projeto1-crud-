<?php

namespace CursoCode\Transformers;

use CursoCode\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends TransformerAbstract
{
    /**
     * @param ProjectTask $task
     * @return array
     */
    public function transform(ProjectTask $task)
    {
        return [
            'task_id' => $task->id,
            'project_id' => $task->project_id,
            'name' => $task->name,
            'start_date' => $task->start_date,
            'due_date' => $task->due_date,
            'status' => $task->status,
            'created' => $task->created_at,
            'updated' => $task->updated_at,
        ];
    }
}