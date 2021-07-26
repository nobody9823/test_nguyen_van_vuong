<?php

namespace App\Services\View;

class EditMyProjectTabService {

    protected $my_project_tab = [
        0 => 'target_amount',
        1 => 'overview',
        2 => 'visual',
        3 => 'return',
        4 => 'ps_return',
        5 => 'identification'
    ];

    protected $current_tag_order = null;

    protected $next_tag_order = null;

    public function getNextTab($tab_name)
    {
        if ($tab_name !== null){
            $this->current_tag_order = array_search($tab_name, $this->my_project_tab);
        }

        if ($this->current_tag_order < 5) {
            $this->next_tag_order = $this->current_tag_order + 1;
        } elseif ($this->current_tag_order === 5) {
            $this->next_tag_order = 0;
        }
        return $this->my_project_tab[$this->next_tag_order];
    }
}