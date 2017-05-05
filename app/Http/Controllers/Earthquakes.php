<?php

namespace awase\Http\Controllers;

use Illuminate\Http\Request;

class Earthquakes extends Controller
{
    public function __construct(){
      // $this->middleware('basic.auth');
      // $this->middleware('auth');

    }

    public function index(){
      $data['page_title'] = 'Awase - Earthquakes';
      $data['sesi'] = 'Earthquakes';
      $data['dataCount'] = $this->count();
      $data['thead'] = array('Magnitude (SR)','Deep (Km)', 'Date & Time', 'Lat', 'Lng', 'Action');
      $data['dataTable'] = $this->showAllPaging();
      return view('admin/admin')->with($data);
    }

    public function search(Request $request){
      $dataPosted = $request->all();
      $data['page_title'] = 'Awase - Earthquakes';
      $data['sesi'] = 'Earthquakes';
      $data['thead'] = array('Magnitude (SR)','Deep (Km)', 'Date & Time', 'Lat', 'Lng', 'Action');
      $data['dataCount'] = $this->count();
      $data['dataTable'] = $this->showLike($dataPosted['q']);
      return view('admin/admin')->with($data);
      // print_r($data['dataTable']);
    }

    public function getEarthquakesImpacts(){
      $earthquakesImpacts = \awase\EarthquakeImpact::all();
      return $earthquakesImpacts;
    }


    public function getJsonEarthquakeBMKG()
    {
      header('Content-Type: application/json; charset=utf-8');
      $url = "http://data.bmkg.go.id/gempaterkini.xml";
  		$xml = simplexml_load_file($url);
  		$json = json_encode($xml);
  		$arr = json_decode($json,TRUE);
  		$data= array();

      foreach ($arr as $arg)
      {
  			for ($i=0; $i < 60; $i++)
        {
  				$latex = explode(" ", $arg[$i]['Lintang']);
  				$lngex = explode(" ", $arg[$i]['Bujur']);
  				$wil = explode(" ", $arg[$i]["Wilayah"]);
          $mag = explode(" ", $arg[$i]["Magnitude"]);
          $deep = explode(" ", $arg[$i]["Kedalaman"]);

  				if($latex[1] == "LU")
          {
  					$lat = $latex[0];
  				}else
          {
  					$lat = "-".$latex[0];
  				}

  				if($lngex[1] == "BT")
          {
  					$lng = $lngex[0];
  				}else
          {
  					$lng = "-".$lngex[0];
  				}

  				$a= array(
  					"tanggal" => $arg[$i]["Tanggal"],
  					"jam" => $arg[$i]["Jam"],
  					"lat" => $lat,
  					"lng" => $lng,
  					"magnitude" => $mag[0],
  					"kedalaman" => $deep[0],
  					"wilayah" => $wil[3]
  				);

  				array_push($data, $a);
  			}
  		}

      // echo json_encode($data[0]);
      return $data;
    }

    public function getJsonTsunamiBMKG()
    {
      header('Content-Type: application/json; charset=utf-8');
      $url = "http://data.bmkg.go.id/lasttsunami.xml";
  		$xml = simplexml_load_file($url);
  		$json = json_encode($xml);
  		$arr = json_decode($json,TRUE);
  		$data= array();

      // $latex = explode(" ", $arr['Gempa']['Lintang']);
      // $lngex = explode(" ", $arr['Gempa']['Bujur']);
      $mag = explode(" ", $arr['Gempa']["Magnitude"]);
      $deep = explode(" ", $arr['Gempa']["Kedalaman"]);



      $data = array(
        "tanggal" => $arr['Gempa']["Tanggal"],
        "jam" => $arr['Gempa']["Jam"],
        "lat" => $arr['Gempa']['Lintang'],
        "lng" => $arr['Gempa']['Bujur'],
        "magnitude" => $mag[0],
        "kedalaman" => $deep[0]
      );
      // print_r($data);
      return $data;
    }

    public function triggerCheckAddEarthquake(){
      $a = $this->getJsonEarthquakeBMKG();
      for($i = 0 ; $i < sizeof($a) ; $i++){
        $this->checkAddEarthquake($a[$i]);
      }
    }

    public function checkAddEarthquake($data){
      $checkEarthquake = \awase\Earthquakes::where('lat', $data['lat'])
                      ->where('lng', $data['lng'])
                      ->where('mag', $data['magnitude'])
                      ->count();

      $earthquakesImpacts = $this->getEarthquakesImpacts();

      if($checkEarthquake == 0){
        //Convert Datetime
        $jam = explode(" ", $data['jam']);
        $newJam = $jam[0];
        $date = date('Y-m-d', strtotime($data['tanggal']));
        $newDate = $date." ".$newJam;

        foreach($earthquakesImpacts as $ei){
          if($data['magnitude'] <= $ei['mag_max'] &&
              $data['magnitude'] > $ei['mag_min'] &&
              $data['kedalaman'] <= $ei['deep_max'] &&
              $data['kedalaman'] > $ei['deep_min']
          ){
            $idEI = $ei['id'];
          }
        }

        \awase\Earthquakes::create(array(
          'id_earthquake_impact' => $idEI,
          'lat' => $data['lat'],
          'lng' => $data['lng'],
          'mag' => $data['magnitude'],
          'deep' => $data['kedalaman'],
          'date' => $newDate,
          'tsunami_potential' => 0
        ));
      }
    }

    public function triggerCheckAddTsunami(){
        $data =  $this->getJsonTsunamiBMKG();
        $checkTsunami = \awase\Earthquake::where('lat', $data['lat'])
                    ->where('lng', $data['lng'])
                    ->where('mag', $data['magnitude'])
                    ->get();

        foreach ($checkTsunami as $list) {
          $earthquake = \awase\Earthquakes::find($list->id);
          $earthquake->tsunami_potential = 1;
          $earthquake->save();
        }
    }

    public function showAll(Request $request){
        header('Content-Type: application/json; charset=utf-8');
        $dataPosted = $request->all();
        $datasGet = array();

        $getAll = \awase\Earthquakes::all(array('id', 'lat', 'lng'));


        // $getAll = \App\AssemblyPoint::all(array('id', 'name', 'lat', 'lng'));


        foreach ($getAll as $list){
            $titikKumpul = array(
                'id' => $list->id,
                'lat' => $list->lat,
                'lng' => $list->lng
            );
            array_push($datasGet, $titikKumpul);
        }
        $out = array_values($datasGet);
        // echo json_encode($datasGet);
        // print_r($out);
        // var_dump($dataPosted);


        echo json_encode($out);
    }

    public function showRecent(Request $request){
      header('Content-Type: application/json; charset=utf-8');
      $dataPosted = $request->all();
      $datasGet = array();

      $getRecent = \awase\Earthquakes::all()->first();


        $data = array(
          'lat' => $getRecent->lat,
          'lng' => $getRecent->lng,
          'mag' => $getRecent->mag,
          'deep' => $getRecent->deep,
          'date' => $getRecent->date,
          'tsunami_potential' => $getRecent->tsunami_potential
        );
        array_push($datasGet, $data);

      $out = array_values($datasGet);
      // return response()->json($out);
      echo json_encode($data, JSON_PRETTY_PRINT);
      // return $out->toJson();
    }

    public function showDetail(Request $request){
      $dataPosted = $request->all();
      // $dataPosted['id'] = 2;
      header('Content-Type: application/json; charset=utf-8');
      $datasGet = array();

      // if($dataPosted['id']){
        $getAll = \awase\Earthquakes::where('id', $dataPosted['id'])
                  ->get();
      // }

      foreach ($getAll as $list){
          $titikKumpul = array(
              'id' => $list->id,
              'lat' => $list->lat,
              'lng' => $list->lng,
              'mag' => $list->mag,
              'deep' => $list->deep,
              'date' => $list->date,
              'tsunami' => $list->tsunami_potential
          );
          array_push($datasGet, $titikKumpul);
      }
      $out = array_values($datasGet);

      // var_dump(json_encode($dataPosted));
      // echo json_encode($dataPosted);
      echo json_encode($out);
    }

    public function showAllPaging()
    {
      $earthquakes = \awase\Earthquakes::paginate(15);
      return $earthquakes;
    }

    public function count(){
      $count = \awase\Earthquakes::all()
          ->count();

      // echo json_encode($count);
      return $count;
    }

}
