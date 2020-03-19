<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNewRequest;
use App\Http\Requests\UpdateNewRequest;
use App\News;
use App\Tags;
use App\Projects;
use App\Categories;
use App\Investors;
use App\Links;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;
use App\TagNew;
use Cviebrock\EloquentSluggable\Services\SlugService;

class NewsController extends Controller
{
    public function getIndex()
    {
        $news = News::with('users')->orderBy('created_at', 'desc')->paginate(10);
        Carbon::setLocale('vi');
        foreach ($news as $key => $new) {
            $new->date = $new->created_at->diffForHumans(now());
        }
    	return view('backend.news.index', ['news' => $news]);
    }
    public function getIndexEditor()
    {
        $news = News::where('user_id',Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        Carbon::setLocale('vi');
        foreach ($news as $key => $new) {
            $new->date = $new->created_at->diffForHumans(now());
        }
        return view('editor.news.index', ['news' => $news]);
    }
    public function getAdd(){
        $tags = Tags::select('id', 'title')->orderBy('created_at', 'desc')->get();
    	return view('backend.news.add', compact('tags'));
    }
    public function getAddEditor(){
        $tags = Tags::select('id', 'title')->orderBy('created_at', 'desc')->get();
        return view('editor.news.add',compact('tags'));
    }
    public function postAdd(AddNewRequest $request)
    {
    	$new = new News;
    	$new->title = $request->title;
    	$new->slug = $request->slug;
    	$new->meta_description = $request->meta_description;
    	$new->meta_keyword = $request->meta_keyword;
    	if ($request->hasFile('link_avatar')) {
            $file = $request->link_avatar;
            $new->link_avatar = 'imgNews/'.time().'.'.$file->getClientOriginalExtension();
            $file->move('imgNews', time().'.'.$file->getClientOriginalExtension());
        }
    	$new->seo_head = $request->seo_head;
    	$new->except = $request->except;
    	$new->content = $request->post('content');
    	$new->status = $request->status == 'true' ? true : false ;
        $new->user_id = Auth::id();
        $new->save();
    	if(isset($request->tags)){
            foreach ($request->tags as $tag) {
                $tagNew = new TagNew;
                $tagNew->tag_id = $tag;
                $tagNew->new_id = $new->id;
                $tagNew->save();
            }
        }
    	return response()->json($request,200);
    }
    public function getUpdate($id)
    {
    	$new = News::findOrFail($id);
        $tags = Tags::select('id', 'title')->orderBy('created_at', 'desc')->get();
        $tagNew = TagNew::select('tag_id')->where('new_id', $new->id)->get();
    	return view('backend.news.update',compact('new', 'tags', 'tagNew'));
    }
    public function getUpdateEditor($id)
    {
        $new = News::findOrFail($id);
        $tags = Tags::select('id', 'title')->orderBy('created_at', 'desc')->get();
        $tagNew = TagNew::select('tag_id')->where('new_id', $new->id)->get();
        return view('editor.news.update',['new'=>$new, 'tags' => $tags, 'tagNew'=> $tagNew]);
    }
    public function postUpdate(UpdateNewRequest $request, $id)
    {
    	$new = News::findOrFail($id);
    	$new->title = $request->title;
    	$new->slug = $request->slug;
    	$new->meta_description = $request->meta_description;
    	$new->meta_keyword = $request->meta_keyword;
    	if ($request->hasFile('link_avatar')) {
    		if (file_exists(public_path($new->link_avatar))) {
                File::delete(public_path($new->link_avatar));
            }
            $file = $request->link_avatar;
            $new->link_avatar = 'imgNews/'.time().'.'.$file->getClientOriginalExtension();
            $file->move('imgNews', time().'.'.$file->getClientOriginalExtension());
        }
    	$new->seo_head = $request->seo_head;
    	$new->except = $request->except;
    	$new->content = $request->post('content');
    	$new->status = $request->status == 'true' ? true : false ;
    	$new->save();
    	$tagNew = TagNew::where('new_id', $new->id)->get();
            foreach ($tagNew as $tn) {
                $tn->delete();
            }
    	if(isset($request->tags)){
            
            foreach ($request->tags as $tag) {
                $tagNew = new TagNew;
                $tagNew->tag_id = $tag;
                $tagNew->new_id = $new->id;
                $tagNew->save();
            }
        }
    	return response()->json($new,200);
    }
    public function anyData()
    {
    	$news = News::orderBy('created_at', 'desc')->get();
    	Carbon::setLocale('vi');
    	return Datatables::of($news)
    		->addColumn('avatar', function ($news) {
                return '<img src="' . url($news->link_avatar) . '" class="img-new-review" />';
            })
            ->addColumn('time', function($news){
                return $news->created_at->diffForHumans(now());
            })
            ->addColumn('url_status', function($news){
            	return route('AdminNewsStatus', $news->id);
            })
            ->addColumn('url_update', function($news){
            	return route('AdminNewsGetUpdate',$news->id);
            })
            ->addColumn('url_delete', function($news){
            	return route('AdminNewsGetDelete',$news->id);
            })
    		->make(true);
    }
    public function anyDataEditor()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        Carbon::setLocale('vi');
        return Datatables::of($news)
            ->addColumn('avatar', function ($news) {
                return '<img src="' . url($news->link_avatar) . '" class="img-new-review" />';
            })
            ->addColumn('time', function($news){
                return $news->created_at->diffForHumans(now());
            })
            ->addColumn('url_update', function($news){
                return route('EditorNewsGetUpdate',$news->id);
            })
            ->make(true);
    }
    public function getDelete($id)
    {
    	$new = News::findOrFail($id);
    	$new->delete();
    	return response()->json($new,200);
    }
    public function changeStatus($id)
    {
        $new = News::findOrFail($id);
        $new->status == 1 ? $new->status = 0 : $new->status = 1;
        $new->save();
        return response()->json($new, 200);
    }
    public function getCreateSlug(Request $request)
    {
        $slug = SlugService::createSlug(News::class, 'slug', $request->title);
        return response()->json($slug, 200);
    }

    /*****************Editor********************/
    public function postAddEditor(AddNewRequest $request)
    {
        $new = new News;
        $new->title = $request->title;
        $new->slug = $request->slug;
        $new->meta_description = $request->meta_description;
        $new->meta_keyword = $request->meta_keyword;
        if ($request->hasFile('link_avatar')) {
            $file = $request->link_avatar;
            $new->link_avatar = 'imgNews/'.time().'.'.$file->getClientOriginalExtension();
            $file->move('imgNews', time().'.'.$file->getClientOriginalExtension());
        }
        $new->seo_head = $request->seo_head;
        $new->except = $request->except;
        $new->content = $request->post('content');
        $new->status = $request->status == 'true' ? true : false ;
        $new->user_id = Auth::id();
        $new->save();
        if(isset($request->tags)){
            foreach ($request->tags as $tag) {
                $tagNew = new TagNew;
                $tagNew->tag_id = $tag;
                $tagNew->new_id = $new->id;
                $tagNew->save();
            }
        }
        return response()->json($new,200);
    }
    public function postUpdateEditor(UpdateNewRequest $request, $id)
    {
        $new = News::findOrFail($id);
        $new->title = $request->title;
        $new->slug = $request->slug;
        $new->meta_description = $request->meta_description;
        $new->meta_keyword = $request->meta_keyword;
        if ($request->hasFile('link_avatar')) {
            if (file_exists(public_path($new->link_avatar))) {
                File::delete(public_path($new->link_avatar));
            }
            $file = $request->link_avatar;
            $new->link_avatar = 'imgNews/'.time().'.'.$file->getClientOriginalExtension();
            $file->move('imgNews', time().'.'.$file->getClientOriginalExtension());
        }
        $new->seo_head = $request->seo_head;
        $new->except = $request->except;
        $new->content = $request->post('content');
        $new->status = false ;
        $new->save();
        $tagNew = TagNew::where('new_id', $new->id)->get();
            foreach ($tagNew as $tn) {
                $tn->delete();
            }
        if(isset($request->tags)){
            
            foreach ($request->tags as $tag) {
                $tagNew = new TagNew;
                $tagNew->tag_id = $tag;
                $tagNew->new_id = $new->id;
                $tagNew->save();
            }
        }
    }
    
    public function getReview($slug){
        $projects_seo = Projects::with('categories')->where('status',1)->where('seo',1)->orderBy('id','desc')->limit(15)->get();
        foreach ($projects_seo as $project) {
            $url_images = json_decode($project->url_images);
            $project->url_avatar = $url_images[0];
        }
        $new = News::where('slug',$slug)->firstOrFail();
        $new->view = $new->view + 1;
        $new->save();
        $relateds = News::where('id','<>',$new->id)
            ->where('status',1)
            ->orderBy('created_at','desc')
            ->limit(3)
            ->get();
        $categories = Categories::where('category_id',0)->where('status',1)->get();
        $projects = Projects::with('categories')->where('status',1)->orderBy('id','desc')->limit(5)->get();
        foreach ($projects as $project) {
            $url_images = json_decode($project->url_images);
            if(count($url_images)>0){
                $project->url_avatar = $url_images[0];
            }else{
                $project->url_avatar = null;
            }
        }
        foreach($categories as $category)
        {
            $category->sub = Categories::where('category_id',$category->id)->get();
        }
        $investors = Investors::where('status', 1)->get();
        $links = Links::where('status', 1)->get();
        $tags = TagNew::with('tags')->where('new_id',$new->id)->get();
        return view('frontend.reviewNew',[
            'new' => $new,
            'relateds' => $relateds,
            'projects_seo' => $projects_seo,
            'categories' => $categories,
            'projects' => $projects,
            'investors' => $investors,
            'links' => $links,
            'tags' => $tags
        ]);
    }
    public function getCreateSlugEditor(Request $request)
    {
        $slug = SlugService::createSlug(News::class, 'slug', $request->title);
        return response()->json($slug, 200);
    }
}
