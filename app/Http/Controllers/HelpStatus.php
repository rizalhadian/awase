<?php

namespace awase\Http\Controllers;

use Illuminate\Http\Request;

class HelpStatus extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['page_title'] = 'Awase - Help Status';
      $data['sesi'] = 'Help Status';
      $data['thead'] = array('Status Name', 'Action');
      $data['dataCount'] = $this->count();
      $data['dataTable'] = $this->showAllPaging();
      return view('admin/admin')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $dataPosted = $request->all();
      $helpStatus = \awase\HelpStatus::create(array(
        'name' => $dataPosted['name']
      ));
      echo json_encode('success!');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showId(Request $request)
    {
        $dataPosted = $request->all();
        $datasGet = array();
        $helpStatus = \awase\HelpStatus::where('id', $dataPosted['id'])
                            ->get();

        foreach($helpStatus as $list)
        {
          $data = array(
            'id' => $list->id,
            'name' => $list->name
          );
          array_push($datasGet, $data);
        }
        $out = array_values($datasGet);
        return response()->json($out);
    }

    public function showLike($q)
    {
      $helpStatus = \awase\HelpStatus::where('name', 'LIKE', '%'.$q.'%')
                          ->paginate(15);
      return $helpStatus;
    }

    public function showAll(){

    }

    public function showAllPaging(){
      $helpStatus = \awase\HelpStatus::paginate(15);
      return $helpStatus;
    }

    public function search(Request $request){
      $dataPosted = $request->all();
      $data['page_title'] = 'Awase - Help Status';
      $data['sesi'] = 'Help Status';
      $data['thead'] = array('Name', 'Action');
      $data['dataCount'] = $this->count();
      $data['dataTable'] = $this->showLike($dataPosted['q']);
      return view('admin/admin')->with($data);
      // print_r($data['dataTable']);
    }



    public function update(Request $request)
    {
        $dataPosted = $request->all();
        $helpStatus = \awase\helpStatus::find($dataPosted['id']);
        $helpStatus->name = $dataPosted['name'];

        if($helpStatus->save()){
          echo json_encode("Success");
        }else{
          echo json_encode('Fail');
        }
    }


    public function destroy(Request $request)
    {
        $dataPosted = $request->all();
        $helpStatus = \awase\HelpStatus::find($dataPosted['id']);

        if($helpStatus->delete()){
          echo json_encode('Success');
        }else{
          echo json_encode('Fail');
        }
    }

    public function count()
    {
      $count = \awase\HelpStatus::all()
                ->count();

      return $count;
    }
}
