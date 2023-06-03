<?php

namespace App\Services\Poll;

use DB;
use App\Models\Poll;
use App\Models\PollQuestion;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class pollServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Poll::query()->latest()->get();
    }

    public function getEnabled(): Collection
    {
        return Poll::query()->where('status', 1)->latest()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return Poll::query()->where('status', 1)->findOrFail($id);
        }

        return Poll::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $poll = Poll::query()->create([
                'title' => $request->title,
            ]);

            foreach ($request->questions as $question) {
                PollQuestion::query()->create([
                    'poll_id' => $poll->id,
                    'title' => $question['title'],
                ]);
            }
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $poll = $this->findById($id);

            $poll->update([
                'title' => $request->title,
            ]);

            $poll->refresh();

            $questionIds = $poll->questions()->pluck('id')->toArray();

            $requestQuestions = array_keys($request->questions);

            $diff = array_values(array_diff($questionIds, $requestQuestions));

            $poll->questions()->whereIn('poll_questions.id', $diff)->delete();

            foreach ($request->questions as $key => $value) {
                $question = PollQuestion::query()->where('poll_id', $poll->id)->where('id', $key)->first();

                if ($question) {
                    $question->update([
                        'title' => $value['title'],
                    ]);
                } else {
                    PollQuestion::query()->create([
                        'poll_id' => $poll->id,
                        'title' => $value['title'],
                    ]);
                }
            }
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $poll = $this->findById($id);

            $poll->delete();
        });
    }
}
