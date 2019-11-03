<?php


namespace App;


class InvitationList
{
    public $groupId = null;
    public $users = null;

    public function __construct($oldInvitationList)
    {
        if ($oldInvitationList) {
            $this->groupId = $oldInvitationList->groupId;
            $this->users = $oldInvitationList->users;
        }
    }

    public function addUserToInvitationList($groupId, $user)
    {
        if (!$this->groupId) {
            $this->groupId = $groupId;
        }
        if ($this->users) {
            if (array_key_exists($user->id, $this->users)) {
                dd('da moi user nay');
            }
        }
        $this->users[$user->id] = $user;
    }

    public function removeUserFromInvitationList($userId)
    {
        if ($this->users) {
            if (array_key_exists($userId, $this->users)) {
                unset($this->users[$userId]);
            }
        }
    }
}
