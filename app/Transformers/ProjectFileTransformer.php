<?php

namespace CursoCode\Transformers;

use CursoCode\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;

class ProjectFileTransformer extends TransformerAbstract
{
    /**
     * @param ProjectFile $file
     * @return array
     */
    public function transform(ProjectFile $file)
    {
        return [
            'id' => $file->id,  
            'project_id' => (int) $file->project_id,
            'name' => $file->name,
            'description' => $file->description,
            'extension' => $file->extension
        ];
    }
}