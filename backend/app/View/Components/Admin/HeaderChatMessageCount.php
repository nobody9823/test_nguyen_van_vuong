<?php

namespace App\View\Components\Admin;

use App\Models\AdminMessageContent;
use Illuminate\View\Component;

class HeaderChatMessageCount extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function adminMessageContentsCount()
    {
        return AdminMessageContent::notRead("管理者")->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.header-chat-message-count');
    }
}
