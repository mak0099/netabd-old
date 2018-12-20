<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Message;
use App\Unit;
use Auth;

class MessageController extends Controller {

    public function composeMessage() {
        $view = view('message/compose_message');
        $units = Unit::where('deletation_status', false)->where('id', '!=', Auth::user()->unit_id())->get();
        $view->with('units', $units);
        return $view;
    }

    public function sendMessage(Request $request) {
        $this->validate($request, [
            'to' => 'required',
            'subject' => 'required',
            'attach_file' => 'max:5000',
        ]);
        $message = new Message;
        $message->fill($request->input());
        if (Input::hasFile('attach_file')) {
            $file = Input::file('attach_file');
            $file_name = time() . $file->getClientOriginalName();
            $file_directory = 'uploads/';
            $file->move('uploads', $file_directory . $file_name);
            $message->file_name = $file_name;
            $message->file_directory = $file_directory;
        }
        $message->from = Auth::user()->unit_id();
        $message->created_by = Auth::id();
        $message->save();
        Session::put('alert-success', 'Message Sent!');
        return redirect()->route('inbox_message');
    }

    public function inboxMessage() {
        $view = view('message/inbox_message');
        $messages = Message::where('deletation_status', FALSE)
                ->where('publication_status', true)
                ->where('to', Auth::user()->unit_id())
                ->orderBy('id', 'desc')
                ->paginate(25);
        $view->with('messages', $messages);
        return $view;
    }

    public function viewInbox($id) {
        $message = Message::find($id);
        if ($message) {
            $view = view('message/view_inbox');
            $view->with('message', $message);
            if (!$message->seen_by) {
                $message->seen_by = Auth::id();
                $message->update();
            }
            return $view;
        } else {
            abort('404');
        }
    }

    public function sentMessage() {
        $view = view('message/sent_message');
        $messages = Message::where('deletation_status', FALSE)
                ->where('publication_status', true)
                ->where('from', Auth::user()->unit_id())
                ->orderBy('id', 'desc')
                ->paginate(25);
        $view->with('messages', $messages);
        return $view;
    }

    public function viewSent($id) {
        $message = Message::find($id);
        if ($message) {
            $view = view('message/view_sent');
            $view->with('message', $message);
            return $view;
        } else {
            abort('404');
        }
    }

    public function editMessage($id) {
        $message = Message::find($id);
        if ($message) {
//            $units = Unit::where('deletation_message', false)->get();
            $view = view('message/edit_message');
            $view->with('message', $message);
//            $view->with('units', $units);
            return $view;
        } else {
            abort('404');
        }
    }

    public function updateMessage(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        $message = Message::find($id);
        $message->fill($request->all());
        $message->updated_by = Auth::id();
        $message->update();
        Session::put('alert-success', 'item has updated!');
        return redirect()->route('list_message');
    }

    public function unpublishMessage($id) {
        $message = Message::find($id);
        $message->publication_message = false;
        $message->update();
        return redirect()->back();
    }

    public function publishMessage($id) {
        $message = Message::find($id);
        $message->publication_message = true;
        $message->update();
        return redirect()->back();
    }

    public function deleteMessage($id) {
        $message = Message::find($id);
        $message->deletation_message = TRUE;
        $message->update();
        Session::put('alert-success', 'Item has deleted!');
        return redirect()->back();
    }

}
