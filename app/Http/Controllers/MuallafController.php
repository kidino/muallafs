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
}
