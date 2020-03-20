<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix'=>'admin', 'middleware'=>'adminLogin'],function(){
	Route::get('logout', 'LogoutController@getLogout')->name('admin.logout');
	Route::group(['prefix'=>'config'], function(){
		Route::get('/', 'ConfigsController@getIndex')->name('AdminConfig');
		Route::post('/', 'ConfigsController@update')->name('AdminConfigUpdate');
	});

	Route::group(['prefix'=>'sliders'], function(){
		Route::get('/', 'SlidersController@getIndex')->name('AdminSlider');
		Route::post('/', 'SlidersController@create')->name('AdminSliderCreate');
		Route::get('delete/{id}', 'SlidersController@delete')->name('AdminSliderDelete');
	});

	Route::group(['prefix'=>'investors'], function(){
		Route::get('/', 'InvestorsController@getIndex')->name('AdminInvestor');
		Route::post('/', 'InvestorsController@postAdd')->name('AdminInvestorsPostAdd');
		Route::get('delete/{id}', 'InvestorsController@getDelete')->name('AdminInvestorGetDelete');
		Route::get('get/{id}', 'InvestorsController@get')->name('AdminInvestorGet');
		Route::get('changeStatus/{id}', 'InvestorsController@changeStatus')->name('AdminInvestorChangeStatus');
	});

	Route::group(['prefix'=>'details'], function(){ 
		Route::get('/', 'DetailsController@getIndex')->name('AdminDetails');
		Route::post('/', 'DetailsController@create')->name('AdminDetailsCreate');
		Route::get('delete/{id}', 'DetailsController@delete')->name('AdminDetailsDelete');
		Route::post('update/{id}', 'DetailsController@update')->name('AdminDetailsUpdate');
		Route::get('status/{id}', 'DetailsController@status')->name('AdminDetailsStatus');
		Route::get('get/{id}', 'DetailsController@get')->name('AdminDetailsGet');
	});

	Route::group(['prefix'=>'utilities'], function(){
		Route::get('/', 'UtilitiesController@getIndex')->name('AdminUtilities');
		Route::post('/', 'UtilitiesController@create')->name('AdimUtilitiesCreate');
		Route::get('delete/{id}', 'UtilitiesController@delete')->name('AdminUtilitiesDelete');
		Route::get('status/{id}', 'UtilitiesController@status')->name('AdminUtilitiesStatus');
		Route::get('get/{id}', 'UtilitiesController@get')->name('AdminUtilitiesGet');
		Route::post('update/{id}', 'UtilitiesController@update')->name('AdminUtilitiesUpdate');
	});

	Route::group(['prefix'=>'categories'], function(){
		Route::get('/', 'CategoriesController@getIndex')->name('AdminCategories');
		Route::post('/', 'CategoriesController@create')->name('AdminCategoriesCreate');
		Route::get('delete/{id}', 'CategoriesController@delete')->name('AdminCategoriesDelete');
	});

	Route::group(['prefix'=>'projects'], function(){
		Route::get('/', 'ProjectsController@getIndex')->name('AdminProjects');
		Route::get('add', 'ProjectsController@getAdd')->name('AdminProjectsGetAdd');
		Route::post('add', 'ProjectsController@postAdd')->name('AdminProjectsPostAdd');
		Route::get('delete/{id}', 'ProjectsController@getDelete')->name('AdminProjectsGetDelete');
		Route::get('changeStatus/{id}', 'ProjectsController@getChangeStatus')->name('ProjectsGetChangeStatus');
		Route::get('update/{id}', 'ProjectsController@getUpdate')->name('ProjectsGetUpdate');
		Route::post('update/{id}', 'ProjectsController@postUpdate')->name('ProjectsPostUpdate');
		Route::get('review/{slugCat}/{slugPro}', 'ProjectsController@getReview')->name('ProjectsGetReview');
		Route::post('createSlug', 'ProjectsController@getCreateSlug')->name('ProjectsGetCreateSlug');
		Route::post('deleteImage', 'ProjectsController@postDeleteImage')->name('ProjectsPostDeleteImage');
		Route::post('statusOn', 'ProjectsController@postStatusOn')->name('ProjectsPostStatusOn');
		Route::post('statusOff', 'ProjectsController@postStatusOff')->name('ProjectsPostStatusOff');
	});

	Route::group(['prefix'=>'news'], function(){
		Route::get('/', 'NewsController@getIndex')->name('AdminNews');
		Route::get('add', 'NewsController@getAdd')->name('AdminNewsGetAdd');
		Route::post('add', 'NewsController@postAdd')->name('AdminNewsPostAdd');
		Route::get('anyData', 'NewsController@anyData')->name('AdminNewsAnyData');
		Route::get('update/{id}', 'NewsController@getUpdate')->name('AdminNewsGetUpdate');
		Route::post('update/{id}', 'NewsController@postUpdate')->name('AdminNewsPostUpdate');
		Route::get('status/{id}', 'NewsController@changeStatus')->name('AdminNewsStatus');
		Route::get('delete/{id}', 'NewsController@getDelete')->name('AdminNewsGetDelete');
		Route::get('review/tin-tuc-bds/{slug}', 'NewsController@getReview')->name('AdminNewsGetReview');
		Route::post('createSlug', 'NewsController@getCreateSlug')->name('AdminNewsGetCreateSlug');
	});
	Route::group(['prefix' => 'links'], function(){
		Route::get('/', 'LinksController@getIndex')->name('LinksGetIndex');
		Route::post('/', 'LinksController@postAdd')->name('LinksPostAdd');
		Route::get('delete/{id}', 'LinksController@getDelete')->name('LinksGetDelete');
		Route::get('changeStatus/{id}', 'LinksController@getChangeStatus')->name('LinksGetChangeStatus');
	});
	Route::group(['prefix' => 'contacts'], function(){
		Route::get('/', 'ContactsController@getIndex')->name('ContactsGetIndex');
		Route::get('delete/{id}', 'ContactsController@getDelete')->name('ContactsGetDelete');
	});
	Route::group(['prefix' => 'comments'], function(){
		Route::get('/', 'CommentsController@getIndex')->name('CommentsGetIndex');
		Route::get('changeStatus/{id}', 'CommentsController@changeStatus')->name('CommentsChangeStatus');
		Route::get('delete/{id}', 'CommentsController@getDelete')->name('CommentsGetDelete');
		Route::get('on-all', 'CommentsController@getOnAll')->name('CommentsGetOnAll');
	});
	Route::group(['prefix' => 'users'], function(){
		Route::get('myAccount', 'UsersController@getMyAccount')->name('UsersGetMyAccount');
		Route::post('myAccount', 'UsersController@postUpdateMyAccount')->name('UserUpdateMyAccount');
		Route::post('changePassword', 'UsersController@postChangePass')->name('UserChangePass');
		Route::get('listAccount', 'UsersController@getListAccount')->name('UsersList');
		Route::get('addAccount', 'UsersController@getAddAccount')->name('UserAddAccount');
		Route::post('addAccount', 'UsersController@postAddAccount')->name('UserPostAddAccount');
		Route::get('updateAccount/{id}', 'UsersController@getUpdateAccount')->name('UserGetUpdateAccount');
		Route::get('changeStatus/{id}', 'UsersController@getChangeStatus')->name('UsersGetChangeStatus');
	});
	Route::group(['prefix' => 'tags'], function(){
		Route::get('/', 'TagsController@getIndex')->name('AdminTags');
		Route::post('/', 'TagsController@postAdd')->name('AdminTagsPostAdd');
		Route::get('update/{id}', 'TagsController@getUpdate')->name('AdminTagsGetUpdate');
		Route::post('update/{id}', 'TagsController@postUpdate')->name('AdminTagsPostUpdate');
		Route::get('delete/{id}', 'TagsController@getDelete')->name('AdminTagsGetDelete');
	});
	Route::get('ckeditor', 'CkeditorController@index');
	Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');
});

Route::group(['prefix'=>'editor', 'middleware'=>'editorLogin'],function(){
	Route::group(['prefix' => 'users'], function(){
		Route::get('myAccount', 'UsersController@getMyAccountEditor')->name('UsersGetMyAccountEditor');
		Route::post('myAccount', 'UsersController@postUpdateMyAccountEditor')->name('UserUpdateMyAccountEditor');
		Route::post('changePassword', 'UsersController@postChangePassEditor')->name('UserChangePassEditor');
	});
	Route::group(['prefix'=>'projects'], function(){
		Route::get('/', 'ProjectsController@getIndexEditor')->name('EditorProjects');
		Route::get('add', 'ProjectsController@getAddEditor')->name('EditorProjectsGetAdd');
		Route::post('add', 'ProjectsController@postAddEditor')->name('EditorProjectsPostAdd');
		Route::get('update/{id}', 'ProjectsController@getUpdateEditor')->name('EditorProjectsGetUpdate');
		Route::post('update/{id}', 'ProjectsController@postUpdateEditor')->name('EditorProjectsPostUpdate');
		Route::post('createSlug', 'ProjectsController@getCreateSlugEditor')->name('EditorProjectsGetCreateSlug');
	});
	Route::group(['prefix'=>'news'], function(){
		Route::get('/', 'NewsController@getIndexEditor')->name('EditorNews');
		Route::get('add', 'NewsController@getAddEditor')->name('EditorNewsGetAdd');
		Route::post('add', 'NewsController@postAddEditor')->name('EditorNewsPostAdd');
		Route::get('update/{id}', 'NewsController@getUpdateEditor')->name('EditorNewsGetUpdate');
		Route::post('update/{id}', 'NewsController@postUpdateEditor')->name('EditorNewsPostUpdate');
		Route::post('createSlug', 'NewsController@getCreateSlugEditor')->name('EditorNewsGetCreateSlug');
	});
	Route::group(['prefix'=>'investors'], function(){
		Route::get('/', 'InvestorsController@getIndexEditor')->name('EditorInvestor');
		Route::post('/', 'InvestorsController@postAddEditor')->name('EditorInvestorsPostAdd');
	});
	Route::group(['prefix'=>'utilities'], function(){
		Route::get('/', 'UtilitiesController@getIndexEditor')->name('EditorUtilities');
		Route::post('/', 'UtilitiesController@createEditor')->name('EditorUtilitiesCreate');
		Route::get('get/{id}', 'UtilitiesController@getEditor')->name('EditorUtilitiesGet');
		Route::post('update/{id}', 'UtilitiesController@updateEditor')->name('EditorUtilitiesUpdate');
	});
	Route::group(['prefix'=>'details'], function(){ 
		Route::get('/', 'DetailsController@getIndexEditor')->name('EditorDetails');
		Route::post('/', 'DetailsController@createEditor')->name('EditorDetailsCreate');
		Route::get('get/{id}', 'DetailsController@getEditor')->name('EditorDetailsGet');
		Route::post('update/{id}', 'DetailsController@updateEditor')->name('EditorDetailsUpdate');
	});
	Route::group(['prefix' => 'tags'], function(){
		Route::get('/', 'TagsController@getIndexEditor')->name('EditorTags');
		Route::post('/', 'TagsController@postAddEditor')->name('EditorTagsPostAdd');
		Route::get('update/{id}', 'TagsController@getUpdateEditor')->name('EditorTagsGetUpdate');
		Route::post('update/{id}', 'TagsController@postUpdateEditor')->name('EditorTagsPostUpdate');
	});
	Route::get('ckeditor', 'CkeditorController@indexEditor');
	Route::post('ckeditor/upload', 'CkeditorController@upload')->name('editor.ckeditor.upload');
});

Route::get('dtbds.log-in', 'LoginController@getIndex')->name('getLogin');
Route::post('dtbds.log-in', 'LoginController@postIndex')->name('postLogin');

Route::group(['prefix'=>'/'], function(){
	Route::get('/', 'HomeController@getIndex')->name('Home');
	Route::get('tin-tuc-bds', 'HomeController@getNews')->name('News');
	Route::get('lien-he', 'HomeController@getContact')->name('Contact');
	Route::post('lien-he', 'ContactsController@postAdd')->name('ContactPostAdd');
	Route::get('tin-tuc-bds/{slug}', 'HomeController@getSingleNews')->name('SingleNews');
	Route::get('danh-muc-con/{id}', 'HomeController@getSubCategory')->name('GetSubCategory');
	Route::get('tim-kiem/{slugCat}/{slugCatSub}/{search}', 'HomeController@getSearch')->name('GetSearch');
	Route::get('chu-dau-tu', 'HomeController@getInvestors')->name('Investors');
	Route::get('du-an-noi-bat', 'HomeController@getProjectSeo')->name('ProjectSeo');
	Route::get('tag-bds/{slug}', 'HomeController@getTagProject')->name('TagProject');
	Route::get('tag-tin-tuc/{slug}', 'HomeController@getTagNew')->name('TagNew');
	Route::get('{slugCat}', 'HomeController@getCategories')->name('Categories');
	Route::get('{slugCat}/{slugPro}', 'HomeController@getProject')->name('Project');
	Route::post('addComment', 'CommentsController@postAddComment')->name('AddComment');
});

