<?php

namespace App\Http\Controllers\Backend\Group;

use App\Http\Controllers\Controller;
use App\Services\GroupService\GroupServiceInterface;
use App\Services\GroupUserService\GroupUserServiceInterface;
use App\Services\GroupVideoService\GroupVideoServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNameRequest;
use App\Services\SubService\SessionService;

class GroupController extends Controller
{
    protected $groupService;
    protected $groupUserService;
    protected $groupVideoService;
    protected $sessionService;

    public function __construct(GroupServiceInterface $groupService,
                                GroupUserServiceInterface $groupUserService,
                                GroupVideoServiceInterface $groupVideoService,
                                SessionService $sessionService)
    {
        $this->groupService = $groupService;
        $this->groupUserService = $groupUserService;
        $this->groupVideoService = $groupVideoService;
        $this->sessionService = $sessionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = $this->groupService->paginate();
        return view('back_end.group.list', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back_end.group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNameRequest $request)
    {
        $newGroup = $this->groupService->store($request);
        $groupId = $newGroup->id;
        return redirect()->route('groups.show', compact('groupId'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->groupService->checkGroupSessionExist($id);
        $group = $this->groupService->getById($id);
        $totalMembers = $this->groupUserService->countMember($id);
        $totalVideos = $this->groupVideoService->countVideo($id);
        return view('back_end.group.detail', compact('group', 'totalMembers', 'totalVideos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = $this->groupService->getById($id);
        return view('back_end.group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNameRequest $request, $id)
    {
        $this->groupService->update($request, $id);
        return redirect()->route('groups.show', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->groupService->delete($id);
        return redirect()->route('groups.index');
    }
}
