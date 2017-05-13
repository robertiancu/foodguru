<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Send friend request to user.
     *
     * @return void
     */
    public function makeFriendRequestToUser($new_friend)
    {

    }

    /**
     * Add a friend to the logged user.
     *
     * @throws ModelNotFoundException
     * @throws Exception
     * @return Response
     */
    public function addFriendToUser($friend_id)
    {
        $user = Auth::user();
        $friend = User::findOrFail($friend_id);

        if ($user === $friend) {
            throw new \Exception('A user is so alone that he wants to befriend himself.');
        }

        $this->addFriend($user, $friend);
    }

    /**
     * Make changes in database for the creation of friendship.
     *
     * @return void
     */
    protected function addFriend(User $user, User $friend)
    {
        $user->friends()->save($friend);
        $friend->friends()->save($user);
    }
}
