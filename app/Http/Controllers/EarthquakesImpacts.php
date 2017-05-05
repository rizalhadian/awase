<?php

namespace awase\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;

class EarthquakesImpacts extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $data['page_title'] = 'Awase - Earthquakes Impacts';
      $data['sesi'] = 'Earthquakes Impacts';
      $data['thead'] = array('Mag Max','Mag Min', 'Deep Max (Km)', 'Deep Min (Km)', 'Impact Area (Km)', 'Action');
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
        $generatedId = uniqid();
        $datasGet = array();

        \awase\EarthquakeImpact::create(array(
          'generated_id' => $generatedId,
          'mag_min' => $dataPosted['mag_min'],
          'mag_max' => $dataPosted['mag_max'],
          'deep_min' => $dataPosted['deep_min'],
          'deep_max' => $dataPosted['deep_max'],
          'impact_area' => $dataPosted['impact_area']
        ));

        $earthquakeImpact = \awase\EarthquakeImpact::where('generated_id', $generatedId)
                            ->get();
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
      $earthquakeImpact = \awase\EarthquakeImpact::where('id', $dataPosted['id'])
                          ->get();

      foreach($earthquakeImpact as $list)
      {
        $data = array(
          'id' => $list->id,
          'mag_min' => $list->mag_min,
          'mag_max' => $list->mag_max,
          'deep_min' => $list->deep_min,
          'deep_max' => $list->deep_max,
          'impact_area' => $list->impact_area
        );
        array_push($datasGet, $data);
      }
      $out = array_values($datasGet);
      return response()->json($out);
      // echo json_encode($dataPosted['id']);
    }

    public function showLike($q)
    {
      $earthquakeImpact = \awase\EarthquakeImpact::where('mag_max', 'LIKE', '%'.$q.'%')
                          ->orWhere('mag_min', 'LIKE', '%'.$q.'%')
                          ->orWhere('deep_max', 'LIKE', '%'.$q.'%')
                          ->orWhere('deep_min', 'LIKE', '%'.$q.'%')
                          ->orWhere('impact_area', 'LIKE', '%'.$q.'%')
                          ->paginate(15);
      return $earthquakeImpact;
    }

    public function showAll(Request $request)
    {
      $datasGet = array();
      $earthquakeImpact = \awase\EarthquakeImpact::all();

      foreach($earthquakeImpact as $list)
      {
        $data = array(
          'mag_min' => $list->mag_min,
          'mag_max' => $list->mag_max,
          'deep_min' => $list->deep_min,
          'deep_max' => $list->deep_max,
          'impact_area' => $list->impact_area
        );
        array_push($datasGet, $data);
      }
      $out = array_values($datasGet);
      return response()->json($out);
    }

    public function showAllPaging()
    {
      $earthquakeImpact = \awase\EarthquakeImpact::paginate(15);
      return $earthquakeImpact;
    }

    public function search(Request $request){
      $dataPosted = $request->all();
      $data['page_title'] = 'Awase - Earthquakes Impacts';
      $data['sesi'] = 'Earthquakes Impacts';
      $data['thead'] = array('Mag Max','Mag Min', 'Deep Max (Km)', 'Deep Min (Km)', 'Impact Area (Km)', 'Action');
      $data['dataCount'] = $this->count();
      $data['dataTable'] = $this->showLike($dataPosted['q']);
      return view('admin/admin')->with($data);
      // print_r($data['dataTable']);
    }

    public function update(Request $request)
    {
        $dataPosted = $request->all();
        $earthquakeImpact = \awase\EarthquakeImpact::find($dataPosted['id']);
        $earthquakeImpact->mag_min = $dataPosted['mag_min'];
        $earthquakeImpact->mag_max = $dataPosted['mag_max'];
        $earthquakeImpact->deep_min = $dataPosted['deep_min'];
        $earthquakeImpact->deep_max = $dataPosted['deep_max'];
        $earthquakeImpact->impact_area = $dataPosted['impact_area'];

        if($earthquakeImpact->save()){
          echo json_encode("Success");
        }else{
          echo json_encode('Fail');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $dataPosted = $request->all();

      $earthquakeImpact = \awase\EarthquakeImpact::find($dataPosted['id']);

      if($earthquakeImpact->delete()){
        echo json_encode('Success');
      }else{
        echo json_encode('Fail');
      }


    }

    public function count()
    {
      $count = \awase\EarthquakeImpact::all()
                ->count();

      return $count;
    }
}
