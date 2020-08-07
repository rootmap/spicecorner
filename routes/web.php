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
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
Route::get('/privacy', 'HomeController@privacy');
Route::get('/gallery', 'HomeController@gallery');
Route::get('/reservation', 'HomeController@privacy');
Route::post('/reservation', 'HomeController@savereservation');

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/crud', 'CrudController@crud')->name('crud');
    Route::post('/crud', 'CrudController@crudgenarate')->name('crudgenarate');
    Route::get('/home', 'FrontServiceController@dashboard')->name('home');
    Route::get('/dashboard', 'FrontServiceController@dashboard')->name('dashboard');
    
    
    //======================== Category Route Start ===============================//
    Route::get('/category/list','CategoryController@show');
    Route::get('/category/create','CategoryController@create');
    Route::get('/category/edit/{id}','CategoryController@edit');
    Route::get('/category/delete/{id}','CategoryController@destroy');
    Route::get('/category','CategoryController@index');
    Route::get('/category/export/excel','CategoryController@ExportExcel');
    Route::get('/category/export/pdf','CategoryController@ExportPDF');
    Route::post('/category','CategoryController@store');
    Route::post('/category/ajax','CategoryController@ajaxSave');
    Route::post('/category/datatable/ajax','CategoryController@datatable');
    Route::post('/category/update/{id}','CategoryController@update');
    //======================== Category Route End ===============================//

    //======================== Sitesetting Route Start ===============================//
    Route::get('/sitesetting/list','SitesettingController@show');
    Route::get('/sitesetting/create','SitesettingController@create');
    Route::get('/sitesetting/edit/{id}','SitesettingController@edit');
    Route::get('/sitesetting/delete/{id}','SitesettingController@destroy');
    Route::get('/sitesetting','SitesettingController@index');
    Route::get('/sitesetting/export/excel','SitesettingController@ExportExcel');
    Route::get('/sitesetting/export/pdf','SitesettingController@ExportPDF');
    Route::post('/sitesetting','SitesettingController@store');
    Route::post('/sitesetting/ajax','SitesettingController@ajaxSave');
    Route::post('/sitesetting/datatable/ajax','SitesettingController@datatable');
    Route::post('/sitesetting/update/{id}','SitesettingController@update');
    //======================== Sitesetting Route End ===============================//

    
    //======================== Subcategory Route Start ===============================//
    Route::get('/subcategory/list','SubcategoryController@show');
    Route::get('/subcategory/create','SubcategoryController@create');
    Route::get('/subcategory/edit/{id}','SubcategoryController@edit');
    Route::get('/subcategory/delete/{id}','SubcategoryController@destroy');
    Route::get('/subcategory','SubcategoryController@index');
    Route::get('/subcategory/export/excel','SubcategoryController@ExportExcel');
    Route::get('/subcategory/export/pdf','SubcategoryController@ExportPDF');
    Route::post('/subcategory','SubcategoryController@store');
    Route::post('/subcategory/ajax','SubcategoryController@ajaxSave');
    Route::post('/subcategory/datatable/ajax','SubcategoryController@datatable');
    Route::post('/subcategory/update/{id}','SubcategoryController@update');
    //======================== Subcategory Route End ===============================//

    //======================== Menuitem Route Start ===============================//
    Route::get('/menuitem/list','MenuitemController@show');
    Route::get('/menuitem/create','MenuitemController@create');
    Route::get('/menuitem/edit/{id}','MenuitemController@edit');
    Route::get('/menuitem/delete/{id}','MenuitemController@destroy');
    Route::get('/menuitem','MenuitemController@index');
    Route::get('/menuitem/export/excel','MenuitemController@ExportExcel');
    Route::get('/menuitem/export/pdf','MenuitemController@ExportPDF');
    Route::post('/menuitem','MenuitemController@store');
    Route::post('/menuitem/ajax','MenuitemController@ajaxSave');
    Route::post('/menuitem/datatable/ajax','MenuitemController@datatable');
    Route::post('/menuitem/update/{id}','MenuitemController@update');
    //======================== Menuitem Route End ===============================//

    //======================== Slider Route Start ===============================//
    Route::get('/slider/list','SliderController@show');
    Route::get('/slider/create','SliderController@create');
    Route::get('/slider/edit/{id}','SliderController@edit');
    Route::get('/slider/delete/{id}','SliderController@destroy');
    Route::get('/slider','SliderController@index');
    Route::get('/slider/export/excel','SliderController@ExportExcel');
    Route::get('/slider/export/pdf','SliderController@ExportPDF');
    Route::post('/slider','SliderController@store');
    Route::post('/slider/ajax','SliderController@ajaxSave');
    Route::post('/slider/datatable/ajax','SliderController@datatable');
    Route::post('/slider/update/{id}','SliderController@update');
    //======================== Slider Route End ===============================//

    //======================== About Route Start ===============================//
    Route::get('/about/list','AboutController@show');
    Route::get('/about/create','AboutController@create');
    Route::get('/about/edit/{id}','AboutController@edit');
    Route::get('/about/delete/{id}','AboutController@destroy');
    Route::get('/about','AboutController@index');
    Route::get('/about/export/excel','AboutController@ExportExcel');
    Route::get('/about/export/pdf','AboutController@ExportPDF');
    Route::post('/about','AboutController@store');
    Route::post('/about/ajax','AboutController@ajaxSave');
    Route::post('/about/datatable/ajax','AboutController@datatable');
    Route::post('/about/update/{id}','AboutController@update');
    //======================== About Route End ===============================//

    //======================== Galleryheading Route Start ===============================//
    Route::get('/galleryheading/list','GalleryheadingController@show');
    Route::get('/galleryheading/create','GalleryheadingController@create');
    Route::get('/galleryheading/edit/{id}','GalleryheadingController@edit');
    Route::get('/galleryheading/delete/{id}','GalleryheadingController@destroy');
    Route::get('/galleryheading','GalleryheadingController@index');
    Route::get('/galleryheading/export/excel','GalleryheadingController@ExportExcel');
    Route::get('/galleryheading/export/pdf','GalleryheadingController@ExportPDF');
    Route::post('/galleryheading','GalleryheadingController@store');
    Route::post('/galleryheading/ajax','GalleryheadingController@ajaxSave');
    Route::post('/galleryheading/datatable/ajax','GalleryheadingController@datatable');
    Route::post('/galleryheading/update/{id}','GalleryheadingController@update');
    //======================== Galleryheading Route End ===============================//

    //======================== Galleryphoto Route Start ===============================//
    Route::get('/galleryphoto/list','GalleryphotoController@show');
    Route::get('/galleryphoto/create','GalleryphotoController@create');
    Route::get('/galleryphoto/edit/{id}','GalleryphotoController@edit');
    Route::get('/galleryphoto/delete/{id}','GalleryphotoController@destroy');
    Route::get('/galleryphoto','GalleryphotoController@index');
    Route::get('/galleryphoto/export/excel','GalleryphotoController@ExportExcel');
    Route::get('/galleryphoto/export/pdf','GalleryphotoController@ExportPDF');
    Route::post('/galleryphoto','GalleryphotoController@store');
    Route::post('/galleryphoto/ajax','GalleryphotoController@ajaxSave');
    Route::post('/galleryphoto/datatable/ajax','GalleryphotoController@datatable');
    Route::post('/galleryphoto/update/{id}','GalleryphotoController@update');
    //======================== Galleryphoto Route End ===============================//

    //======================== Openinghour Route Start ===============================//
    Route::get('/openinghour/list','OpeninghourController@show');
    Route::get('/openinghour/create','OpeninghourController@create');
    Route::get('/openinghour/edit/{id}','OpeninghourController@edit');
    Route::get('/openinghour/delete/{id}','OpeninghourController@destroy');
    Route::get('/openinghour','OpeninghourController@index');
    Route::get('/openinghour/export/excel','OpeninghourController@ExportExcel');
    Route::get('/openinghour/export/pdf','OpeninghourController@ExportPDF');
    Route::post('/openinghour','OpeninghourController@store');
    Route::post('/openinghour/ajax','OpeninghourController@ajaxSave');
    Route::post('/openinghour/datatable/ajax','OpeninghourController@datatable');
    Route::post('/openinghour/update/{id}','OpeninghourController@update');
    //======================== Openinghour Route End ===============================//

    //======================== Tablebooking Route Start ===============================//
    Route::get('/tablebooking/list','TablebookingController@show');
    Route::get('/tablebooking/create','TablebookingController@create');
    Route::get('/tablebooking/edit/{id}','TablebookingController@edit');
    Route::get('/tablebooking/delete/{id}','TablebookingController@destroy');
    Route::get('/tablebooking','TablebookingController@index');
    Route::get('/tablebooking/export/excel','TablebookingController@ExportExcel');
    Route::get('/tablebooking/export/pdf','TablebookingController@ExportPDF');
    Route::post('/tablebooking','TablebookingController@store');
    Route::post('/tablebooking/ajax','TablebookingController@ajaxSave');
    Route::post('/tablebooking/datatable/ajax','TablebookingController@datatable');
    Route::post('/tablebooking/update/{id}','TablebookingController@update');
    //======================== Tablebooking Route End ===============================//
   

    //======================== Galleryphoto Route Start ===============================//
    Route::get('/galleryphoto/list','GalleryphotoController@show');
    Route::get('/galleryphoto/create','GalleryphotoController@create');
    Route::get('/galleryphoto/edit/{id}','GalleryphotoController@edit');
    Route::get('/galleryphoto/delete/{id}','GalleryphotoController@destroy');
    Route::get('/galleryphoto','GalleryphotoController@index');
    Route::get('/galleryphoto/export/excel','GalleryphotoController@ExportExcel');
    Route::get('/galleryphoto/export/pdf','GalleryphotoController@ExportPDF');
    Route::post('/galleryphoto','GalleryphotoController@store');
    Route::post('/galleryphoto/ajax','GalleryphotoController@ajaxSave');
    Route::post('/galleryphoto/datatable/ajax','GalleryphotoController@datatable');
    Route::post('/galleryphoto/update/{id}','GalleryphotoController@update');
    //======================== Galleryphoto Route End ===============================//
    //======================== Galleryphoto Route Start ===============================//
    Route::get('/galleryphoto/list','GalleryphotoController@show');
    Route::get('/galleryphoto/create','GalleryphotoController@create');
    Route::get('/galleryphoto/edit/{id}','GalleryphotoController@edit');
    Route::get('/galleryphoto/delete/{id}','GalleryphotoController@destroy');
    Route::get('/galleryphoto','GalleryphotoController@index');
    Route::get('/galleryphoto/export/excel','GalleryphotoController@ExportExcel');
    Route::get('/galleryphoto/export/pdf','GalleryphotoController@ExportPDF');
    Route::post('/galleryphoto','GalleryphotoController@store');
    Route::post('/galleryphoto/ajax','GalleryphotoController@ajaxSave');
    Route::post('/galleryphoto/datatable/ajax','GalleryphotoController@datatable');
    Route::post('/galleryphoto/update/{id}','GalleryphotoController@update');
    //======================== Galleryphoto Route End ===============================//
    //======================== Privacycms Route Start ===============================//
    Route::get('/privacycms/list','PrivacycmsController@show');
    Route::get('/privacycms/create','PrivacycmsController@create');
    Route::get('/privacycms/edit/{id}','PrivacycmsController@edit');
    Route::get('/privacycms/delete/{id}','PrivacycmsController@destroy');
    Route::get('/privacycms','PrivacycmsController@index');
    Route::get('/privacycms/export/excel','PrivacycmsController@ExportExcel');
    Route::get('/privacycms/export/pdf','PrivacycmsController@ExportPDF');
    Route::post('/privacycms','PrivacycmsController@store');
    Route::post('/privacycms/ajax','PrivacycmsController@ajaxSave');
    Route::post('/privacycms/datatable/ajax','PrivacycmsController@datatable');
    Route::post('/privacycms/update/{id}','PrivacycmsController@update');
    //======================== Privacycms Route End ===============================//
    //======================== Menucategory Route Start ===============================//
    Route::get('/menucategory/list','MenucategoryController@show');
    Route::get('/menucategory/create','MenucategoryController@create');
    Route::get('/menucategory/edit/{id}','MenucategoryController@edit');
    Route::get('/menucategory/delete/{id}','MenucategoryController@destroy');
    Route::get('/menucategory','MenucategoryController@index');
    Route::get('/menucategory/export/excel','MenucategoryController@ExportExcel');
    Route::get('/menucategory/export/pdf','MenucategoryController@ExportPDF');
    Route::post('/menucategory','MenucategoryController@store');
    Route::post('/menucategory/ajax','MenucategoryController@ajaxSave');
    Route::post('/menucategory/datatable/ajax','MenucategoryController@datatable');
    Route::post('/menucategory/update/{id}','MenucategoryController@update');
    //======================== Menucategory Route End ===============================//

    //======================== Ourmenuitem Route Start ===============================//
    Route::get('/ourmenuitem/list','OurmenuitemController@show');
    Route::get('/ourmenuitem/create','OurmenuitemController@create');
    Route::get('/ourmenuitem/copy/{id}','OurmenuitemController@duplicate');
    Route::get('/ourmenuitem/edit/{id}','OurmenuitemController@edit');
    Route::get('/ourmenuitem/delete/{id}','OurmenuitemController@destroy');
    Route::get('/ourmenuitem','OurmenuitemController@index');
    Route::get('/ourmenuitem/export/excel','OurmenuitemController@ExportExcel');
    Route::get('/ourmenuitem/export/pdf','OurmenuitemController@ExportPDF');
    Route::post('/ourmenuitem','OurmenuitemController@store');
    Route::post('/ourmenuitem/ajax','OurmenuitemController@ajaxSave');
    Route::post('/ourmenuitem/datatable/ajax','OurmenuitemController@datatable');
    Route::post('/ourmenuitem/update/{id}','OurmenuitemController@update');
    //======================== Ourmenuitem Route End ===============================//
    //======================== Takewaycategory Route Start ===============================//
    Route::get('/takewaycategory/list','TakewaycategoryController@show');
    Route::get('/takewaycategory/create','TakewaycategoryController@create');
    Route::get('/takewaycategory/edit/{id}','TakewaycategoryController@edit');
    Route::get('/takewaycategory/delete/{id}','TakewaycategoryController@destroy');
    Route::get('/takewaycategory','TakewaycategoryController@index');
    Route::get('/takewaycategory/export/excel','TakewaycategoryController@ExportExcel');
    Route::get('/takewaycategory/export/pdf','TakewaycategoryController@ExportPDF');
    Route::post('/takewaycategory','TakewaycategoryController@store');
    Route::post('/takewaycategory/ajax','TakewaycategoryController@ajaxSave');
    Route::post('/takewaycategory/datatable/ajax','TakewaycategoryController@datatable');
    Route::post('/takewaycategory/update/{id}','TakewaycategoryController@update');
    //======================== Takewaycategory Route End ===============================//
    //======================== Takewaymenuitem Route Start ===============================//
    Route::get('/takewaymenuitem/list','TakewaymenuitemController@show');
    Route::get('/takewaymenuitem/create','TakewaymenuitemController@create');
    Route::get('/takewaymenuitem/copy/{id}','TakewaymenuitemController@duplicate');
    Route::get('/takewaymenuitem/edit/{id}','TakewaymenuitemController@edit');
    Route::get('/takewaymenuitem/delete/{id}','TakewaymenuitemController@destroy');
    Route::get('/takewaymenuitem','TakewaymenuitemController@index');
    Route::get('/takewaymenuitem/export/excel','TakewaymenuitemController@ExportExcel');
    Route::get('/takewaymenuitem/export/pdf','TakewaymenuitemController@ExportPDF');
    Route::post('/takewaymenuitem','TakewaymenuitemController@store');
    Route::post('/takewaymenuitem/ajax','TakewaymenuitemController@ajaxSave');
    Route::post('/takewaymenuitem/datatable/ajax','TakewaymenuitemController@datatable');
    Route::post('/takewaymenuitem/update/{id}','TakewaymenuitemController@update');
    //======================== Takewaymenuitem Route End ===============================//

    //======================== Daywisecategory Route Start ===============================//
    Route::get('/daywisecategory/list','DaywisecategoryController@show');
    Route::get('/daywisecategory/create','DaywisecategoryController@create');
    Route::get('/daywisecategory/edit/{id}','DaywisecategoryController@edit');
    Route::get('/daywisecategory/delete/{id}','DaywisecategoryController@destroy');
    Route::get('/daywisecategory','DaywisecategoryController@index');
    Route::get('/daywisecategory/export/excel','DaywisecategoryController@ExportExcel');
    Route::get('/daywisecategory/export/pdf','DaywisecategoryController@ExportPDF');
    Route::post('/daywisecategory','DaywisecategoryController@store');
    Route::post('/daywisecategory/ajax','DaywisecategoryController@ajaxSave');
    Route::post('/daywisecategory/datatable/ajax','DaywisecategoryController@datatable');
    Route::post('/daywisecategory/update/{id}','DaywisecategoryController@update');
    //======================== Daywisecategory Route End ===============================//
    //======================== Sitesettings Route Start ===============================//
    Route::get('/sitesettings/list','SitesettingsController@show');
    Route::get('/sitesettings/create','SitesettingsController@create');
    Route::get('/sitesettings/edit/{id}','SitesettingsController@edit');
    Route::get('/sitesettings/delete/{id}','SitesettingsController@destroy');
    Route::get('/sitesettings','SitesettingsController@index');
    Route::get('/sitesettings/export/excel','SitesettingsController@ExportExcel');
    Route::get('/sitesettings/export/pdf','SitesettingsController@ExportPDF');
    Route::post('/sitesettings','SitesettingsController@store');
    Route::post('/sitesettings/ajax','SitesettingsController@ajaxSave');
    Route::post('/sitesettings/datatable/ajax','SitesettingsController@datatable');
    Route::post('/sitesettings/update/{id}','SitesettingsController@update');
    //======================== Sitesettings Route End ===============================//
    //======================== Homedelivery Route Start ===============================//
    Route::get('/homedelivery/list','HomedeliveryController@show');
    Route::get('/homedelivery/create','HomedeliveryController@create');
    Route::get('/homedelivery/edit/{id}','HomedeliveryController@edit');
    Route::get('/homedelivery/delete/{id}','HomedeliveryController@destroy');
    Route::get('/homedelivery','HomedeliveryController@index');
    Route::get('/homedelivery/export/excel','HomedeliveryController@ExportExcel');
    Route::get('/homedelivery/export/pdf','HomedeliveryController@ExportPDF');
    Route::post('/homedelivery','HomedeliveryController@store');
    Route::post('/homedelivery/ajax','HomedeliveryController@ajaxSave');
    Route::post('/homedelivery/datatable/ajax','HomedeliveryController@datatable');
    Route::post('/homedelivery/update/{id}','HomedeliveryController@update');
    //======================== Homedelivery Route End ===============================//
    //======================== Siteforeground Route Start ===============================//
    Route::get('/siteforeground/list','SiteforegroundController@show');
    Route::get('/siteforeground/create','SiteforegroundController@create');
    Route::get('/siteforeground/edit/{id}','SiteforegroundController@edit');
    Route::get('/siteforeground/delete/{id}','SiteforegroundController@destroy');
    Route::get('/siteforeground','SiteforegroundController@index');
    Route::get('/siteforeground/export/excel','SiteforegroundController@ExportExcel');
    Route::get('/siteforeground/export/pdf','SiteforegroundController@ExportPDF');
    Route::post('/siteforeground','SiteforegroundController@store');
    Route::post('/siteforeground/ajax','SiteforegroundController@ajaxSave');
    Route::post('/siteforeground/datatable/ajax','SiteforegroundController@datatable');
    Route::post('/siteforeground/update/{id}','SiteforegroundController@update');
    //======================== Siteforeground Route End ===============================//
    //======================== Reservationinfo Route Start ===============================//
    Route::get('/reservationinfo/list','ReservationinfoController@show');
    Route::get('/reservationinfo/create','ReservationinfoController@create');
    Route::get('/reservationinfo/edit/{id}','ReservationinfoController@edit');
    Route::get('/reservationinfo/delete/{id}','ReservationinfoController@destroy');
    Route::get('/reservationinfo','ReservationinfoController@index');
    Route::get('/reservationinfo/export/excel','ReservationinfoController@ExportExcel');
    Route::get('/reservationinfo/export/pdf','ReservationinfoController@ExportPDF');
    Route::post('/reservationinfo','ReservationinfoController@store');
    Route::post('/reservationinfo/ajax','ReservationinfoController@ajaxSave');
    Route::post('/reservationinfo/datatable/ajax','ReservationinfoController@datatable');
    Route::post('/reservationinfo/update/{id}','ReservationinfoController@update');
    //======================== Reservationinfo Route End ===============================//
    //======================== Ourmenuday Route Start ===============================//
    Route::get('/ourmenuday/list','OurmenudayController@show');
    Route::get('/ourmenuday/create','OurmenudayController@create');
    Route::get('/ourmenuday/edit/{id}','OurmenudayController@edit');
    Route::get('/ourmenuday/delete/{id}','OurmenudayController@destroy');
    Route::get('/ourmenuday','OurmenudayController@index');
    Route::get('/ourmenuday/export/excel','OurmenudayController@ExportExcel');
    Route::get('/ourmenuday/export/pdf','OurmenudayController@ExportPDF');
    Route::post('/ourmenuday','OurmenudayController@store');
    Route::post('/ourmenuday/ajax','OurmenudayController@ajaxSave');
    Route::post('/ourmenuday/datatable/ajax','OurmenudayController@datatable');
    Route::post('/ourmenuday/update/{id}','OurmenudayController@update');
    //======================== Ourmenuday Route End ===============================//
    //======================== Ourmenucategory Route Start ===============================//
    Route::get('/ourmenucategory/list','OurmenucategoryController@show');
    Route::get('/ourmenucategory/create','OurmenucategoryController@create');
    Route::get('/ourmenucategory/edit/{id}','OurmenucategoryController@edit');
    Route::get('/ourmenucategory/delete/{id}','OurmenucategoryController@destroy');
    Route::get('/ourmenucategory','OurmenucategoryController@index');
    Route::get('/ourmenucategory/export/excel','OurmenucategoryController@ExportExcel');
    Route::get('/ourmenucategory/export/pdf','OurmenucategoryController@ExportPDF');
    Route::post('/ourmenucategory','OurmenucategoryController@store');
    Route::post('/ourmenucategory/ajax','OurmenucategoryController@ajaxSave');
    Route::post('/ourmenucategory/datatable/ajax','OurmenucategoryController@datatable');
    Route::post('/ourmenucategory/update/{id}','OurmenucategoryController@update');
    //======================== Ourmenucategory Route End ===============================//
    //======================== Daymenuitem Route Start ===============================//
    Route::get('/daymenuitem/list','DaymenuitemController@show');
    Route::get('/daymenuitem/create','DaymenuitemController@create');
    Route::get('/daymenuitem/edit/{id}','DaymenuitemController@edit');
    Route::get('/daymenuitem/copy/{id}','DaymenuitemController@duplicate');
    Route::get('/daymenuitem/delete/{id}','DaymenuitemController@destroy');
    Route::get('/daymenuitem','DaymenuitemController@index');
    Route::get('/daymenuitem/export/excel','DaymenuitemController@ExportExcel');
    Route::get('/daymenuitem/export/pdf','DaymenuitemController@ExportPDF');
    Route::post('/daymenuitem','DaymenuitemController@store');
    Route::post('/daymenuitem/ajax','DaymenuitemController@ajaxSave');
    Route::post('/daymenuitem/datatable/ajax','DaymenuitemController@datatable');
    Route::post('/daymenuitem/update/{id}','DaymenuitemController@update');
    //======================== Daymenuitem Route End ===============================//

});

