<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Auth ; 
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Overtrue\LaravelFollow\Traits\CanBeLiked ;
use Illuminate\Http\Request ; 

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



  public function deletePaper()
  {

  }


  public function student()
  {
    return $this->belongsTo(Student::class,'user_id','id');
  }



  public function getActivitiesCountAttribute()
  {
    return $this->with('activityCreators')->count(); 
  }

  /**
 * get all activities for the paper
 *
 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
 */
  public function activities()
  {
// morphMany(MorphedModel, morphableName, type = able_type, relatedKeyName = able_id, localKey = id)
    return $this->morphToMany(Activity::class, 'activityable');
  }

  // this one's working but we're not using this many to many relationships since** it's more easy to just use polymorphic relationships..
  // tracks activities for every users in papers.
 /* public function activityCreators()
  {

    return $this->belongsToMany(User::class,'paper_activities',
      'paper_id',
      'creator_id')
    ->withPivot('id','display_name','body','status')
    ->withTimestamps();
  }*/


  // success here.
/*  public function activityTypes()
  {
    return $this->belongsToMany(ActivityType::class,
      'paper_activities',
      'paper_id',
      'activity_type_id')
    ->withPivot('creator_id','display_name','body','status')
    ->withTimestamps() ;
  }*/


  public function setPublisherNameAttrbute()
  {
    return $this->publisher->full_name ; 
  }

  
  /**
   * Paper belongs to many Activities.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
 /* public function activities()
  {
    // belongsTo(RelatedModel, foreignKey = activities_id, keyOnRelatedModel = id)
    return $this->belongsToMany(PaperActivity::class , 'paper_activities','paper_id','id')
    ->withPivot('display_name','body','status');
  }*/
  



  public static function returnsLoggedOnUsersId(){
    return Auth::id() ;
  }

  // When using this -> papers model would return only entries that are what's inside the query automatically .
  /*protected static function boot()
  {

    parent::boot();

    static::addGlobalScope('popular', function ($builder) {
      $builder->where('likeCount','=',0);
    });

  }
*/


  public function setLikeCountAttribute()
  {
      // we'll refer from this doc in the laravel-follow package
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



  /**
   * Paper morphs many Photo.
   *
   * @return \Illuminate\Database\Eloquent\Relations\MorphMany
   */
  public function photos()
  {
    // morphMany(MorphedModel, morphableName, type = imageable_type, relatedKeyName = imageable_id, localKey = id)
    return $this->morphMany(Photo::class, 'imageable');
  }

  public static function publish(Request $requestData)
  {
    $paper =   auth()->user()->papers()->create(['posted_by' => auth()->id(),
      'title'                 => $requestData->get('research_title'),
      'research_description'  => $requestData->get('research_description'),
      'abstract'              => $requestData->get('abstract'),
      'school_id'             => $requestData->get("school_id"),
      'likeCount'             => 0 ,
      'followersCount'        => 0,
      'attachment'            => $requestData->file('attachment')->store('papers', 'public'),
      'attachment_url'       =>  $requestData->get("attachment_link")
    ]);

    $fileInfo = pathinfo($paper->attachment);

    $fileName = $fileInfo['basename'];

    $paper->photos()->create([
      'image_file' => $fileName , 
      'imageable_id' => $paper->id, 
      'imageable_type' => 'App\Paper'
    ]);

    return $paper ; 

  // we can record this published activity..                    
  //  $this->recordPublishActivity($publishPaper); 


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
