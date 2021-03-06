<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Traits\QueryMessage;
use App\Models\Family;
use App\Models\Promise;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class MemberController extends Controller
{
    use QueryMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
   public function __construct()
    {
        $this->middleware('memberadmin')->except(['store','register','donate','status','edit']);
    }
    
     public function home(){
      
        $aMember=Member::where('status','=', '1')->count();
        $iaMember=Member::where('status','=', '0')->count();
        $messages=$this->getAllMessage();
        $notifications=$this->getNotifications();

        $notifications=$this->getNotifications();
         return view('memberadmin.home')->with('messages', $messages)
                                         ->with('aMember', $aMember)
                                         ->with('iaMember', $iaMember)
                                         ->with('notifications', $notifications);
                                         
         
     }
     
    public function index( Request $request)
    {
         $members=Member::all();
         $messages=$this->getAllMessage();
        $notifications=$this->getNotifications();


         return view('memberadmin.indexMember')->with('members', $members)->with('messages', $messages)->with('notifications', $notifications);

        // if ($request->ajax()) {
        //     $data = Member::latest()->get();
        //     return Datatables::of($data)
        //             ->addIndexColumn()
        //             ->addColumn('action', function($row){
        //                 $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
        //                 return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }

        // return view('memberadmin.indexMember');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $messages=$this->getAllMessage();
        $notifications=$this->getNotifications();

        return view('memberadmin.registerform')->with('messages', $messages)->with('notifications', $notifications);
    }
     public function register(){
        return view('pages.register');
    }
   
 public function changeStatus(Request $request) {
        $user = Member::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => 'Status Changed Successfully']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

             $this->validate($request, [
                'mfullname'=>'required',
                'member-age'=>'required',
                'member-sex'=>'required|in:Male,Female',
                'gfathername'=>'required',
                'mothername'=>'required',
                'baptismalName'=>'required',
                'churchBaptized'=>'required',
                'repetanceFname'=>'required',
                'birthplace'=>'required',
                'phone'=>'required|unique:members,phone',
                'address'=>'required',
                'profileImg'=>'required|image',
                'username'=>'required|unique:user_accounts,username',
                'password'=>'required|min:6|max:12',

         ]);

        //handle the file upload
         if($request->hasFile('profileImg')){
             //get file name extension

             $fienamewithExt=$request->file('profileImg')->getClientOriginalName();
                 //get file name
             $filename=pathinfo($fienamewithExt,PATHINFO_FILENAME);
                 //get file extension
             $extension=$request->file('profileImg')->getClientOriginalExtension();
                 //file name to store
            $fileNameToStore=$filename .'_'.time().'.'.$extension;

             $path=$request->file('profileImg')->storeAs('public/images',$fileNameToStore);


         }else{
             $fileNameToStore='noimage.jpg';
         }


       $member=new Member();
       $member->fullName=$request->input('mfullname');
       $member->age=$request->input('member-age');
       $member->sex=$request->input('member-sex');
       $member->grandName=$request->input('gfathername');
       $member->motherName=$request->input('mothername');
       $member->baptismalName=$request->input('baptismalName');
       $member->churchBaptize=$request->input('churchBaptized');
       $member->repetanceFatherName=$request->input('repetanceFname');
       $member->birthPlace=$request->input('birthplace');
       $member->phone=$request->input('phone');
       $member->address=$request->input('address');
       $member->profileImg=$fileNameToStore;
       if (auth()->user()) {
            $member->status=1;
       }
       else{
           $member->status=0;
       }
       $member->save();



       $pass=$request->input('password');
       $password=Hash::make($pass);

       $userAccount= new UserAccount();
       $userAccount->username=$request->input('username');
       $userAccount->password= $password;
       $userAccount->userType='member';
       $userAccount->member_id=$member->id;
       $userAccount->admin_id=0;//We can not register from user side so we don't have admin->id
       $userAccount->save();

       if ($request->familyfullname1[0]!=null && $request->familyage1[0]!=null && $request->relationship[0]!=null && $request->familydob1[0]!=null ) {
        for ($i=0; $i < count($request->familyfullname1); $i++) { 
            
                $family= new Family();
                $family->fullName=$request->familyfullname1[$i];
                $family->age=$request->familyage1[$i];
                if ($request->relationship[$i]==='Son') {
                    $family->gender='Male';
                }
                else{
                    $family->gender='Female';
                }
                $family->birthDate=$request->familydob1[$i];
                $family->relationShip=$request->relationship[$i];
                $family->member_id=$member->id;
                
                $family->save();
           }
           
       }

       return redirect('/login');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $messages=$this->getAllMessage();
        $notifications=$this->getNotifications();

        $member= Member::find($id);
        $url=$this->dashboardSelectorForUserProfile();

        if ($member) {
            if ($member->id=== Auth::user()->member_id or Auth::user()->userType==='memberadmin') {
                return view($url)->with('member', $member)->with('messages', $messages)->with('notifications', $notifications);
            } else {
                return Redirect::to(url()->previous());
            }
        }
        else{
                return Redirect::to(url()->previous());
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //handle the file upload
         if($request->hasFile('profileImg')){
             //get file name extension

             $fienamewithExt=$request->file('profileImg')->getClientOriginalName();
                 //get file name
             $filename=pathinfo($fienamewithExt,PATHINFO_FILENAME);
                 //get file extension
             $extension=$request->file('profileImg')->getClientOriginalExtension();
                 //file name to store
            $fileNameToStore=$filename .'_'.time().'.'.$extension;

             $path=$request->file('profileImg')->storeAs('public/images',$fileNameToStore);


         }else{
             $fileNameToStore='noimage.jpg';
         }


       $member=Member::find($id);

       $member->fullName=$request->input('mfullname');
       $member->age=$request->input('member-age');
       $member->sex=$request->input('member-sex');
       $member->grandName=$request->input('gfathername');
       $member->motherName=$request->input('mothername');
       $member->baptismalName=$request->input('baptismalName');
       $member->churchBaptize=$request->input('churchBaptized');
       $member->repetanceFatherName=$request->input('repetanceFname');
       $member->birthPlace=$request->input('birthplace');
       $member->phone=$request->input('phone');
       $member->address=$request->input('address');
       if($request->hasFile('profileImg')){
                  $member->profileImg=$fileNameToStore;
       }

       $member->save();



       return redirect('member/manage-members/')->with('success',"Registered Successfully!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }

    public function donate(){
        $messages=$this->getAllMessage();
        $notifications=$this->getNotifications();

        return view('user.donate')->with('messages', $messages)->with('notifications', $notifications);
    }

      public function status(){

        $promises= Promise::where('member_id', Auth::user()->id)->get();
        $messages=$this->getAllMessage();
        $notifications=$this->getNotifications();

        return view('user.status')->with('messages', $messages)->with('notifications', $notifications)->with('promises', $promises);
    }
}