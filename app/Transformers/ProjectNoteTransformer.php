<?php

namespace CursoCode\Transformers;

use CursoCode\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformer extends TransformerAbstract
{

    /**
     * @param ProjectNote $note
     * @return array
     */
    public function transform(ProjectNote $note)
    {
        return [
            'note_id' => $note->id,
            'project_id' => $note->project_id,
            'title' => $note->title,
            'note' => $note->note,
            'created' => $note->created_at,
            'updated' => $note->updated_at
        ];
    }
}