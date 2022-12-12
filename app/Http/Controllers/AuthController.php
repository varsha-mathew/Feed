<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use Vedmant\FeedReader\Facades\FeedReader;
use App\Models\User;
use App\Models\Feed;
use DB;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    //loading login page
    public function index()
    {
        return view('auth.login');
    }  
    
    //validation and save login
    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            Session::flash('message','You have signed-in');
            return redirect("Feeds");
        }else
        {
            Session::flash('message','Please check your emailid and Password');
           return view('auth.login');
        }
  
        
    }
//load registration page
    public function registration()
    {
        return view('auth.registration');
    }
      
    public function register(Request $request)
    {  
        //validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        Session::flash('message','You have signed-in');
        return redirect("Feeds");
    }

    //register function
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
   //saving personalized feeds and its datas 
    public function save_feed(Request $request)
    {
        $request->validate([
            'feed' => 'required',
        ]);
           
        $data = $request->all();
        $dat['feedurl']=$data['feed'];
        $f = FeedReader::read($data['feed']);
        if(!empty($f))
        {
            $dat['feed_title']=$f->get_title();
            $dat['user_id']=Auth::user()->id;
            $checkavail=DB::table('feed')->where($dat)->first();
            if(empty($checkavail))
            {
                $val=DB::table('feed')->insertGetId($dat);
                if($val!=0)
                {
                    $f = FeedReader::read($data['feed']);
                    $data['title']=$f->get_title();
                    $feeditems=$f->get_items();
                    if(!empty($feeditems))
                    {
                        $i=0;
                        foreach($feeditems as $item)
                        {
                            $res['title']=$item->get_title();
                            $res['links']=$item->get_link();
                            $res['description']=$item->get_content();
                            $get_save=DB::table('feed_list')->insertGetId($res);
                            if($get_save!=0)
                            $i++;
                        }
                    }
                    $result['total_feeds']=$i;
                    DB::table('feed')->where('id',$val)->update($result);
                    Session::flash('message','Successfully Added the feed to your list'); //<--FLASH MESSAGE

                }
                 else
                 Session::flash('message','Failed to add'); 

                 return redirect('add_feed');

            }else
            {
                Session::flash('message','You have already added the feed to your personal list'); 
                return redirect('dashboard');
            }
           
        }else
        {
            Session::flash('message','No feeds found in the url'); 
            return redirect('dashboard');
        }
    }    
    
    public function dashboard()
    {
        $data['page']=2;
        if(Auth::check()){
            $data['feed']= DB::table('feed')->where('user_id',Auth::user()->id)->get();
            
            return view('auth.dashboard',$data);
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    
     //feed listing
    public function Feeds() {
        $data['page']=1;
        if(Auth::check()){
            $data['count']=DB::table('feed')->sum('total_feeds');//get total count of feeds
            $data['feeds']=DB::table('feed_list')->get();//get all feeds saved
            return view('auth.rss_feed_list',$data);
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
       
    }


//logout function
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}