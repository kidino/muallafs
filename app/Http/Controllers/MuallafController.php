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

    function annual_report($year = null) {
        if ($year == null) $year = date('Y');

        $year_mon = ['JANUARI', 'FEBRUARI', 'MAC', 'APRIL', 'ME', 'JUN', 'JULAI', 'OGOS', 'SEPTEMBER', 'OKTOBER' ,'NOVEMBER','DISEMBER' ];
        $kaum = Kaum::all();
        $data = [];
        foreach($year_mon as $km => $ym){
            foreach($kaum as $k) {
                $data[$year.'-'. str_pad($km+1, 2, '0', STR_PAD_LEFT) ][$k->name]['L'] = 0;
                $data[$year.'-'. str_pad($km+1, 2, '0', STR_PAD_LEFT) ][$k->name]['P'] = 0;
                $data[$year.'-'. str_pad($km+1, 2, '0', STR_PAD_LEFT) ]['JUMLAH']['L'] = 0;
                $data[$year.'-'. str_pad($km+1, 2, '0', STR_PAD_LEFT) ]['JUMLAH']['P'] = 0;
                $data[$year.'-'. str_pad($km+1, 2, '0', STR_PAD_LEFT) ]['JUMLAH']['ALL'] = 0;
                $data['JUMLAH'][$k->name]['L'] = 0;
                $data['JUMLAH'][$k->name]['P'] = 0;
                $data['JUMLAH'][$k->name]['ALL'] = 0;

                $data['JUMLAH']['JUMLAH']['L'] = 0;
                $data['JUMLAH']['JUMLAH']['P'] = 0;
                $data['JUMLAH']['JUMLAH']['ALL'] = 0;

            }
        }

        $rpdata = \DB::table('muallafs')
                        ->leftJoin('kaum', 'muallafs.kaum', '=', 'kaum.id')
                        ->select(\DB::raw('DATE_FORMAT(tarikh_islam, \'%Y-%m\') AS YM,
                        `kaum`.`name` as kaum_name, 
                        IF(`muallafs`.jantina = 1, "L", "P") AS jant,
                        COUNT(*) as total '))
                        ->whereBetween('tarikh_islam', [$year.'-01-01', ($year+1).'-01-01'])
                        ->groupBy('YM', 'kaum_name', 'jant')
                        ->get();

        foreach($rpdata as $rp) {
            $data[$rp->YM][$rp->kaum_name][$rp->jant] = $rp->total;
        }
        
        foreach($data as $k => $dt) {
            foreach($dt as $v => $dv) {
                $data[$k]['JUMLAH']['L'] += $dv['L'];
                $data[$k]['JUMLAH']['P'] += $dv['P'];
                $data[$k]['JUMLAH']['ALL'] += $dv['L'];
                $data[$k]['JUMLAH']['ALL'] += $dv['P'];

                $data['JUMLAH'][$dv->name]['L'] += $dv['L'];
                $data['JUMLAH'][$dv->name]['P'] += $dv['P'];
                $data['JUMLAH'][$dv->name]['ALL'] += $dv['L'];
                $data['JUMLAH'][$dv->name]['ALL'] += $dv['P'];

                $data['JUMLAH']['JUMLAH']['L'] += $dv['L'];
                $data['JUMLAH']['JUMLAH']['P'] += $dv['P'];
                $data['JUMLAH']['JUMLAH']['ALL'] += $dv['L'];
                $data['JUMLAH']['JUMLAH']['ALL'] += $dv['P'];
            }
        }

        return Voyager::view('muallaf.annual_report', compact('data', 'year','kaum','year_mon'));

    }

    function welcome() {
        return view('alternate');
    }

    /* ----------- JSON API ------------- */

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
                        ->groupBy('kaum.name')
                        ->get();

        $data = [];
        foreach( $race as $rc) {
            $labels[] = $rc->name;
            $data[] = $rc->total;
        }  

        return response()->json([ 'labels' => $labels, 'data' => $data ]);
    }

}
