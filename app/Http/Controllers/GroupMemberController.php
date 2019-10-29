<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\GroupUserService\GroupUserServiceInterface;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
{
    protected $groupMemberService;

    public function __construct(GroupUserServiceInterface $groupUserService)
    {
        $this->groupMemberService = $groupUserService;
    }

    public function index($groupId)
    {
        $members = $this->groupMemberService->getAllMember($groupId, 5);
        return view('admin.group..member.member-management', compact('members'));
    }

    public function remove($groupId, $userId)
    {
        $this->groupMemberService->removeMember($groupId, $userId);
        return redirect()->back()->with('status', 'Remove member sucess');
    }
}
