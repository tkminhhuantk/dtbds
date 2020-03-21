<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Comments;
use App\Investors;
use App\Links;
use App\News;
use App\ProjectDetail;
use App\ProjectUtiliti;
use App\Projects;
use App\Sliders;
use App\TagNew;
use App\TagProject;
use App\Tags;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends Controller
{
    public function getIndex()
    {
        $categories = Categories::where('category_id',0)->where('status',1)->get();
        foreach($categories as $category)
        {
            $category->sub = Categories::where('category_id',$category->id)->get();
        }
        $sliders = Sliders::select('url_slider')->get();
        $projects = Projects::with('categories')->where('status',1)->orderBy('created_at','desc')->limit(9)->get();
        foreach ($projects as $project) {
            $url_images = json_decode($project->url_images);
            $project->url_avatar = $url_images[0];
        }
        $news = News::where('status', 1)->orderBy('created_at', 'desc')->limit(8)->get();
    	return view('client.index.index',[
            'categories'    => $categories,
            'sliders'       => $sliders,
            'projects'      => $projects,
            'news'          => $news
        ]);
    }
    public function getContact(){
    	return view('client.contact.index');
    }
    public function getNews(){
    	$news = News::with('users')->where('status',1)->orderBy('created_at','desc')->paginate(10);
        $projects = Projects::with('categories')->where('status',1)->orderBy('created_at','desc')->limit(5)->get();
        foreach ($projects as $project) {
            $url_images = json_decode($project->url_images);
            if(count($url_images)>0){
                $project->url_avatar = $url_images[0];
            }else{
                $project->url_avatar = null;
            }
        }
        $links = Links::where('status', 1)->get();
        $investors = Investors::where('status', 1)->get();
    	return view('frontend.news',[
    		'news' => $news,
            'projects' => $projects,
            'links' => $links,
            'investors' => $investors
    	]);
    }
    public function getSingleNews($slug){
    	$new = News::where('slug',$slug)->firstOrFail();
    	if($new->status == 0){
    	    return redirect()->route('Home');
    	}
        $new->view = $new->view + 1;
        $new->save();
    	$relateds = News::where('id','<>',$new->id)
    		->where('status',1)
    		->orderBy('created_at','desc')
    		->limit(3)
    		->get();
        $projects = Projects::with('categories')->where('status',1)->orderBy('id','desc')->limit(5)->get();
        $investors = Investors::where('status', 1)->get();
        $links = Links::where('status', 1)->get();
        $tags = TagNew::with('tags')->where('new_id',$new->id)->get();
    	return view('frontend.singleNews',[
    		'new' => $new,
    		'relateds' => $relateds,
            'projects' => $projects,
            'investors' => $investors,
            'links' => $links,
            'tags' => $tags
    	]);
    }
    public function getInvestors(){
        $projects_seo = Projects::with('categories')->where('status',1)->where('seo',1)->orderBy('id','desc')->limit(15)->get();
        foreach ($projects_seo as $project) {
            $url_images = json_decode($project->url_images);
            $project->url_avatar = $url_images[0];
        }
    	$investors = Investors::where('status',1)->orderBy('created_at','desc')->paginate(10);
        $categories = Categories::where('category_id',0)->where('status',1)->get();
        foreach($categories as $category)
        {
            $category->sub = Categories::where('category_id',$category->id)->get();
        }
        $projects = Projects::with('categories')->where('status',1)->orderBy('created_at','desc')->limit(5)->get();
        foreach ($projects as $project) {
            $url_images = json_decode($project->url_images);
            if(count($url_images)>0){
                $project->url_avatar = $url_images[0];
            }else{
                $project->url_avatar = null;
            }
        }
        $news = News::where('status', 1)->orderBy('id', 'desc')->limit(5)->get();
        $links = Links::where('status', 1)->get();
    	return view('frontend.investors',[
    		'investors' => $investors,
            'projects_seo' => $projects_seo,
            'categories' => $categories,
            'projects' => $projects,
            'news' => $news,
            'links' => $links
    	]);
    }
    public function getProject($slugCat, $slugPro){
        try{
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
        	if($project->status == 0){
        	    return redirect()->route('Home');
        	}
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
            return view('frontend.singleProject',[
        		'project' => $project,
        		'category' => $category,
        		'utilities' => $utilities,
                'details' => $details,
                'categories' => $categories,
                'comments' => $comments,
                'user' => $user,
                'category_parent' => $category_parent,
                'tags' => $tags,
                'cat_parent'=> $cat_parent,
                'project_relate' => $project_relate
        	]);
        }catch(ModelNotFoundException $err){
            return redirect()->route('Home'); 
        }
    }
    public function getCategories($slugCat){
        try{
            $projects_seo = Projects::with('categories')->where('status',1)->where('seo',1)->orderBy('id','desc')->limit(15)->get();
            foreach ($projects_seo as $project) {
                $url_images = json_decode($project->url_images);
                $project->url_avatar = $url_images[0];
            }
            $categories = Categories::where('category_id',0)->where('status',1)->get();
            foreach($categories as $category)
            {
                $category->sub = Categories::where('category_id',$category->id)->get();
            }
            $category = Categories::where('slug',$slugCat)->where('status',1)->firstOrFail();
            if($category->category_id == 0){;
                $projects = Projects::join('categories', 'categories.id', '=', 'projects.category_id')->select('projects.*')
                    ->where('projects.status', 1)->where('categories.category_id', $category->id)->orderBy('projects.created_at', 'desc')->paginate(9);
                foreach ($projects as $project) {
                    $url_images = json_decode($project->url_images);
                    $project->url_avatar = $url_images[0];
                }
                return view('frontend.categories_parent',[
                    'categories' => $categories,
                    'category' => $category,
                    'projects_seo' => $projects_seo,
                    'projects' => $projects
                ]);
            }else{
                $projects = Projects::where('category_id',$category->id)->where('status',1)->orderBy('id','desc')->paginate(5);
                $category_parent = Categories::where('id', $category->category_id)->firstOrFail();
                foreach ($projects as $project) {
                    $url_images = json_decode($project->url_images);
                    if(count($url_images)>0){
                        $project->url_avatar = $url_images[0];
                    }else{
                        $project->url_avatar = null;
                    }
                    $project->count_comments = Comments::where('post_id', $project->id)->where('status',1)->count();
                }
                $news_relate =  News::where('status',1)->orderBy('created_at','desc')->limit(5)->get();
                $links = Links::where('status', 1)->get();
                $investors = Investors::where('status', 1)->get();
                return view('frontend.categories',[
                    'category' => $category,
                    'projects' => $projects,
                    'projects_seo' => $projects_seo,
                    'categories' => $categories,
                    'news_relate' => $news_relate,
                    'links' => $links,
                    'investors' => $investors,
                    'category_parent' => $category_parent
                ]);
            }
        }catch(ModelNotFoundException $err){
            return redirect()->route('Home'); 
        }
        
    }
    public function getProjectSeo()
    {
        $projects_seo = Projects::with('categories')->where('status',1)->where('seo',1)->orderBy('id','desc')->limit(15)->get();
        foreach ($projects_seo as $project) {
            $url_images = json_decode($project->url_images);
            $project->url_avatar = $url_images[0];
        }
        $categories = Categories::where('category_id',0)->where('status',1)->get();
        foreach($categories as $category)
        {
            $category->sub = Categories::where('category_id',$category->id)->get();
        }
        $projects = Projects::where('status', 1)->where('seo', 1)->orderBy('created_at', 'desc')->paginate(9);
        foreach ($projects as $project) {
            $url_images = json_decode($project->url_images);
            $project->url_avatar = $url_images[0];
        }
        return view('frontend.projectSeo', [
                'projects_seo' => $projects_seo,
                'categories' => $categories,
                'projects' => $projects
            ]);
    }

    public function getSubCategory($id)
    {
        $cat = Categories::findOrFail($id);
        $sub = Categories::select('id', 'title', 'slug')->where('category_id', $cat->id)->get();
        return response()->json($sub, 200);
    }
    public function getSearch($slugCat, $slugCatSub, $search)
    {
        $categories = Categories::where('category_id',0)->where('status',1)->get();
        foreach($categories as $category)
        {
            $category->sub = Categories::where('category_id',$category->id)->get();
        }
        $projects_seo = Projects::with('categories')->where('status',1)->where('seo',1)->orderBy('id','desc')->limit(15)->get();
        foreach ($projects_seo as $project) {
            $url_images = json_decode($project->url_images);
            $project->url_avatar = $url_images[0];
        }

        $projects = Projects::orderBy('created_at', 'desc')->paginate(9);

        if($slugCat != 'all' && $slugCatSub == 'all' && $search == 'all'){
            $cat = Categories::select('id')->where('slug', $slugCat)->first();
                $projects = Projects::join('categories', 'categories.id', '=', 'projects.category_id')->select('projects.*')
                    ->where('projects.status', 1)->where('categories.category_id', $cat->id)->orderBy('projects.created_at', 'desc')->paginate(9);
        }
        if($slugCat != 'all' && $slugCatSub == 'all' && $search != 'all'){
            $cat = Categories::select('id')->where('slug', $slugCat)->first();
                $projects = Projects::join('categories', 'categories.id', '=', 'projects.category_id')
                    ->select('projects.*')
                    ->where('projects.status', 1)
                    ->where('categories.category_id', $cat->id)
                    ->where('projects.title', 'like', '%'.$search.'%')
                    ->orderBy('projects.created_at', 'desc')
                    ->paginate(12);
        }
        if( $slugCatSub != 'all' && $search == 'all'){
            $cat = Categories::select('id')->where('slug', $slugCatSub)->first();
            $projects = Projects::where('category_id', $cat->id)
                ->where('status', 1)
                ->orderBy('projects.created_at', 'desc')
                ->paginate(9);
        }
        if( $slugCatSub != 'all' && $search != 'all'){
            $cat = Categories::select('id')->where('slug', $slugCatSub)->first();
            $projects = Projects::where('category_id', $cat->id)
                ->where('status', 1)
                ->where('projects.title', 'like', '%'.$search.'%')
                ->orderBy('projects.created_at', 'desc')
                ->paginate(9);
        }
        if($slugCat == 'all' && $slugCatSub == 'all' && $search != 'all'){
            $cat = Categories::select('id')->where('slug', $slugCatSub)->first();
            $projects = Projects::where('status', 1)
                ->where('projects.title', 'like', '%'.$search.'%')
                ->orderBy('projects.created_at', 'desc')
                ->paginate(9);
        }
        
        foreach ($projects as $project) {
            $url_images = json_decode($project->url_images);
            $project->url_avatar = $url_images[0];
        }
        if($search == 'all') $search = '';
        return view('frontend.search', [
            'categories' => $categories,
            'projects_seo' => $projects_seo,
            'projects' => $projects,
            'slugCat' => $slugCat,
            'slugCatSub' => $slugCatSub,
            'search' => $search
        ]);
    }

    public function getTagProject($slug)
    {
        $categories = Categories::where('category_id',0)->where('status',1)->get();
        foreach($categories as $category)
        {
            $category->sub = Categories::where('category_id',$category->id)->get();
        }
        $tag = Tags::where('slug', $slug)->first();

        $projects = Projects::join('tag_project', 'tag_project.project_id', '=', 'projects.id')
            ->select('projects.*')
            ->where('tag_project.tag_id', $tag->id)
            ->where('projects.status', 1)
            ->orderBy('projects.created_at', 'desc')
            ->paginate(9);
        return view('frontend.tagProject', [
            'categories' => $categories,
            'projects' => $projects,
            'tag' => $tag
        ]);
    }

    public function getTagNew($slug)
    {
        $tag = Tags::where('slug', $slug)->first();
        $news = News::join('tag_new', 'tag_new.new_id', '=', 'news.id')
            ->select('news.*')
            ->where('tag_new.tag_id', $tag->id)
            ->where('news.status',1)
            ->orderBy('news.created_at','desc')
            ->paginate(10);
        $projects = Projects::with('categories')->where('status',1)->orderBy('created_at','desc')->limit(5)->get();
        foreach ($projects as $project) {
            $url_images = json_decode($project->url_images);
            if(count($url_images)>0){
                $project->url_avatar = $url_images[0];
            }else{
                $project->url_avatar = null;
            }
        }
        $categories = Categories::where('category_id',0)->where('status',1)->get();
        
        foreach($categories as $category)
        {
            $category->sub = Categories::where('category_id',$category->id)->get();
        }
        $links = Links::where('status', 1)->get();
        $investors = Investors::where('status', 1)->get();
        return view('frontend.tagNew',[
            'news' => $news,
            'projects' => $projects,
            'categories' => $categories,
            'links' => $links,
            'investors' => $investors,
            'tag' => $tag
        ]);
    }
}
