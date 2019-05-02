<?php namespace App\Queries;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
class CommentIndexQuery
{
    /** @var Request */
    protected $request;
    public function get(Request $request, User $user)
    {
        $this->request = $request;
        return $this->mergePinedAndNotPined(
            $this->getNotPined($user),
            $this->getPined($user)
        );
    }
    protected function getNotPined(User $user): Paginator
    {
        $itemsPerPage       = $this->request->get('itemsPerPage', 20);
        $filterBySearchTerm = $this->request->get('filterBySearchTerm', "");
        $filterByAccount    = $this->request->get('filterByAccount', 0);
        $hideSelfComments   = $this->request->hideSelfComments == 'true' ? true : false;
        // beware! megaQuery is coming!..
        return $user->comments()
                    ->with('replies')       
                    ->wherePined(false)
                    ->where('reply_to_comment_id', null)
                    ->when($filterByAccount, function ($q) use ($filterByAccount) {
                        $q->where('account_id', $filterByAccount);
                    })
                    ->when($filterBySearchTerm, function ($q) use ($filterBySearchTerm) {
                        // group this two conditions together (... AND ...)
                        // something like SELECT ... WHERE account_id = 1 AND (text like '%test%' OR commenter_name like '%test%') AND ...
                        $q->where(function ($inner_query) use ($filterBySearchTerm) {
                            $inner_query->where('text', 'like', "%$filterBySearchTerm%")
                                        ->orWhere('commenter_name', 'like', "%$filterBySearchTerm%");
                        });
                    })
                    ->when($hideSelfComments === true, function ($q) use ($user) {
                        $self_acc_ids = $user->accounts()->select(['insta_user_id'])->get()->pluck('insta_user_id');
                        $q->whereNotIn('commenter_id', $self_acc_ids);
                    })
                    ->paginate($itemsPerPage);
    }
    protected function getPined(User $user): Collection
    {
        return $user->comments()
                    ->with('replies')
                    ->wherePined(true)
                    ->get();
    }
    protected function mergePinedAndNotPined(Paginator $comments_not_pined_paginator, Collection $comments_pined)
    {
        return $comments_not_pined_paginator->setCollection(
            $comments_not_pined_paginator
                ->getCollection()
                ->merge($comments_pined)
        );
    }
}


/**
 * 
 */
class Controller {

    public function index(Request $request)
    {
        return app(CommentIndexQuery::class)
        ->get($request, User::current());
    }
}