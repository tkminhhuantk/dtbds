<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Details;
use App\Http\Requests\AddProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Investors;
use App\ProjectDetail;
use App\ProjectUtiliti;
use App\Projects;
use App\Utilities;
use App\Comments;
use App\User;
use App\Tags;
use App\TagProject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;

class ProjectsController extends Controller
{
    public function getIndex(){
        $categories = Categories::where('category_id',0)->get();
        foreach($categories as $category)
        {
            $category->sub = Categories::where('category_id',$category->id)->get();
        }
        $projects = Projects::with('categories')->with('investors')->with('users')->orderBy('id','desc')->paginate(10);
        foreach ($projects as  $project) 
        {
            $url_images = json_decode($project->url_images);
            $project->url_avatar = $url_images[0];
            Carbon::setLocale('vi');
            $project->date = $project->created_at->diffForHumans(now());
        }
    	return view('backend.projects.index',[
            'projects'=> $projects,
            'categories' => $categories
        ]);
    }
    
    public function getAdd()
    {
    	$utilities = Utilities::select('id','title')->where('status',1)->orderBy('title','asc')->get();
    	$details = Details::select('id','title')->where('status',1)->get();
        $categories = Categories::where('category_id',0)->get();
        
        foreach($categories as $category)
        {
            $category->sub = Categories::where('category_id',$category->id)->get();
        }
        $tags = Tags::select('id', 'title')->orderBy('created_at', 'desc')->get();
    	return view('backend.projects.add',[
    		'utilities' => $utilities,
    		'details' => $details,
    		'tags' => $tags,
            'categories' => $categories
    	]);
    }
    public function postAdd(AddProjectRequest $request)
    {
        $project = new Projects;
        $project->title = $request->title;
        $project->slug = $request->slug;
        $project->meta_description = $request->meta_description;
        $project->meta_description = $request->meta_description;
        // if($request->has('meta_description')){
        //     $project->meta_description = $request->meta_description;
        // }else{
        //     $project->meta_description = $request->title . strip_tags($request->post('overview'));
        // }
        // dd($project->meta_description);
        $project->meta_keyword = $request->meta_keyword;
        $project->address = $request->address;
        $project->acreage = $request->acreage;
        $project->price = $request->price;
        $project->seo_head = $request->seo_head;
        $project->except = $request->except;
        $project->seo = $request->seo == 'true' ? true : false;
        $project->overview = $request->post('overview');
        $project->category_id = $request->category_id;
        $project->map = $request->map;
        $project->state = $request->state;
        $project->user_id = Auth::id();
        $project->status = $request->status == 'true' ? true : false;
        
        $urls = array();
        $check = $project->save();
        
        if($request->hasFile('url_images'))
        {
            $files = $request->file('url_images');
            foreach($files as $key => $file)
            {
                $urls[$key] = 'projects/' . $project->slug.'-'.$key.'.'.$file->getClientOriginalExtension();
                $file->move('projects', $project->slug.'-'.$key.'.'.$file->getClientOriginalExtension());
            }
            $project->update(['url_images' => json_encode($urls)]);
        }
        
        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $avatar = 'projects/'.$project->slug.'.'.$file->getClientOriginalExtension();
            $file->move('projects', $project->slug.'.'.$file->getClientOriginalExtension());
            $project->update(['avatar' => $avatar]);
        }
        
        if(isset($request->utilities)){
            foreach($request->utilities as $rq)
            {
                ProjectUtiliti::create([
                    'project_id' => $project->id,
                    'utiliti_id' => $rq
                ]);
            }
        }
        
        if(isset($request->detail_id)){
            foreach($request->detail_id as $key => $detail_id)
            {
                ProjectDetail::create([
                    'project_id' => $project->id,
                    'detail_id' => $detail_id,
                    'value' => $request->value[$key]
                ]);
            }
        }  
        
        if(isset($request->tags)){
            foreach ($request->tags as $tag) {
                $tagProject = new TagProject;
                $tagProject->tag_id = $tag;
                $tagProject->project_id = $project->id;
                $tagProject->save();
            }
        }

        return redirect()->route('AdminProjectsGetAdd')->with(['success'=>'Thêm thành công '.$request->title.'!']);
    }
    public function getDelete($id)
    {
        $project = Projects::findOrFail($id);
        $project->delete();
        $pro_uli = ProjectUtiliti::where('project_id',$project->id)->delete();
        $pro_det = ProjectDetail::where('project_id',$project->id)->delete();
        $tag_pro = TagProject::where('project_id', $project->id)->delete();
        return response()->json($project, 200);
    }
    public function getChangeStatus($id)
    {
        $project = Projects::findOrFail($id);
        $project->status == 1 ? $project->status = 0 : $project->status = 1;
        $project->save();
        return response()->json($project, 200);
    }
    public function getUpdate($id)
    {
        $project = Projects::findOrFail($id);
        $project->url_images = json_decode($project->url_images);
        $utilities = Utilities::select('id','title')->where('status',1)->orderBy('title','asc')->get();
        $project_utiliti = ProjectUtiliti::where('project_id', $id)->get();
        $details = Details::select('id','title')->where('status',1)->get();
        $investors = Investors::select('id','name')->where('status',1)->get();
        $categories = Categories::where('category_id',0)->get(); 
        foreach($categories as $category)
        {
            $category->sub = Categories::where('category_id',$category->id)->get();
        }
        $project_detail = ProjectDetail::with('details')->where('project_id', $project->id)->get();
        $tags = Tags::select('id', 'title')->orderBy('created_at', 'desc')->get();
        $tagProject = TagProject::select('tag_id')->where('project_id', $project->id)->get();
        return view('backend.projects.update', [
            'project' => $project,
            'utilities' => $utilities,
            'details' => $details,
            'investors' => $investors,
            'categories' => $categories,
            'project_utiliti' => $project_utiliti,
            'project_detail' => $project_detail,
            'tags' => $tags,
            'tagProject' => $tagProject
        ]);
    }
    public function postUpdate(UpdateProjectRequest $request, $id)
    {
        $project = Projects::findOrFail($id);
        $project->title = $request->title;
        $project->slug = $request->slug;
        $project->meta_description = $request->meta_description;
        $project->meta_keyword = $request->meta_keyword;
        $project->address = $request->address;
        $project->price = $request->price;
        $project->acreage = $request->acreage;
        $project->seo_head = $request->seo_head;
        $project->except = $request->except;
        $project->seo = $request->seo == 'true' ? true : false;
        if ($request->hasFile('avatar')) {
    		if (file_exists(public_path($project->avatar))) {
                File::delete(public_path($project->avatar));
            }
            $file = $request->avatar;
            $project->avatar = 'projects/'. $request->slug.'.'.$file->getClientOriginalExtension();
            $file->move('projects', $request->slug.'.'.$file->getClientOriginalExtension());
        }
        $project->overview = $request->post('overview');
        $project->investor_id = $request->investor_id;
        $project->category_id = $request->category_id;
        $project->map = $request->map;
        $project->state = $request->state;
        $project->status = $request->status == 'true' ? true : false;
        $project->save();
        $urls = array();
        if($request->hasFile('url_images'))
        {
            $files = $request->file('url_images');
            foreach($files as $key => $file)
            {
                $urls[$key] = 'projects/' . time().'-'.$key.'.'.$file->getClientOriginalExtension();
                $file->move('projects', time().'-'.$key.'.'.$file->getClientOriginalExtension());
            }
            $project->url_images = json_encode($urls);
        }

        $project->save();
        if(isset($request->utilities)){
            $pro_uli = ProjectUtiliti::where('project_id',$project->id)->delete();
            foreach($request->utilities as $rq)
            {
                ProjectUtiliti::create([
                    'project_id' => $project->id,
                    'utiliti_id' => $rq
                ]);
            }
        }
        
        if(isset($request->detail_id)){
            $pro_det = ProjectDetail::where('project_id',$project->id)->delete();
            foreach($request->detail_id as $key => $detail_id)
            {
                ProjectDetail::create([
                    'project_id' => $project->id,
                    'detail_id' => $detail_id,
                    'value' => $request->value[$key]
                ]);
            }
        } 
        $tagProject = TagProject::where('project_id', $project->id)->get();
            foreach ($tagProject as $tp) {
                $tp->delete();
            }
        if(isset($request->tags)){
            
            foreach ($request->tags as $tag) {
                $tagProject = new TagProject;
                $tagProject->tag_id = $tag;
                $tagProject->project_id = $project->id;
                $tagProject->save();
            }
        }
        return redirect()->back()->with(['success' => 'Cập nhật thành công']);
    }

    public function getCreateSlug(Request $request)
    {
        $slug = SlugService::createSlug(Projects::class, 'slug', $request->title);
        return response()->json($slug, 200);
    }
    
    public function postDeleteImage(Request $request)
    {
        $project = Projects::findOrFail($request->id);
        $images = json_decode($project->url_images);
        $images = array_merge(array_diff($images, array($request->image)));
        if (file_exists(public_path($request->image))) {
                File::delete(public_path($request->image));
            }
        $images = json_encode($images);
        $project->update(['url_images' => $images]);
        return response()->json($images, 200);
    }
    
    public function postStatusOn(Request $request)
    {   
        $project = Projects::findOrFail($request->id);
        $project->status = 1;
        $project->save();
        return response()->json($project, 200);
    }
    
    public function postStatusOff(Request $request)
    {   
        $project = Projects::findOrFail($request->id);
        $project->status = 0;
        $project->save();
        return response()->json($project, 200);
    }

    /*******************Editor******************/

    public function getIndexEditor(){
        $auth = Auth::user();
        $categories = Categories::where('category_id',0)->get();
        foreach($categories as $category)
        {
            $category->sub = Categories::where('category_id',$category->id)->get();
        }
        $projects = Projects::with('categories')->with('investors')->where('user_id', $auth->id)->orderBy('id','desc')->paginate(10);
        foreach ($projects as  $project) 
        {
            $url_images = json_decode($project->url_images);
            $project->url_avatar = $url_images[0];
            Carbon::setLocale('vi');
            $project->date = $project->created_at->diffForHumans(now());
        }
        return view('editor.projects.index',[
            'projects'=> $projects,
            'categories' => $categories
        ]);
    }
    public function getAddEditor()
    {
        $utilities = Utilities::select('id','title')->where('status',1)->orderBy('title','asc')->get();
    	$details = Details::select('id','title')->where('status',1)->get();
        $categories = Categories::where('category_id',0)->get();
        
        foreach($categories as $category)
        {
            $category->sub = Categories::where('category_id',$category->id)->get();
        }
        $tags = Tags::select('id', 'title')->orderBy('created_at', 'desc')->get();
    	return view('editor.projects.add',[
    		'utilities' => $utilities,
    		'details' => $details,
    		'tags' => $tags,
            'categories' => $categories
    	]);
    }
    public function getUpdateEditor($id)
    {
        $project = Projects::findOrFail($id);
        $project->url_images = json_decode($project->url_images);
        $utilities = Utilities::select('id','title')->where('status',1)->orderBy('title','asc')->get();
        $project_utiliti = ProjectUtiliti::where('project_id', $id)->get();
        $details = Details::select('id','title')->where('status',1)->get();
        $investors = Investors::select('id','name')->where('status',1)->get();
        $categories = Categories::where('category_id',0)->get(); 
        foreach($categories as $category)
        {
            $category->sub = Categories::where('category_id',$category->id)->get();
        }
        $project_detail = ProjectDetail::with('details')->where('project_id', $project->id)->get();
        $tags = Tags::select('id', 'title')->orderBy('created_at', 'desc')->get();
        $tagProject = TagProject::select('tag_id')->where('project_id', $project->id)->get();
        return view('editor.projects.update', [
            'project' => $project,
            'utilities' => $utilities,
            'details' => $details,
            'investors' => $investors,
            'categories' => $categories,
            'project_utiliti' => $project_utiliti,
            'project_detail' => $project_detail,
            'tags' => $tags,
            'tagProject' => $tagProject
        ]);
    }
    public function postAddEditor(AddProjectRequest $request)
    {
        $project = new Projects;
        $project->title = $request->title;
        $project->slug = $request->slug;
        $project->meta_description = $request->meta_description;
        $project->meta_keyword = $request->meta_keyword;
        $project->address = $request->address;
        $project->acreage = $request->acreage;
        $project->price = $request->price;
        $project->seo_head = $request->seo_head;
        $project->except = $request->except;
        $project->seo = $request->seo == 'true' ? true : false;
        $project->overview = $request->post('overview');
        $project->category_id = $request->category_id;
        $project->map = $request->map;
        $project->state = $request->state;
        $project->user_id = Auth::id();
        $project->status = false;
        
        $urls = array();
        $check = $project->save();
        
        if($request->hasFile('url_images'))
        {
            $files = $request->file('url_images');
            foreach($files as $key => $file)
            {
                $urls[$key] = 'projects/' . $project->slug.'-'.$key.'.'.$file->getClientOriginalExtension();
                $file->move('projects', $project->slug.'-'.$key.'.'.$file->getClientOriginalExtension());
            }
            $project->update(['url_images' => json_encode($urls)]);
        }
        
        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $avatar = 'projects/'.$project->slug.'.'.$file->getClientOriginalExtension();
            $file->move('projects', $project->slug.'.'.$file->getClientOriginalExtension());
            $project->update(['avatar' => $avatar]);
        }
        
        if(isset($request->utilities)){
            foreach($request->utilities as $rq)
            {
                ProjectUtiliti::create([
                    'project_id' => $project->id,
                    'utiliti_id' => $rq
                ]);
            }
        }
        
        if(isset($request->detail_id)){
            foreach($request->detail_id as $key => $detail_id)
            {
                ProjectDetail::create([
                    'project_id' => $project->id,
                    'detail_id' => $detail_id,
                    'value' => $request->value[$key]
                ]);
            }
        }  
        
        if(isset($request->tags)){
            foreach ($request->tags as $tag) {
                $tagProject = new TagProject;
                $tagProject->tag_id = $tag;
                $tagProject->project_id = $project->id;
                $tagProject->save();
            }
        }

        return redirect()->route('EditorProjectsGetAdd')->with(['success'=>'Thêm thành công '.$request->title.'!']);
    }
    public function postUpdateEditor(UpdateProjectRequest $request, $id)
    {
        $project = Projects::findOrFail($id);
        $project->title = $request->title;
        $project->slug = $request->slug;
        $project->meta_description = $request->meta_description;
        $project->meta_keyword = $request->meta_keyword;
        $project->address = $request->address;
        $project->price = $request->price;
        $project->acreage = $request->acreage;
        $project->seo_head = $request->seo_head;
        $project->except = $request->except;
        $project->seo = $request->seo == 'true' ? true : false;
        if ($request->hasFile('avatar')) {
    		if (file_exists(public_path($project->avatar))) {
                File::delete(public_path($project->avatar));
            }
            $file = $request->avatar;
            $project->avatar = 'projects/'. $request->slug.'.'.$file->getClientOriginalExtension();
            $file->move('projects', $request->slug.'.'.$file->getClientOriginalExtension());
        }
        $project->overview = $request->post('overview');
        $project->investor_id = $request->investor_id;
        $project->category_id = $request->category_id;
        $project->map = $request->map;
        $project->state = $request->state;
        $project->status = false;
        $project->save();
        $urls = array();
        if($request->hasFile('url_images'))
        {
            $files = $request->file('url_images');
            foreach($files as $key => $file)
            {
                $urls[$key] = 'projects/' . time().'-'.$key.'.'.$file->getClientOriginalExtension();
                $file->move('projects', time().'-'.$key.'.'.$file->getClientOriginalExtension());
            }
            $project->url_images = json_encode($urls);
        }

        $project->save();
        if(isset($request->utilities)){
            $pro_uli = ProjectUtiliti::where('project_id',$project->id)->delete();
            foreach($request->utilities as $rq)
            {
                ProjectUtiliti::create([
                    'project_id' => $project->id,
                    'utiliti_id' => $rq
                ]);
            }
        }
        
        if(isset($request->detail_id)){
            $pro_det = ProjectDetail::where('project_id',$project->id)->delete();
            foreach($request->detail_id as $key => $detail_id)
            {
                ProjectDetail::create([
                    'project_id' => $project->id,
                    'detail_id' => $detail_id,
                    'value' => $request->value[$key]
                ]);
            }
        } 
        $tagProject = TagProject::where('project_id', $project->id)->get();
            foreach ($tagProject as $tp) {
                $tp->delete();
            }
        if(isset($request->tags)){
            
            foreach ($request->tags as $tag) {
                $tagProject = new TagProject;
                $tagProject->tag_id = $tag;
                $tagProject->project_id = $project->id;
                $tagProject->save();
            }
        }
        return redirect()->back()->with(['success' => 'Cập nhật thành công']);
    }
    public function getReview($slugCat, $slugPro){
        $projects_seo = Projects::with('categories')->where('status',1)->where('seo',1)->orderBy('id','desc')->limit(15)->get();
        foreach ($projects_seo as $project) {
            $url_images = json_decode($project->url_images);
            $project->url_avatar = $url_images[0];
        }
    	$category = Categories::where('slug',$slugCat)->firstOrFail();
    	if($category->category_id != 0){
            $category_parent = Categories::where('id', $category->category_id)->firstOrFail();
        }else{
            $category_parent = null;
        }
    	$project = Projects::with('categories')
    		->where('category_id',$category->id)
    		->where('slug',$slugPro)
    		->firstOrFail();
    	$project->update(['review'=> 1]);
        $project->view = $project->view + 1;
        Projects::with('statesProject')->where('id',$project->id)->update(['view' => $project->view]);
    	$url_images = json_decode($project->url_images);
        if(count($url_images)>0){
            $project->url_avatar = $url_images[0];
            $project->url_images = $url_images;
        }else{
            $project->url_avatar = null;
            $project->url_images = [];
        }
        $utilities = ProjectUtiliti::with('utilities')->where('project_id',$project->id)->get();
        $details = ProjectDetail::with('details')->where('project_id',$project->id)->get();
        $categories = Categories::where('category_id',0)->where('status',1)->get();
        foreach($categories as $category)
        {
            $category->sub = Categories::where('category_id',$category->id)->get();
        }
        $comments = Comments::where('type',1)->where('post_id',$project->id)->where('status',1)->orderBy('id','desc')->get();
        Carbon::setLocale('vi');
        foreach($comments as $comment){
            $comment->date = $comment->created_at->diffForHumans(now());
            $comment->reply = Comments::where('comment_id', $comment->id)->where('status',1)->orderBy('created_at', 'asc')->get();
            foreach($comment->reply as $reply) $reply->date = $reply->created_at->diffForHumans(now());
        }
        $user = User::where('id', $project->user_id)->firstOrFail();  
        $category = Categories::where('slug',$slugCat)->firstOrFail();
        $cat_parent = Categories::where('id', $project->categories->category_id)->first();
        $tags = TagProject::with('tags')->where('project_id',$project->id)->get();
        $project_relate = Projects::with('categories')
            ->where('category_id',$category->id)
            ->where('id','<>',$project->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        foreach ($project_relate as $p) {
            $url_images = json_decode($p->url_images);
            if(count($url_images)>0){
                $p->url_avatar = $url_images[0];
            }else{
                $p->url_avatar = null;
            }
        }
        return view('frontend.singleProject',[
            'project' => $project,
            'category' => $category,
            'utilities' => $utilities,
            'projects_seo' => $projects_seo,
            'details' => $details,
            'categories' => $categories,
            'comments' => $comments,
            'user' => $user,
            'category_parent' => $category_parent,
            'tags' => $tags,
            'cat_parent'=> $cat_parent,
            'project_relate' => $project_relate
        ]);
    }
    
    public function getCreateSlugEditor(Request $request)
    {
        $slug = SlugService::createSlug(Projects::class, 'slug', $request->title);
        return response()->json($slug, 200);
    }
}
