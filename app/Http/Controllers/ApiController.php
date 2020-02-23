<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Event;
use Response;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function getAllEvents()
    {
        // logic to get all Events
        $events = Event::get();
        return Response::json([
            'status_code' => '200',
            'data' => $events
        ], 200);
    }

    public function createBooking(Request $request)
    {
        // logic to get create a booking
        if (Event::where('id', $request->events_id)->exists()) {
            $event = Event::where('id', $request->events_id)->first();
            $available_tickets = $event->available_tickets;
            if ($available_tickets >= $request->ticket_quantity) {
                $user = Auth::user();
                $booking = new Booking;
                $booking->users_id = $user->id;
                $booking->events_id = $request->events_id;
                $booking->delivery_address = $request->delivery_address;
                $booking->ticket_quantity = $request->ticket_quantity;
                $booking->save();
                // Update tickets availability
                $event->available_tickets = $event->available_tickets - $request->ticket_quantity;
                $event->save();

                return Response::json([
              'status_code' => '200',
              'message' => 'Success, booking has been made!'
          ], 200);
            } elseif ($available_tickets > 0) {
                return Response::json([
              'status_code' => '400',
              'message' => 'Only ' . $available_tickets . ' tickets available to book'
          ], 400);
            } else {
                return Response::json([
            'status_code' => '400',
            'message' => 'Tickets out of stock'
        ], 400);
            }
        } else {
            return Response::json([
              'status_code' => '400',
              'message' => 'Event not found'
          ], 400);
        }
    }

    public function getAllBooking()
    {
        $user = Auth::user();
        // logic to get all Bookings
        $booking = Booking::where('users_id', $user->id)->get();
        if ($booking->isNotEmpty()) {
            return Response::json([
            'status_code' => '200',
            'data' => $booking
        ], 200);
        } else {
            return Response::json([
          'status_code' => '200',
          'message' => 'You have not made any bookings yet'
      ], 200);
        }
    }
  
    public function updateBooking(Request $request, $id)
    {
        $user = Auth::user();
        // logic to update a booking
        if (Booking::where([['id', '=', $id], ['users_id', '=', $user->id]])->exists()) {
            $booking = Booking::find($id);
            $booking->delivery_address = is_null($request->delivery_address) ? $booking->delivery_address : $request->delivery_address;
            $booking->save();
            return Response::json([
              'status_code' => '200',
              'message' => 'Booking updated successfully'
            ], 200);
        } else {
            return Response::json([
              'status_code' => '400',
                'message' => 'Booking not found'
            ], 400);
        }
    }
  
    public function deleteBooking($id)
    {
        $user = Auth::user();
        // logic to delete a Booking
        if (Booking::where([['id', '=', $id], ['users_id', '=', $user->id]])->exists()) {
            $booking = Booking::find($id);
            $booking->delete();
    
            return Response::json([
              'status_code' => '200',
              'message' => 'Success, booking deleted'
            ], 200);
        } else {
            return Response::json([
              'status_code' => '400',
              'message' => 'Booking not found'
            ], 400);
        }
    }
}
