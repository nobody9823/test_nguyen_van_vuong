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
            $chat_messages_by_supporter =
                Auth::user()->payments()->notGetUnderSuspensionProject()->withCountNotRead("支援者")->get();
            $chat_messages_by_executor =
                Auth::user()->projects()->notGetUnderSuspensionProject()->withNotReadByExecutor()->get();
            $chat_messages_to_admin =
                Auth::user()->load('adminMessageContents')->loadCount(['adminMessageContents' => function ($query) {
                    $query->notRead("ユーザー");
                }]);
            return $chat_messages_by_supporter->sum('message_contents_count') + $chat_messages_by_executor->sum('message_contents_count') + $chat_messages_to_admin->admin_message_contents_count;
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
