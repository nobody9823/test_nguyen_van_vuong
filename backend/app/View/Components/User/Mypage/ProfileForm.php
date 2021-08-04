<?php

namespace App\View\Components\User\Mypage;

use Illuminate\View\Component;

class ProfileForm extends Component
{
    public $authUser;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($authUser)
    {
        $this->authUser = $authUser->loadExists('snsUser')->load(['snsLink', 'address', 'profile']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.mypage.profile-form');
    }
}
