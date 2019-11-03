<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\DateVideoService\DateVideoServiceInterface;
use Illuminate\Http\Request;

class DateVideoController extends Controller
{
    protected $dateVideoService;

    public function __construct(DateVideoServiceInterface $dateVideoService)
    {
        $this->dateVideoService = $dateVideoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allVideoViewHistory = $this->dateVideoService->getAllVideoViewHistory();
        return view('admin.analytics.history', compact('allVideoViewHistory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchByDate(Request $request)
    {
        if($this->dateVideoService->checkHaveDateInRequest($request)){
            return redirect()->route('analytics.search.date.result', $request->date);
        }else{
            return redirect()->route('analytics.index');
        }
    }

    public function resultSearchByDate($date)
    {
        $allVideoViewHistory = $this->dateVideoService->getResultSearchByDate($date);
        return view('admin.analytics.history', compact('allVideoViewHistory'));
    }

}
