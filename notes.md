 > A school has many students(user) and each student(user) has many papers
 skills -> jiujitsu, taekwondo, hand to hand, ardigma
 what if we want to get the schools's list of papers

 ```sql
 schools
 id           - integer
 display_name - string
 motto        - string

 students
 user_id - integer (user_id)
 school_id - integer
 full_name - string

 paper
 id - integer
 group_member_id(group_members) - integer    
 skill_name - string
 ```

 Table Structure

 Polymorphic relations allow a model to belong to more than one other model on a single association. For example, imagine users of your application can "comment" both posts and videos. Using polymorphic relationships, you can use a single comments table for both of these scenarios. First, let's examine the table structure required to build this relationship:

 ```sql
---------
 posts
-----------
 id - integer
 title - string
 body - text

 videos
 id - integer
 title - string
 url - string

 comments
 id - integer
 body - text
 commentable_id - integer
 commentable_type - string
 ```

 > Two important columns to note are the commentable_id and commentable_type columns on the comments table. The commentable_id column will contain the ID value of the post or video, while the commentable_type column will contain the class name of the owning model. The commentable_type column is how the ORM determines which "type" of owning model to return when accessing the commentable relation.

 Model Structure

 Next, let's examine the model definitions needed to build this relationship:

 ```php
 <?php

 namespace App;

 use Illuminate\Database\Eloquent\Model;

 class Comment extends Model
 {
    /**
    * Get all of the owning commentable models.
    */
    public function commentable()
    {
        return $this->morphTo();
    }
}
```

```php
class Post extends Model
{
    /**
    * Get all of the post's comments.
    */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}

class Video extends Model
{
    /**
    * Get all of the video's comments.
    */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}

```


## Next Note

1. we want to find all the books that have more than 120 pages and the word Book in the title, or all the books that have less than 200 pages and an empty description.


```php
Route::get('book_get_where_more_complex', function(){
$results = \App\Book::where(function($query){ 
$query->where('pages_count', '>', 120)
->where('title', 'LIKE', '%Book%');
})->orWhere(function($query){
$query->where('pages_count', '<', 200)
->orWhere('description', '=', '');
})->get();          
return $results;
});
```


> These are the parameters for the laravel-follow..
```php
public function params()
{
    # code...
    $user->follow(1); // targets: 1, $class = App\User
    $user->follow(1, App\Post::class); // targets: 1, $class = App\Post
    $user->follow([1, 2, 3]); // targets: [1, 2, 3], $class = App\User

    // Model
    $post = App\Post::find(7);
    $user->follow($post); // targets: $post->id, $class = App\Post

    // Model array
    $posts = App\Post::popular()->get();
    $user->follow($posts); // targets: [1, 2, ...], $class = App\Post

}
```


> Basic collection


```php
// i used collections here just for return purposes....
$values = collect([
'user_id' => $userId , 
'activityId' => $activityId,
'paperId' => $paper_id, 

```

PapersActivitiesController@returnsActivityForStudent

```php
Paper::where('posted_by','=',$userId)->whereHas('activityCreators',function($query){
$query->groupBy('id')->with('activityCreators','activityTypes');
})->get();  
```

```php
protected function getNotPined(User $user) : Paginator
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
```

```php
$p = $papers->flatMap->activityCreators;

// is equal to:
$papers->flatMap(function ($paper) {
return $paper->activityCreators;
});

or equal to..

// is equal to:
$papers->map(function ($paper) {
return $paper->activityCreators;
})->collapse(); // or flatten(1)

// looking now into flatMap implementation:
return $this->map($callback)->collapse();
```

// when eager loading
```php
$school = School::with(['students' => function ($q) {
  $q->orderBy('whateverField', 'asc/desc');
}])->find($schoolId);

// when lazy loading
$school = School::find($schoolId);
$school->load(['students' => function ($q) {
  $q->orderBy('whateverField', 'asc/desc');
}]);

// or on the collection
$school = School::find($schoolId);
// asc
$school->students->sortBy('whateverProperty');
// desc
$school->students->sortByDesc('whateverProperty');


// or querying students directly
$students = Student::whereHas('school', function ($q) use ($schoolId) {
  $q->where('id', $schoolId);
})->orderBy('whateverField')->get();```