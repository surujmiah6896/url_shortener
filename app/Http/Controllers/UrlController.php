<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UrlCreateRequest;
use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function createUrl(){
        return view('url.create');
    }

    public function storeUrl(UrlCreateRequest $request){

        if(urlExist($request)){
            return back()->with('error', "This url is exits!");
        }

        $originalUrl    =  $request->original_url;
        $shortenedUrl   =  $this->generateShortUrl();

       try{

            Url::create([
                'user_id' => auth()->id(),
                'original_url' => $originalUrl,
                'shortened_url' => $shortenedUrl,
            ]);

       }catch(\Exception $e){
            return back()->with('error', $e);
       }
            return redirect()->route('url.create')->with('shortenedUrl', $shortenedUrl);
    }

    private function generateShortUrl()
    {
        return appUrl(Str::random(8));
    }


    public function redirect($shortenedUrl)
    {
        $url = Url::where('shortened_url', appUrl($shortenedUrl))->first();

        if ($url) {

            try {
                $url->url_click = $url->url_click + 1;
                $url->save();

                return redirect($url->original_url);

            } catch (\Throwable $th) {
                return abort(404);
            }

        }
        return abort(404);
    }


    public function deleteUrl(Url $url){

        if($url){

            $url->delete();
            return back()->with('delete', "Url Deleted Successfully!");

        }
        return back();
    }
}
