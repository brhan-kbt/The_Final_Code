<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Http\Traits\QueryMessage;
use App\Models\UserAccount;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    use QueryMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index()
    {
        $messages =$this->getAllMessage();
        $notifications =$this->getNotifications();

        $allMessages=Message::all();
        $where=$this->dashboardSelector();
        
        return view($where.'.index')->with('messages', $messages)->with('notifications', $notifications)->with('allMessages', $allMessages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admins=UserAccount::all()->where('admin_id','!=','0');
        $members=UserAccount::all()->where('member_id','!=','0');
        $messages =$this->getAllMessage();
        $notifications =$this->getNotifications();

        $where=$this->dashboardSelector();

      return view($where.'.create')
                    ->with('messages', $messages)
                    ->with('notifications', $notifications)
                    ->with('admins', $admins)
                    ->with('members', $members);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Auth::user()) {
            $this->validate($request, [
            'title'=>'required',
            'message'=>'required',
            'reciepent_id'=>'required'
        ]);
        }
        else{
            $this->validate($request, [
            'title'=>'required',
            'message'=>'required',
        ]);
        }


        $message= new Message();
        if (Auth::user()) {
            if (Auth::user()->userType ==='member') {
                $message->senderName= Auth::user()->member->fullName;
            } else {
                $message->senderName= Auth::user()->admin->adminName;
            }
        $message->reciepent_id= $request->input('reciepent_id');

        }
        else{
            $message->senderName= $request->input('senderName');
            $message->reciepent_id= 3;

        }
        $message->title= $request->input('title');
        $message->email= $request->input('email');
        $message->message= $request->input('message');
        $message->status= 'unseen';
        $message->save();

        if(Auth::user()){
           return redirect('message');
        }
        else{
           return redirect('contact')->with('success','Thank You for your feedback!');
        }
        // return redirect('message')->with('success','Thank You for your feedback!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
      $message= Message::find($id);
      $message->status='seen';
      $message->save();
      $messages = $this->getAllMessage();
      $notifications =$this->getNotifications();

      $where=$this->dashboardSelector();

         
             return view($where.'.show')->with('messages', $messages)->with('message', $message)->with('notifications', $notifications);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}