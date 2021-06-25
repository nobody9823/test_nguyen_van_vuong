<?php

namespace App\View\Components\User\Mypage;

use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class ProfileForm extends Component
{
    public $inputType;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->inputType = false;
    }

    public function requestType()
    {
        if (Request::get('input_type') === 'name') {
            $this->inputType = 'name';
        } else if (Request::get('input_type') === 'email') {
            $this->inputType = 'email';
        } else if (Request::get('input_type') === 'password') {
            $this->inputType = 'password';
        } else if (Request::get('input_type') === 'forgot_password') {
            $this->inputType = 'forgot_password';
        } else if (Request::get('input_type') === 'birthday') {
            $this->inputType = 'birthday';
        } else if (Request::get('input_type') === 'gender') {
            $this->inputType = 'gender';
        } else if (Request::get('input_type') === 'introduction') {
            $this->inputType = 'introduction';
        }

        return $this->inputType;
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
