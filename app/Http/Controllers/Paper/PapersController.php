<?php namespace App\Http\Controllers\Paper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Paper ; 
use App\School ; 
use App\User ;
use DB ; 
use App\utilities\Uploads ;    

class PapersController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $papers = Paper::latest()->paginate(8);
        return view('papers.index',compact("papers"));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $schools = School::select('id','name')->get(); 
        return view("papers.create",['schools' => $schools]);
    }


    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store()
    {
// https://docs.google.com/document/d/1i6Ta9OLy8LyDH5CGDOU54Q8eC1TZ3bb6rmB34Yp_oxM/edit

    // validate the request..
        $req = $this->validate(request(), [
            'research_title'                 => 'required|max:40|min:3',
            'research_description'           => 'required|min:15|max:100',
            'abstract'                       => 'required',
            'school_id'                      => 'required|numeric',
            'banner_picture'                 => 'required|mimes:jpeg,png',
            'attachment'                     => 'required|mimes:pdf,doc',
        ]);


        $userId = auth()->user()->id ; 

        $papersCount = Paper::where('posted_by','=',$userId)->count() ;

    // getting the account_type
        $account_type  = auth()->user()
                               ->where("id",$userId)
                               ->value('account_type');


        // dd(request());
        // if he has a standard user / student / free account
        if ($account_type === "0") {
            if ( $papersCount < 3 ) {
                if (is_array($req)){
                    // paper can now be published and also record the activity of that user...


                    $paper = Paper::publish(request());

                    $response = "Your paper has been published and is ready to be reviewed by the community.";

                    return response(['Data' =>$response,'Paper'=> $paper], 201);
                }
                else { 
                    return response("not",500);
                }


                // return response()->json(['response' => $response,201]) ; 
            }
            else { 
                $response = "You are not allowed to publish more papers, please upgrade your account";
                abort(403, $response);
                // return response()->json(['response' => $response,403]) ; 
                // return response()->json($response, 403);
            }
        }
        // he's a paid user..
        else {
      // just publish the paper.. automatically
          $res = Paper::publish(request()); 
          return response($res, 201);
      }

  }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $paper = Paper::with('photos')->findOrFail($id);
        return view('papers.show', ['paper' => $paper]);
    }

    
    /**
    * Show the form for editing the specified resource.
    *
* @param  int  $id
    * @return \Illuminate\Http\Response
    */
public function edit($id)
{
    $user = Paper::fromCurrentUser()->findOrFail($id);
    return view('papers.edit',['user' => $user]);

}


    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update($id)
    {
        $paper = Paper::findOrFail($id);



    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Paper $paper)
    {

        $deleteStatus = $paper->delete();
        return response($deleteStatus);
    }


    public function deletePapersWhoHaveMoreThanTwoRecords()
    {

         // delete papers hwo have more than 2 entries in the papers.. .
        // Paper::where("posted_by","=")


    }



    /*Show the posted papers of the logged on user*/
    public function postedPapers($user)
    {
        $postedPapers = Paper::postedByUser($user)->get() ; 
     
        return view("papers.posted",[
            'papers' => $postedPapers
        ]);

    }

    public function followedPapers($user)
    {
        $postedPapers = Paper::followedBy($user)->get() ; 

        return view("papers.followed",[
            'papers' => $postedPapers
        ]);

    }

    public function deletePaper()
    {
        $paperId = request()->get('id');

        return response()->json($paperId);
    }


    public function recommendPapers($paper)
    {
        return view("papers.recommend");
    }
}
