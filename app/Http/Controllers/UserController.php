<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use DataTables;
use Auth;

class UserController extends Controller
{
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->userRepository->list();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('photo', function($row){
                    $btn = '<img class="image rounded-circle" src='.asset('/storage/images/'.$row->photo).' alt="profile_image" style="width: 80px;height: 80px; padding: 10px; margin: 0px; ">';
                    return $btn;
                })
                ->addColumn('action', function($row){
                    $btn = Auth::user()->id != $row->id ? '<a href="javascript:void(0)" class="delete delete_'.$row->id.' btn btn-primary btn-sm" data-id="'.$row->id.'">Delete</a>' : '';
                    return $btn;
                })
                ->rawColumns(['photo', 'action'])
                ->make(true);
        }

        return view('index');
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
    public function destroy(Request $request)
    {
        $this->userRepository->delete($request->id);
        return response()->json(['status'=>'200']);
    }
}
