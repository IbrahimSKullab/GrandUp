<?php

namespace App\Http\Resources\Poll;

use DB;
use App\Models\User;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PollResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'questions' => $this->questions->map(function ($question) {
                $answers = DB::table('poll_answers')->where('poll_question_id', $question->id)->count();

                $total = DB::table('poll_answers')->where('poll_id', $this->id)->count();

                $is_chosen_answer_by_auth_user = false;

                $authUser = Helper::getAuthUserFromAccessToken();

                if ($authUser) {
                    if ($authUser instanceof User) {
                        $is_chosen_answer_by_auth_user = DB::table('poll_answers')
                            ->where('user_id', $authUser->id)
                            ->where('poll_id', $this->id)
                            ->where('poll_question_id', $question->id)
                            ->exists();
                    } else {
                        $is_chosen_answer_by_auth_user = DB::table('poll_answers')
                            ->where('seller_id', $authUser->id)
                            ->where('poll_id', $this->id)
                            ->where('poll_question_id', $question->id)
                            ->exists();
                    }
                }

                return [
                    'id' => $question->id,
                    'title' => $question->title,
                    'answer_percentage' => $total == 0 ? 0 : (($answers / $total) * 100),
                    'is_chosen_answer_by_auth_user' => $is_chosen_answer_by_auth_user,
                ];
            }),
        ];
    }
}
