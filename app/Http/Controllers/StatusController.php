<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Status;
use Auth;

class StatusController extends Controller {

    public function listStatus() {
        if (Auth::user()->in_sub_unit()) {
            $view = view('status/list_status_sub');
            $statuses = Status::where('deletation_status', FALSE)->orderBy('id', 'desc')->get();
        } else {
            $view = view('status/list_status_main');
            $statuses = Status::where('deletation_status', FALSE)->where('publication_status', true)->orderBy('id', 'desc')->paginate(5);
        }
        $view->with('statuses', $statuses);
        return $view;
    }

    public function addStatus() {
        $view = view('status/add_status');
        return $view;
    }

    public function saveStatus(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        $status = new Status;
        $status->fill($request->input());
        $status->unit_id = Auth::user()->unit_id();
        $status->created_by = Auth::id();
        $status->save();
        $status->set_notification();
        Session::put('alert-success', 'New item has saved!');
        return redirect()->route('list_status');
    }

    public function viewStatus($id) {
        $status = Status::find($id);
        if ($status) {
            $view = view('status/view_status');
            $view->with('status', $status);
            $status->seen_notification();
            return $view;
        } else {
            abort('404');
        }
    }

    public function editStatus($id) {
        $status = Status::find($id);
        if ($status) {
            $view = view('status/edit_status');
            $view->with('status', $status);
            return $view;
        } else {
            abort('404');
        }
    }

    public function updateStatus(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        $status = Status::find($id);
        $status->fill($request->all());
        $status->updated_by = Auth::id();
        $status->update();
        Session::put('alert-success', 'item has updated!');
        return redirect()->route('list_status');
    }

    public function unpublishStatus($id) {
        $status = Status::find($id);
        $status->publication_status = false;
        $status->update();
        $status->remove_notification();
        return redirect()->back();
    }

    public function publishStatus($id) {
        $status = Status::find($id);
        $status->publication_status = true;
        $status->update();
        $status->set_notification();
        return redirect()->back();
    }

    public function deleteStatus($id) {
        $status = Status::find($id);
        $status->deletation_status = TRUE;
        $status->update();
        $status->remove_notification();
        Session::put('alert-success', 'Item has deleted!');
        return redirect()->back();
    }

}
