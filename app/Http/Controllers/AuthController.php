<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Hash;
use Session;
use Vedmant\FeedReader\Facades\FeedReader;
use App\Models\User;
use App\Models\Item;
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


         //feed listing
         public function Feeds() {
            $data['page']=1;
            $this->store();

            $response = Http::get('https://dev.shepherd.appoly.io/fruit.json');
            $data = $response->json();
            echo $this->createList($data['menu_items']);
        
        //return view('auth.rss_feed_list',$data);
         
        }


        function createList($data) {
     // create the list
            $list = '<ul>';
            foreach ($data as $item) {
                $list .= '<li>' . $item['label'];
                if (isset($item['children'])) {
                    $list .= $this->createList($item['children']);
                }
                $list .= '</li>';
            }
            $list .= '</ul>';
        
            return $list;
        }
        
        
        

        public function store()
{
    // fetch the data from the JSON feed
    $response = Http::get('https://dev.shepherd.appoly.io/fruit.json');
    $data = $response->json();

    // loop through the data and save it to the database
    foreach ($data['menu_items'] as $item) {
        $dbItem = new Item;
        $dbItem->name = $item['label'];
        if (isset($item['children'])) {
            // item has children, save them as well
            foreach ($item['children'] as $child) {
                $dbChild = new Item;
                $dbChild->name = $child['label'];
                $dbItem->children()->save($dbChild);
            }
        }
        $dbItem->save();
    }
}


    
    //logout function
        public function signOut() {
            Session::flush();
            Auth::logout();
      
            return Redirect('login');
        }


    }