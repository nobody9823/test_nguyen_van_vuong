<?php

namespace App\View\Components\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class HeaderChatMessage extends Component
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

    public function messageContentsCount()
    {
        if (Auth::guard('web')->check()) {
            $chat_messages_by_supporter = Auth::user()->payments()->withCountNotReadBySupporter()->get();
            $chat_messages_by_executor = Auth::user()->projects()->withNotReadByExecutor()->get();
            return $chat_messages_by_supporter->sum('message_contents_count') + $chat_messages_by_executor->sum('message_contents_count');
        }
        return 0;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.header-chat-message');
    }
}
