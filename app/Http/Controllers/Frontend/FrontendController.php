<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Card;
use App\Models\Test;
use App\Repositories\FrontendRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    /**
     * The ProductRepository instance.
     *
     * @var \App\Repositories\front\FrontendRepository
     * 
     */
    protected $repository;



    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PageRepository $repository
     *
     */
    public function __construct(FrontendRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getIndex()
    {
        $name = 'ri khung';
        $ahihi = '{"error":0,"data":[{"tid":"5017 - 48678","description":"311447.110821.213735.15330734312-0353460723-ri khung","when":"2021-08-11 21:37:37","subAccId":"0291000285902","amount":20000,"cusum_balance":0,"guid":"vietcombank-0291000285902-2021081100006","orderOfTheDay":"20210811-00006","orderOfTheSecond":"20210811213737-001","hashDateDesAmount":"f486777a76f0aaf86a699e8de417992b","id":360056,"bank_sub_acc_id":"0291000285902"}]}';
        $res_json = json_decode($ahihi)->data[0];
        $key = array_search($name, explode('.',$res_json->description));
        $momo = explode('.',$res_json->description);
        $test_momo = explode('-',$momo[3]);
        dd(in_array($name, $test_momo));
        // dd(explode('.',$res_json->description)[$key]);
        return view('layout_index.index');
    }

    public function contact()
    {
        return view('layout_index.page.contact');
    }

    public function about()
    {
        return view('layout_index.page.about');
    }

    public function termOfUse()
    {
        return view('layout_index.page.terms_of_use');
    }

    public function privacy()
    {
        return view('layout_index.page.privacy');
    }

    public function signUp()
    {
        return view('layout_index.page.signup');
    }

    public function postSignup(RegisterRequest $request)
    {
        $sign_up = $this->repository->createUser($request);
        if ($sign_up == true) {
            $credentaials = array('email' => $request->email, 'password' => $request->password);
            if (Auth::attempt($credentaials)) {
                return redirect()->route('index')->with('message', '1');
            } else {
                return redirect()->back();
            }
        }
    }

    public function signIn()
    {
        return view('layout_index.page.signin');
    }

    public function postSignIn(LoginRequest $request)
    {
        $credentaials = array('email' => $request->email, 'password' => $request->password);
        if (Auth::attempt($credentaials)) {
            if (Auth::user()->banned_status == 0) {
                return redirect()->route('index')->with('message', '2');
            } else {
                Auth::logout();
                return redirect()->back()->with('message', '4');
            }
        } else {
            return redirect()->back()->with('message', '3');
        }
    }

    public function postLogout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function getCardToView()
    {
        $cards = Card::all();
        return view('layout_index.page.card', compact('cards'));
    }

    public function transtionInfo(Request $request)
    {
        $data = $request->all();
        $data1 = new Test();
        $data1->test = json_encode($data);
        $data1->save();
        // return view('user.transfer');
    }
}
