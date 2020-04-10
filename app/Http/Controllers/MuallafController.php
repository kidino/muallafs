<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use App\Muallaf;
use App\Note;
use Illuminate\Support\Facades\Auth;


class MuallafController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
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

    function welcome() {
        return view('alternate');
    }
}
