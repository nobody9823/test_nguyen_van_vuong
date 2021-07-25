<?php

namespace App\View\Components\User;

use Auth;
use Crypt;
use Illuminate\View\Component;

class InvitationUrl extends Component
{
    public $project;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($project)
    {
        $this->project = $project;
    }

    public function invitationUrl()
    {
        $encrypted_code = Crypt::encrypt(Auth::user()->profile->inviter_code);
        return route('user.project.show', ['project' => $this->project, 'inviter' => $encrypted_code]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.invitation-url');
    }
}
