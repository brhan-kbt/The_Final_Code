<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\UserAccount;
use App\Models\ChurchProfile;
use App\Models\MuseumRecord;
use Illuminate\Support\Facades\Auth;



class PagesController extends Controller
{
   
    public function index()
    {
            // dd(Hash::make('berhanukeb'));
        return view('welcome');
    }

    
    public function about()
    {
        $posts=ChurchProfile::all();
            return view('pages.about')->with('posts', $posts);

    }

     public function contactus()
    {
                return view('pages.contactus');

    } 
    
    public function services()
    {
                return view('pages.services');

    }

     public function museum()
    {
        $posts=MuseumRecord::orderBy('created_at','desc')->get();
        return view('pages.museum')->with('posts',$posts);

    }

     public function event()
    {
         $posts=Event::orderBy('created_at','desc')->get();
        
        return view('pages.events')->with('posts',$posts);
   
    }
    
}