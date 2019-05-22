<?php 
namespace App\Utilities ;  
use App\Paper ; 

trait PaperActivities { 


  public function toggleLike($paper) {
    
    $toggleLikePaper = auth()->user()->toggleLike($paper);
    $collectStatus = collect($toggleLikePaper);
    
      // returns like
        /*Collection {#270
        #items: array:2 [
        "attached" => array:1 [
        0 => 27
        ]
        "detached" => []
        ]
      }*/			
      $attachedValue = $collectStatus->get('attached');
      $followableType = 'App\Paper' ;

              /*
              $likesCount = auth()->user()->likes(App\Paper::class)->where([
                    	['followable_id',$paper],
                    	['followable_type',$followableType],
                    ])->count();
                    */

                    
                  $likes = auth()->user()->likes(Paper::class)->where([
                   ['followable_id',$paper],
                   ['user_id',auth()->id()],
                   ['followable_type',$followableType],
                 ])->count();

                  dd($likes);

                  if ( count($attachedValue) == 0){
                   $noVal = 0 ; 
                   return response($noVal, 201);
                 }
                 else { 
                   $someVal = 1 ;
                   return response($someVal, 201);
                 }

       }


                 public function toggleFollow($paper)
                 {

                   $toggled = auth()->user()->toggleFollow($paper); 

                   $collectStatus = collect($toggled);

                   $attachedValue = $collectStatus->get('attached');


                   dd($attachedValue);


                   if ( count($attachedValue) == 0){
                    $noVal = 0 ; 
                    return response($noVal, 201);
                  }
                  else { 
                    $someVal = 1 ;
                    return response($someVal, 201);
                  }


                }

              }