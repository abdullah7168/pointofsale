<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Reservation;
use DateTime;
use App\Table;
use Illuminate\Support\Facades\Redirect;

class ReservationController extends Controller
{
    public function index(){

        $events = Reservation::OrderBy('start_time')->get();
        return view('backend.pages.reservations.index',[ 'events' => $events]);
    }
    public function createReservation(){
        return view('backend.pages.reservations.reserve');
    }

    public function returnEvents(){
      
        $events = DB::table('reservations')->select('id','title','phone','email','comment','start_time as start','end_time as end','table_id as resourceId')->get();
        foreach($events as $event)
            {
                $event->title = $event->title . ' - ' .$event->phone ."\r\n". $event->email. "\r\n" . $event->comment ;
                $event->url = url('events/' . $event->id);
            }
        return $events;

    }

    public function returnTables(){

        //resources = tables
        $resources = DB::table('tables')->select('id', 'tablenumber as title')->get();
        return $resources;

    }

    public function show($id){

		$booking = Reservation::findOrFail($id);
        $tablenumber = DB::table('tables')->select('tablenumber')->where('id','=',$booking->table_id)->first();
		return view('backend.pages.reservations.show', compact('booking','tablenumber'));
    }

    public function storeReservation(Request $request){
    
        $reservation  = new Reservation;
        $reservation->title = $request->_name;
        $reservation->phone = $request->_phone;
        $reservation->email = $request->_email;
        $reservation->comment = $request->_comment;
        $reservation->start_time = $request->__from;
        $reservation->end_time = $request->__to;
        $reservation->table_id = $request->_table;
        $reservation->save();

        return redirect()->to('/reservations')->with('message','Table successfully reserved');

    }

}
