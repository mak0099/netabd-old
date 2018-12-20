<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Announcement;
use Auth;

class AnnouncementController extends Controller {

    public function listAnnouncement() {
        if (Auth::user()->in_main_unit()) {
            $view = view('announcement/list_announcement_main');
            $announcements = Announcement::where('deletation_status', FALSE)->orderBy('id', 'desc')->get();
        } else {
            $view = view('announcement/list_announcement_sub');
            $announcements = Announcement::where('deletation_status', FALSE)->where('publication_status', true)->orderBy('id', 'desc')->paginate(5);
        }
        $view->with('announcements', $announcements);
        return $view;
    }

    public function addAnnouncement() {
        $view = view('announcement/add_announcement');
        return $view;
    }

    public function saveAnnouncement(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        $announcement = new Announcement;
        $announcement->fill($request->input());
        $announcement->created_by = Auth::id();
        $announcement->save();
        $announcement->set_notification();
        Session::put('alert-success', 'New item has saved!');
        return redirect()->route('list_announcement');
    }

    public function viewAnnouncement($id) {
        $announcement = Announcement::find($id);
        if ($announcement) {
            $view = view('announcement/view_announcement');
            $view->with('announcement', $announcement);
            $announcement->seen_notification();
            return $view;
        } else {
            abort('404');
        }
    }

    public function editAnnouncement($id) {
        $announcement = Announcement::find($id);
        if ($announcement) {
            $view = view('announcement/edit_announcement');
            $view->with('announcement', $announcement);
            return $view;
        } else {
            abort('404');
        }
    }

    public function updateAnnouncement(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        $announcement = Announcement::find($id);
        $announcement->fill($request->all());
        $announcement->updated_by = Auth::id();
        $announcement->update();
        Session::put('alert-success', 'item has updated!');
        return redirect()->route('list_announcement');
    }

    public function unpublishAnnouncement($id) {
        $announcement = Announcement::find($id);
        $announcement->publication_status = false;
        $announcement->update();
        $announcement->remove_notification();
        return redirect()->back();
    }

    public function publishAnnouncement($id) {
        $announcement = Announcement::find($id);
        $announcement->publication_status = true;
        $announcement->update();
        $announcement->set_notification();
        return redirect()->back();
    }

    public function deleteAnnouncement($id) {
        $announcement = Announcement::find($id);
        $announcement->deletation_status = TRUE;
        $announcement->update();
        $announcement->remove_notification();
        Session::put('alert-success', 'Item has deleted!');
        return redirect()->back();
    }

}
