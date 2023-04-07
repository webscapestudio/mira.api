<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutUsResource;
use App\Http\Resources\AdvantagesResource;
use App\Http\Resources\BannersResource;
use App\Http\Resources\ContactsResource;
use App\Http\Resources\HistoryResource;
use App\Http\Resources\InvestAdvantagesResource;
use App\Http\Resources\InvestmentResource;
use App\Http\Resources\InvestStrategiesResource;
use App\Http\Resources\ManifestoResource;
use App\Http\Resources\NewsResource;
use App\Http\Resources\PartnersResource;
use App\Http\Resources\SocialResource;
use App\Models\AboutUs;
use App\Models\Advantages;
use App\Models\Banners;
use App\Models\Contacts;
use App\Models\History;
use App\Models\InvestAdvantages;
use App\Models\Investment;
use App\Models\InvestStrategies;
use App\Models\Manifesto;
use App\Models\News;
use App\Models\Partners;
use App\Models\Social;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $banners = BannersResource::collection(Banners::all());
        $about_us =  AboutUsResource::collection(AboutUs::all());
        $advantages = AdvantagesResource::collection(Advantages::all());
        $history = HistoryResource::collection(History::all());
        $partners = PartnersResource::collection(Partners::all());
        $investing = InvestmentResource::collection(Investment::get());
        // $invest_advantages =InvestAdvantagesResource::collection(InvestAdvantages::all());
        // $invest_strategies =InvestStrategiesResource::collection(InvestStrategies::all());
        $manifesto = ManifestoResource::collection(Manifesto::get());
        $news = NewsResource::collection(News::all());
        $contacts =ContactsResource::collection(Contacts::get());

        return response()->json([
            'banners' => $banners,
            'latest_projects' => '',
            'about_us' => $about_us,
            'advantages' => $advantages,
            'history' => $history,
            'partners' => $partners,
            'investing' => $investing,
            // 'invest_advantages' => $invest_advantages,
            // 'invest_strategies' => $invest_strategies,
            'manifesto' => $manifesto,
            'news' => $news,
            'contacts' => $contacts,
        ]);
    }
}
