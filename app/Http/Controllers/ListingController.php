<?php

namespace App\Http\Controllers;

use App\Category;
use App\Click;
use App\Http\Middleware\ClickSession;
use App\Province;
use App\Ad;
use App\User;
use App\UserTransaction;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('city_id', $request->input('city_id'))
            ->where('type', User::TYPE_PARTNER)
            ->whereHas('categories', function($query) use($request) {
                $query->where('category_id', $request->input('category_id'));
            })
            ->where('activated', true)
            ->where('verified', true)
//            ->where('balance', '>=', 0)
            ->paginate();

        $categories = Category::where('parent_id', 0)
            ->with(['children'])
            ->get();

        $provinces = Province::with(['cities'])->get();

        return view('listing.index', [
            'users' => $users,
            'categories' => $categories,
            'provinces' => $provinces,
        ]);
    }

    public function show(Ad $service)
    {
        $service->load([
            'user',
            'city:id,name,province_id',
            'city.province:id,name',
            'category',
        ]);

        $seoKeywords = $this->keywordBuilder($service);

        return view('listing.show', [
            'service' => $service,
            'keywords' => $seoKeywords,
            'description' => $service->description,
        ]);
    }

    private function keywordBuilder(Ad $service)
    {
        $keywords = [];

        $keywords[] = $service->category->name;
        $keywords[] = $service->category->name." di ".$service->city->name;

        return implode(', ', $keywords);
    }

    public function contact(Ad $service, $type)
    {
        $service->load('user');

        $validTypes = [
            'wa' => [
                'uri' => "https://wa.me/",
                'content' => 'contact_whatsapp',
            ],
            'tg' => [
                'uri' => "https://t.me/",
                'content' => 'contact_telegram',
            ],
            'phone' => [
                'uri' => "tel:",
                'content' => 'contact'
            ],
        ];

        if (!in_array($type, array_keys($validTypes)))
        {
            return route('home', ['error' => 11])->with('danger', "Informasi kontak tidak diketahui");
        }

        $fee = $service->category->price;

        if ($service->user->balance >= $fee)
        {
            // get current session
            $session = session('tsocks');

            // count if this session clicked this lately?
            $clicksLately = Click::where('session', $session)->where('service_id', $service->id)
                ->where('created_at', '>', now()->subHours(6))
                ->count();

            if ($clicksLately == 0)
            {
                $service->user->balance = $service->user->balance - $fee;
                UserTransaction::executeTransaction($service->user_id, $fee * -1, "Pembayaran", UserTransaction::TYPE_FEE);

                Click::create([
                    'service_id' => $service->id,
                    'session' => $session,
                    'fee' => $fee,
                    'user_id' => auth()->id(),
                    'data' => [
                        'ip_address' => \request()->ip(),
                        'agent' => \request()->userAgent(),
                    ]
                ]);
            }


            $userContent = $validTypes[$type]['content'];
            $uri = $validTypes[$type]['uri'];

            return redirect($uri.$service->user->$userContent);
        }
        else {
            return redirect()->route('listing.show', [$service->user])
                ->with('danger', "Tidak dapat menghubungi mitra saat ini");
        }
    }
}
