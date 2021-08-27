<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Card;
use App\Models\CardType;
use App\Models\Discount;
use App\Models\SubCardType;
use App\Models\Test;
use App\Models\User;
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
        $partners = $this->repository->getPartners();
        return view('layout_index.index', compact('partners'));
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

    public function news()
    {
        $news = $this->repository->getNews();
        return view('layout_index.page.news', compact('news'));
    }

    public function newsDetail($id)
    {
        $news_detail = $this->repository->getNewsDetail($id);
        $news_other = $this->repository->getNewsOther();
        $this->repository->countView($id);
        $views_news = $this->repository->getHighestViews();
        return view('layout_index.page.news_detail', compact('news_detail', 'news_other', 'views_news'));
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

    public function CheckDiscountCode(Request $request)
    {
        if ($request->ajax()) {
            $discount_value_code = Discount::where('code', $request->discount_code)
                ->where('status', 0)
                ->first();
            if ($discount_value_code != null) {
                $code = number_format($discount_value_code->price);
                $type = $discount_value_code->discount_type;
                return response()->json([
                    'success' => true,
                    'discount' => $code,
                    'type' => $type
                ]);
            } else {
                return response()->json([
                    'success' => false,
                ]);
            }
        }
    }

    public function LiveSearchCard(Request $request)
    {
        if ($request->ajax()) {
            $output = null;
            $query = $request->key;
            if ($query != '') {
                $data = Card::where('name', 'like', '%' . $query . '%')
                    ->get();
                foreach ($data as $d) {
                    $sub_card = SubCardType::find($d->sub_card_type_id);
                    $d->sub_card_name = str_replace(' ', '', $sub_card->name);
                }
            } else {
                $data = Card::all();
                foreach ($data as $d) {
                    $sub_card = SubCardType::find($d->sub_card_type_id);
                    $d->sub_card_name = str_replace(' ', '', $sub_card->name);
                }
            }
            if (count($data) > 0) {
                foreach ($data as $dt) {
                    $cate = "cate('$dt->id', '$dt->name')";
                    $output .= '<li id="cateId_' . $dt->id . '" class="cateId  ' . $dt->card_type . ' ' . $dt->sub_card_name . '">
                    <a href="#" onclick="' . $cate . '" class="cate" id="' . $dt->id . '">
                    <img class="lazyload" src="' . asset($dt->image) . '" style="max-width:85px; height: 50px;" alt="">
                    </a>
                    </li>';
                }
            }
            return response()->json([
                'success' => true,
                'data_ul' => $output,
            ]);
        }
    }

    public function getCardToView()
    {
        $cards = Card::all();
        $card_type = CardType::all();
        $arr_sub_card_type = [];
        $sub_card_type_all = SubCardType::all();
        $i = 0;
        foreach ($sub_card_type_all as $sub_type) {
            foreach ($card_type as $type) {
                if ($sub_type->card_type_id == $type->id) {
                    $arr_sub_card_type[$type->name . '-' . $i++] =  $sub_type->name;
                }
            }
        }
        return view('layout_index.page.card', compact('cards', 'card_type', 'arr_sub_card_type', 'sub_card_type_all'));
    }

    public function transtionInfo(Request $request)
    {
        $res_json = $request->data[0];
        $data = new Test();
        $data->test = json_encode($res_json);
        $data->save();
        $this->repository->Test($data->test, $data->id);
    }
}
