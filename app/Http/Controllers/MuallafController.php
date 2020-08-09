<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use App\Muallaf;
use App\Kaum;
use App\Note;
use Illuminate\Support\Facades\Auth;

class MuallafController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{

    var $jantina = [ 0 => '', 1 => 'LELAKI', 2 => 'PEREMPUAN'];

    function notelist($id) {
        $menu = (object) array('name' => 'admin');
        $muallaf = Muallaf::find($id);
        $notes = Note::where('muallaf_id', $id)->orderBy('created_at', 'desc')->get();
        return Voyager::view('muallaf.notalist', compact('menu', 'muallaf','notes'));
    }

    function savenote(Request $request, $id){
        $user = Auth::user();

        $note = new Note;

        $note->content = $request->content;
        $note->muallaf_id = $id;
        $note->user_id = $user->id;

        $note->save();

        return redirect()->route('notelist', ['id' => $id ]);
    }

    function surat($id) {
        $muallaf = Muallaf::find($id);

        if (!$muallaf->jantina) {
            $muallaf->jantina = 0;
        }

        if ($muallaf->kaum) {
            $kaum = Kaum::find($muallaf->kaum);
            $muallaf->kaum = $kaum->name;
        } else {
            $muallaf->kaum = '';
        }

        if ($muallaf) {
            $muallaf->jantina  = $this->jantina[ $muallaf->jantina ];
        }

        if ($muallaf && empty($muallaf->foto)) {
            $muallaf->foto = '/assets/img/default-foto.gif';
        } else {
            $muallaf->foto = '/storage/'.$muallaf->foto;
        }

        if($muallaf && !empty($muallaf->tarikh_islam)) {
            $date = \DateTime::createFromFormat('Y-m-d', $muallaf->tarikh_islam);
            $muallaf->tarikh_islam = $date->format('j/n/Y');
        }

        if($muallaf && !empty($muallaf->tarikh_lahir)) {
            $date = \DateTime::createFromFormat('Y-m-d', $muallaf->tarikh_lahir);
            $muallaf->tarikh_lahir = $date->format('j/n/Y');
        }

        return view('muallaf.surat', compact('muallaf'));
    }

    function welcome() {
        return view('alternate');
    }

    /* ------------------------ */

    function days_month_count() {

        $date_start = date('Y-m-d', strtotime('-30 days'));
        $date_end = date('Y-m-d');

        $period = new \DatePeriod(
            new \DateTime( $date_start ),
            new \DateInterval('P1D'),
            new \DateTime( $date_end )
        );

        $days_30 = [];
        $labels = [];
        $data = [];
        foreach ($period as $key => $value) {
            $days_30[ $value->format('Y-m-d') ] = 0;
            $labels[] = $value->format('Y-m-d');
        }

        $days_count = \DB::table('muallafs')
                        ->select(\DB::raw('tarikh_islam, COUNT(*) as total'))
                        ->whereBetween('tarikh_islam', [$date_start, $date_end])
                        ->groupBy('tarikh_islam')
                        ->get();

        foreach( $days_count as $day_count) {
            $days_30[ $day_count->tarikh_islam ] = $day_count->total;
        }  

        foreach($days_30 as $k => $v) {
            $data[] = $v;
        }

        return response()->json([ 'labels' => $labels, 'data' => $data ]);
    }

    function conversion_by_gender_30() {
        $date_start = date('Y-m-d', strtotime('-30 days'));
        $date_end = date('Y-m-d');

        $labels = ['LELAKI', 'PEREMPUAN'];

        $genders = \DB::table('muallafs')
                        ->select(\DB::raw('jantina, COUNT(*) as total'))
                        ->whereBetween('tarikh_islam', [$date_start, $date_end])
                        ->groupBy('jantina')
                        ->orderBy('jantina','asc')
                        ->get();

        $data = [];
        foreach( $genders as $gend) {
            $data[] = $gend->total;
        }  

        return response()->json([ 'labels' => $labels, 'data' => $data ]);
    }

    function conversion_by_race_30() {
        $date_start = date('Y-m-d', strtotime('-30 days'));
        $date_end = date('Y-m-d');

        $labels = [];
        $data = [];

        $race = \DB::table('muallafs')
                        ->leftJoin('kaum', 'muallafs.kaum', '=', 'kaum.id')
                        ->select(\DB::raw('`kaum`.`name`, COUNT(*) as total'))
                        ->whereBetween('muallafs.tarikh_islam', [$date_start, $date_end])
                        ->groupBy('muallafs.kaum')
                        ->get();

        $data = [];
        foreach( $race as $rc) {
            $labels[] = $rc->name;
            $data[] = $rc->total;
        }  

        return response()->json([ 'labels' => $labels, 'data' => $data ]);
    }

}
