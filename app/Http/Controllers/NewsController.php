<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\News;
use Auth;

class NewsController extends Controller {

    public function listNews() {
        $view = view('news/list_news');
        $newses = News::where('deletation_status', FALSE)->where('publication_status', true)->orderBy('id', 'desc')->paginate(5);
        $view->with('newses', $newses);
        return $view;
    }

    public function saveNews(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'attach_file' => 'max:500',
        ]);
        $news = new News;
        $news->fill($request->input());
        if (Input::hasFile('attach_file')) {
            $file = Input::file('attach_file');
            $file_name = time() . $file->getClientOriginalName();
            $file_directory = 'public/images/news/';
            $file->move($file_directory, $file_directory . $file_name);
            $news->file_name = $file_name;
            $news->file_directory = $file_directory;
        }
        $news->unit_id = Auth::user()->unit_id();
        $news->created_by = Auth::id();
        $news->save();
        Session::put('alert-success', 'New item has saved!');
        return redirect()->route('list_news');
    }

    public function viewNews($id) {
        $news = News::find($id);
        if ($news) {
            $view = view('news/view_news');
            $view->with('news', $news);
            return $view;
        } else {
            abort('404');
        }
    }

    public function editNews($id) {
        $news = News::find($id);
        if ($news) {
            $view = view('news/edit_news');
            $view->with('news', $news);
            return $view;
        } else {
            abort('404');
        }
    }

    public function updateNews(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        $news = News::find($id);
        $news->fill($request->all());
        $news->updated_by = Auth::id();
        $news->update();
        Session::put('alert-success', 'item has updated!');
        return redirect()->route('list_news');
    }

    public function unpublishNews($id) {
        $news = News::find($id);
        $news->publication_status = false;
        $news->update();
        $news->remove_notification();
        return redirect()->back();
    }

    public function publishNews($id) {
        $news = News::find($id);
        $news->publication_status = true;
        $news->update();
        return redirect()->back();
    }

    public function deleteNews($id) {
        $news = News::find($id);
        $news->deletation_status = TRUE;
        $news->update();
        Session::put('alert-success', 'Item has deleted!');
        return redirect()->back();
    }

}
