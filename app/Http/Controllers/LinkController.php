<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\SubjectType;
use App\Repositories\LinkRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkController extends Controller
{

    protected $repository;

    public function __construct(LinkRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $subject_types = SubjectType::all();
        $subject_links = Link::all();
        return view('layout_admin.link.index', compact('subject_types', 'subject_links'));
    }

    public function linkSubjectIndex($link)
    {
        $subject = Link::where('link_subject', $link)->first();
        return view('layout_index.page.subject', compact('subject'));
    }

    public function store(Request $request)
    {
        $subject = new Link();
        if($request->subject_type == 'Thẻ'){
            $subject_json = explode('  ', preg_replace("/\r|\n/", " ", $request->subject));
            $subject->type_subject = $request->subject_type;
            $subject->link_subject = Str::random(40);
            $subject->subject = json_encode($subject_json);
            $subject->save();
        }
        else
        {
            $subject->type_subject = $request->subject_type;
            $subject->link_subject = Str::random(40);
            $subject->subject = $request->subject;
            $subject->save();
        }
        return redirect()->back()->with('information', 'Thêm mới thành công!');
        
    }

    public function destroy(Request $request)
    {
        if($request->ajax()){
            $link_delete = Link::find($request->id);
            $link_delete->delete();
            return response()->json([
                'success' => true,
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
            ]);
        }
    }
}
