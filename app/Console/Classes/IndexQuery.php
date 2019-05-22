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