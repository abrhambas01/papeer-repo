<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Auth ; 
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Overtrue\LaravelFollow\Traits\CanBeLiked ;

class Paper extends Model {

  use CanBeFollowed, CanBeLiked ;   

  protected $guarded = [];
  
  /**
  * Paper belongs to a publisher.
  *
  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
  */
  public function publisher()
  {
    return $this->belongsTo(User::class,'posted_by','id');
  }



  public function getActivitiesCountAttribute()
  {
    return $this->with('activityCreators')->count(); 
  }

  // this one's working now..
  
  // tracks activities for every users in papers.
  public function activityCreators()
  {

    return $this->belongsToMany(User::class,
      'paper_activities',
      'paper_id',
      'creator_id')
    ->withPivot('display_name','body','status')
    ->withTimestamps() ;
  }

  /*success here.*/
  public function activityTypes()
  {
    return $this->belongsToMany(ActivityType::class,
      'paper_activities',
      'paper_id',
      'activity_type_id')
    ->withPivot('creator_id','display_name','body','status')
    ->withTimestamps() ;
  }
  
  /**
   * Paper belongs to many Activities.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function activities()
  {
    // belongsTo(RelatedModel, foreignKey = activities_id, keyOnRelatedModel = id)
    return $this->belongsToMany(PaperActivity::class , 'paper_activities','paper_id','id')
    ->withPivot('display_name','body','status');
  }
  



  public static function returnsUserId(){
    return Auth::id() ;
  }

  // When using this -> papers model would return only entries that are what's inside the query automatically .
  protected static function boot()
  {

    parent::boot();

    static::addGlobalScope('popular', function ($builder) {
      $builder->where('likeCount','=',0);
    });

  }



  public function getLikeCountAttribute()
  {
      // we'll refer from this doc in the laravel-follow package.
    return auth()->user()->likes(Paper::class)->count();
  }





  public function school()
  {
    return $this->belongsTo(School::class,'school_id','id');
  }



  public function getTicketPriceInDollarsAttribute()
  {
    return number_format($this->ticket_price / 100, 2);
  }


  /**
   * A Paper has many Likes.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */

  /**
  * returns how many likes a paper has..
  */
  public function likesTally()
  {
    return $this->likesCount ; 
  }


  public function totalLikes()
  {
    return $this->sum('likesCount');
  }


  public static function postedByUser($user)
  {
    return static::where('posted_by','=',$user);
  }     

  public static function notFromTheLoggedOnUser($user)
  {
    return static::where('posted_by','!=',$user);
  }    

  /**
   * Unfollow the paper
   *
   * @param int|null $userId
   *
   */
  public function unfollow($userId = null)
  {
    $this->followers()
    ->where('user_id', $userId ?: auth()->id()) 
    ->delete();
  }

  public static function followedBy($user)
  {
    return static::where('posted_by','=',$user);
  } 

  public function scopeFromCurrentUser($query)
  {
    return $query->where('posted_by','=',auth()->id());
  }



  public function unlike()
  {
    $this->update([
      'likesCount' => $this->likesCount - 1 
    ]);
  }

  public function getOwnersNameAttribute()
  {
    return $this->owner->full_name ; 
  }

  public function followers()
  {
    return $this->belongsToMany(User::class,'follower_paper');
  }



  /*do not use this..*/
  public static function updateLikesCount($likeStatus, $paper_id)
  {
    if ( $likeStatus == true ){
      $this->increment('likesCount',1)->where("id",$paper_id) ;
    }
    else {
      $this->decrement('likesCount',1)->where("id",$paper_id) ;
    }
  }

  protected function recordPublishActivity($paper)
  {
    return $this->activities()->create([
      'paper_id' => $user_id , 
      'creator_id' => auth()->id() , 
      'activity_type_id' => 5 , 
      'display_name' => null , 
      'body' => null , 
      'status' => 0 
    ]); 

  }


  public static function publish($request)
  {
    $publishPaper =  $this->firstOrCreate([
      'posted_by'             => auth()->id(),
      'title'                 => $request->get('research_title'),
      'research_description'  => $request->get('research_description'),
      'abstract'              => $request->get('abstract'),
      'school_id'             => $request->get("school_id"),
      'likeCount'             => 0 ,
      'followersCount'        => 0,
      'attachment'            => $request->get()->file('attachment')->store('papers', 'public'),
      'attachment_link'       => $request->get("attachment_link")
    ]);


    $this->recordPublishActivity($publishPaper); 


  }


  // [
  //                'posted_by'              => auth()->user()->id,
  //                'title'                  => request('research_title'),
  //                'research_description'   => request('research_description'),
  //                'abstract'               => request('abstract'),
  //                'school_id'              => request("school_id"),
  //                'likesCount'             =>  0 ,
  //                'followersCount'         =>  0,
  //                'attachment'             => request()->file('attachment')->store('papers', 'public'),
  //                'attachment_link'        => request("attachment_link")
  //            ]


  /*
  used for inserting to the server..
  else {  

  if (request()->hasFile("attachment")) {      

  // insert the records to the server including the file
  $paper =  Paper::create([
  'posted_by'       => auth()->user()->id,
  'title'           => request('research_title'),
  'research_description' => request('research_description'),
  'abstract'        => request('abstract'),
  'school_id'       => request("school_id"),
  'likeCount' =>        0 ,
  'followersCount' => 0,
  'attachment'      => request()->file('attachment')->store('papers', 'public'),
  'attachment_link' => request("attachment_link")
  ]);


  return redirect()->route('papers.show',$paper->path())
  ->with('errors','Your paper has been published and is ready to be reviewed by our research experts.');


  }
  else { 
  return redirect()->back()->withErrors();
  }
}*/


}
