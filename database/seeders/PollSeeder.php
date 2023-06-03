<?php

namespace Database\Seeders;

use App\Models\Poll;
use App\Models\PollQuestion;
use Illuminate\Database\Seeder;

class PollSeeder extends Seeder
{
    public function run()
    {
        $polls = [
            [
                'title' => [
                    'ar' => 'ما هو رأيك بنوعية الكلج الديلوكس الجديد؟',
                    'en' => 'What do you think of the quality of the new deluxe clutch?',
                ],
                'questions' => [
                    [
                        'title' => [
                            'ar' => 'سئ',
                            'en' => 'Bad',
                        ],
                    ],
                    [
                        'title' => [
                            'ar' => 'جيد',
                            'en' => 'Good',
                        ],
                    ],
                    [
                        'title' => [
                            'ar' => 'ممتاز',
                            'en' => 'Very Good',
                        ],
                    ],
                    [
                        'title' => [
                            'ar' => 'رائع',
                            'en' => 'Fanatics',
                        ],
                    ],
                ],
            ],
            [
                'title' => [
                    'ar' => 'هل تفضل الكلج بصورة عامة سادة ام مشرح ؟',
                    'en' => 'Do you prefer slugs in general, plain or sliced?',
                ],
                'questions' => [
                    [
                        'title' => [
                            'ar' => 'سادة',
                            'en' => 'plain',
                        ],
                    ],
                    [
                        'title' => [
                            'ar' => 'مشرح',
                            'en' => 'sliced',
                        ],
                    ],
                    [
                        'title' => [
                            'ar' => 'كليهما',
                            'en' => 'Both of them',
                        ],
                    ],
                ],
            ],
        ];

        foreach ($polls as $poll) {
            $createdPoll = Poll::query()->create([
                'title' => $poll['title'],
            ]);
            foreach ($poll['questions'] as $question) {
                PollQuestion::query()->create([
                    'poll_id' => $createdPoll->id,
                    'title' => $question['title'],
                ]);
            }
        }
    }
}
