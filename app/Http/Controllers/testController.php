<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestMail;
use App\Test1;
use Auth;

class testController extends Controller
{
    public function getData(Request $request)
    {
        $user = Auth::user();
        $email = $user->email;
       
        $request->validate([
           'name'=>'required',
           'name_bangla'=>'required',
           'description'=>'required',
        ]);
        
        $uploadImage= $request->file('image');
        $imageWithExt = $uploadImage->getClientOriginalName();
        $imageName = pathinfo($imageWithExt,PATHINFO_FILENAME);
        $imageExt = $uploadImage->getClientOriginalExtension();
        $image = $imageName . time() . "." . $imageExt;
        
        $request->image->move(public_path('/images'),$image);
        
       

        $post=Test1::create([
            'name'=>$request->name,
            'name_bangla'=>$request->name_bangla,
            'description'=>$request->description,
            'image'=>$image,
           
        ]);

        // $details = [
        //     'title'=>'Congratulations',
        //     'body' =>'You are selected for room no: 101 in Jatir Pita Bangabandhu Sheikh Mujibur Rahman Hall NSTU'
        // ];
        // \Mail::to($email)->send(new TestMail($details));
        

        return redirect()->back()->with('success','Successful.');
    }

    //delete article
    public function delArticle($id)
    {
        $article= Test1::find($id);
       
       if($article){
           $article->delete();
           return "Success";
       }else{
           return Response::json(['error'=>'not found'], 404);
       }
    }

    //edit article
    public function getArticle($id)
    {
        
        $editArticle = Test1::findOrFail($id);
        
        if($editArticle){
            return $editArticle;
        }else{
            return Response::json(['error' => 'Not Found'],404);
        }
    }

     // update announcement
     public function updateArticle(Request $request)
     {
             $request->validate([
                 'edit_name' => 'required',
                 'edit_name_bangla' => 'required',
                 'edit_description' => 'required',
             ]);
 
             $updateArticle = Test1::find($request->article_id);
             $storeImage = $updateArticle->image;
 
                 if($request->has('edit_image')){
                     
                     $path='/images';
                     $image= $updateArticle->image;
                     $this->deleteImage($path,$image);
 
                     $uploadImage= $request->file('edit_image');
                     $imageWithExt = $uploadImage->getClientOriginalName();
                     $imageName = pathinfo($imageWithExt,PATHINFO_FILENAME);
                     $imageExt = $uploadImage->getClientOriginalExtension();
                     $storeImage = $imageName . time() . "." . $imageExt;
                     
                     $request->edit_image->move(public_path('/images'),$storeImage);
                 }
 
                 $updateArticle->image = $storeImage;
                 $updateArticle->name = $request->edit_name;
                 $updateArticle->name_bangla = $request->edit_name_bangla;
                 $updateArticle->description = $request->edit_description;
                 $updateArticle->save();
   
 
                 return "Success";
 }
 
 //end update article

 //delete image function
 public function deleteImage($path,$image)
 {
     if(file_exists(public_path().$path.$image)){
     unlink(public_path().$path.$image);
     }
 }

}
