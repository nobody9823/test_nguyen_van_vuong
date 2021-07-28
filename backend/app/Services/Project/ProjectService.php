<?php

namespace App\Services\Project;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectFile;

class ProjectService
{
    protected $file_array = [];

    public function attachTags(Project $project, Request $request)
    {
        if($request->has('tags')){
            $project->tags()->detach();
            $project->tags()->attach(array_values($request->tags));
        } else if ($request->has('tags') === false && $request->current_tab === 'overview'){
            $project->tags()->detach();
        }
    }

    public function saveImages(Project $project, Request $request)
    {
        if ($request->has('visual_image_url')){

            foreach($request->visual_image_url as $key => $value){
                if($request->file_ids !== null && in_array((string) $key, $request->file_ids, true)){
                    $project_file = ProjectFile::find($key);
                    $project_file->file_url = $value[0];
                    $project_file->save();
                } else {
                    $this->file_array[] =
                    ProjectFile::make([
                        'file_url' => $value[0],
                        'file_content_type' => 'image_url'
                    ]);
                };
                if ($this->file_array !== []){
                    $project->projectFiles()->saveMany($this->file_array);
                }
            }
        }
    }

    public function saveVideoUrl(Project $project, Request $request)
    {
        if ($request->has('video_url') && $request->video_url !== null){
            $project->projectFiles()->save(
                ProjectFile::make([
                    'file_url' => $request->video_url,
                    'file_content_type' => 'video_url'
                ])
            );
        }
    }
}