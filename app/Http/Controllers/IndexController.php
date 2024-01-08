<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pages;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use OpenGraph;
use SEOMeta;
use App\Setting;
use App\Menu;

class IndexController extends Controller
{
    protected $pages;
    protected $setting;
    protected $menu;
    public function __construct()
    {
        $this->pages = new Pages();
        $this->setting = new Setting();
        $this->menu = new Menu();
    }

    public function index(){
        SEOMeta::setDescription($this->setting->where('slug','description')->get()->first()->description);
        OpenGraph::setDescription($this->setting->where('slug','description')->get()->first()->description);
        OpenGraph::setTitle('Rent | Home');
        OpenGraph::addProperty('type', 'pages');
        OpenGraph::addImage(asset('frontend/img/brand/rent-color.png'));
        return view('frontend.layouts');
    }

    public function menu($slug_menu,$slug_detail=null){
        $menu = $this->menu->where('slug',$slug_menu)->get();
        if($menu->count() > 0){
            if(!($slug_detail)){ // jika slug detail kosong
                $model = $menu->first()->menu_type->slug;
                $data =  $this->$model->where('menu_id',$menu->first()->id);
                if($data->get()->count() > 0){
                    if($model == 'pages'){
                        // SEO
                        SEOMeta::setDescription(strip_tags($data->get()->first()->description));
                        OpenGraph::setDescription(strip_tags($data->get()->first()->description));
                    }else{
                        SEOMeta::setDescription('Rent | '.title_case($menu->first()->name));
                        OpenGraph::setDescription('Rent | '.title_case($menu->first()->name));
                    }
                }else{
                    SEOMeta::setDescription('Rent | '.title_case($menu->first()->name));
                    OpenGraph::setDescription('Rent | '.title_case($menu->first()->name));
                }
                    OpenGraph::setTitle('Rent | '.title_case($menu->first()->name));
                    OpenGraph::addProperty('type', 'pages');
                    OpenGraph::addImage(asset('frontend/img/brand/rent-color.png'));

                return view('frontend.'.$model.'.index',compact(['data','menu']));
            }else{
                $model = $menu->first()->menu_type->slug;
                $data =  $this->$model->where('menu_id',$menu->first()->id)->where('slug',$slug_detail);
                if ($this->$model->where('menu_id',$menu->first()->id)->where('slug',$slug_detail)->get()->count() > 0){
                    // SEO
                    SEOMeta::setDescription(!($data->get()->first()->description) ? strip_tags($data->get()->first()->description):'Rent | Halaman '.title_case($menu->first()->name));
                    OpenGraph::setDescription(!($data->get()->first()->description) ? strip_tags($data->get()->first()->description):'Rent| Halaman '.title_case($menu->first()->name));
                    OpenGraph::setTitle('Rent | '.title_case($data->get()->first()->name));
                    OpenGraph::addProperty('type', 'pages');
                    OpenGraph::addImage(asset('frontend/img/brand/Rent-color.png'));

                    return view('frontend.'.$model.'.show',compact(['data','menu']));
                }else{
                    return view('frontend.component.404');
                }
            }
        }else{
            return view('frontend.component.404');
        }
    }


}
