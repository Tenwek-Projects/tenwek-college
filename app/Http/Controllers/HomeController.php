<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Support\Seo\SeoPresenter;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(Request $request): View
    {
        $seo = SeoPresenter::build($request, [
            'title' => 'Tenwek Hospital College – The Tenwek Hospital',
            'description' => 'Welcome to Tenwek Hospital College. Two schools, one calling: forming health workers and chaplains to serve the whole person. Choose a school to continue.',
            'faq' => [
                [
                    'question' => 'What is Tenwek Hospital College?',
                    'answer' => 'Tenwek Hospital College is the academic arm of Tenwek Hospital, offering nursing and health sciences programmes alongside chaplaincy formation, grounded in compassionate, Christ-minded service.',
                ],
                [
                    'question' => 'Where is Tenwek Hospital College located?',
                    'answer' => 'The college is located in Bomet County, Kenya, alongside Tenwek Hospital - a Level 5 teaching and referral mission hospital.',
                ],
            ],
        ]);

        $schools = School::query()->where('is_active', true)->orderBy('sort_order')->get();

        return view('home', compact('seo', 'schools'));
    }
}
