<?php
namespace App;
use Illuminate\Notifications\Notifiable ;
use Illuminate\Foundation\Auth\User as Authenticatable ;
use Overtrue\LaravelFollow\Traits\CanFollow ; 
use Overtrue\LaravelFollow\Traits\CanLike  ;

class User extends Authenticatable
{
  use Notifiable, CanFollow, CanLike ;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

/*    protected $fillable = [
      'full_name', 'username', 'email', 'password', 'role_id'
  ];
*/

/*  protected $casts = [ 
      'account_type' => bo
    ]*/

    protected $guarded = [] ;

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /*A student can post up to 3 papers only on free membership..*/
  public function papers()
  {
    return $this->hasMany(Paper::class,'posted_by','id');
  }


  public function loggedOnUser()
  {
    return auth()->user();
  }

  public function scopeStudents($query)
  {
    return $query->where('role_id','=',1);
  }

  public function scopeNonStudents($query)
  {
    return $query->whereIn('role_id',[2,3]);
  }


  public function followPaper($paperId)
  {
      // return $this->follow()
  }

    /**
    * a User can issue many activities to a paper.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function activityPapers()
    {

    return $this->belongsToMany(Paper::class,'paper_activities','creator_id','paper_id')
                ->withPivot('id','display_name','body','status')
                ->withTimestamps(); 
    }

    // a   user can issue so many activity types
    public function activityType()
    {
      return $this->belongsToMany(ActivityType::class,'paper_activities','creator_id','activity_type_id')
      ->withPivot('display_name','body','status'); 
    }


    /*tracking activities starts here..*/
    public function activities()
    {
      return $this->morphToMany(Activity::class,'activityable');
    }


   /**
    * User morphs many Photo.
    *
    * @return \Illuminate\Database\Eloquent\Relations\MorphMany
    */
   public function photos()
   {
     // morphMany(MorphedModel, morphableName, type = able_type, relatedKeyName = able_id, localKey = id)
     return $this->morphMany(Photo::class, 'imageable');
   }




    /**
     * User has one Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
  public function role()
  {
      // hasOne(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = id)
    return $this->belongsTo(Role::class,'role_id','id');
  }

  /**
  * Student connects to the users table...
  *
  * @return \Illuminate\Database\Eloquent\Relations\HasOne
  */
  public function student()
  {
    // hasOne(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = id)
    return $this->hasOne(Student::class,'user_id','id');
  }


  public function isStudent() {
    switch( $this->loggedOnUser()->role_id ) {
      case 1 : return true;
      default : return false  ; break ; 
    } 
  }


  
}
