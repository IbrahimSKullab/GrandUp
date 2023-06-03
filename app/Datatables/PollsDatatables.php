<?php

namespace App\Datatables;

use DB;
use App\Models\Poll;
use App\Helper\Helper;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class PollsDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'title' => ['title->ar'],
            'number_of_answers',
            'number_of_questions',
            'status',
            'created_at',
            'updated_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('title', function (Poll $poll) {
                return $poll->title;
            })
            ->addColumn('number_of_answers', function (Poll $poll) {
                return DB::table('poll_answers')->where('poll_id', $poll->id)->count();
            })
            ->addColumn('number_of_questions', function (Poll $poll) {
                return $poll->questions()->count();
            })
            ->addColumn('status', function (Poll $poll) {
                return (new DataTableActions())
                    ->model($poll)
                    ->modelId($poll->id)
                    ->checkStatus($poll->status)
                    ->switcher();
            })
            ->addColumn('created_at', function (Poll $poll) {
                return Helper::formatDate($poll->created_at);
            })
            ->addColumn('updated_at', function (Poll $poll) {
                return Helper::formatDate($poll->updated_at);
            })
            ->addColumn('action', function (Poll $poll) {
                return (new DataTableActions())
                    ->show(route('admin.polls.show', $poll->id))
                    ->edit(route('admin.polls.edit', $poll->id))
                    ->delete(route('admin.polls.destroy', $poll->id))
                    ->make();
            })
            ->rawColumns(['action','status'])
            ->make();
    }

    public function query(Request $request)
    {
        return Poll::query()
            ->latest()
            ->when($request->filled('status') && $request->status === StatusEnum::INACTIVE->value, function ($query) {
                $query->disabled();
            })
            ->select('*');
    }
}
