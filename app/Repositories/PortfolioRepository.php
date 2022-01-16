<?php

namespace App\Repositories;

use App\Models\Pcategory\Pcategory;
use App\Models\Pcategory\PcategoryTranslation;
use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioTranslation;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\PortfolioRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PortfolioRepository implements PortfolioRepositoryInterface{

    private $portfolio;
    private $portfolioTranslation;
    public function __construct(Portfolio $portfolio, PortfolioTranslation $portfolioTranslation)
    {
        $this->portfolio = $portfolio;
        $this->portfolioTranslation = $portfolioTranslation;
    }

    public function index()
    {
        $portfolio = Portfolio::orderBy('id','desc')->get();

        return view('admin.portfolio.index',compact('portfolio'));
    }

    public function create()
    {
        $categories = Pcategory::get();

        return view('admin.portfolio.create',compact('categories'));
    }

    public function store(Request $request)
    {
        try{
            /** transformation to collection */
            $allportfolioes = collect($request->portfolio)->all();

            $slug= $request->portfolio['English']['name'];

            $cover = $request->file('cover');
            if($cover){
            $cover_path = $cover->store('images/portfolio', 'public');
            // $coverName= 'images/banner'. 'public' . '/' .$cover-> getClientOriginalName();
            }

            $mobileImage = $request->file('mobileImage');
            if($mobileImage){
            $mobileImage_path = $mobileImage->store('images/portfolio', 'public');
            // $coverName= 'images/banner'. 'public' . '/' .$cover-> getClientOriginalName();
            }

            $request->is_active ? $is_active = true : $is_active = false;

            DB::beginTransaction();
            // create the default language's banner
            $unTransPortfolio_id = $this->portfolio->insertGetId([
                'slug' => $slug ,
                'pcategory_id' => $request['category'],
                'mobileImage' => $mobileImage_path,
                'cover' => $cover_path,
                'link' => $request['link'],
                'date' => $request['date'],
                'is_active' => $request->is_active = 1
            ]);

            // check the Category and request
            if(isset($allportfolioes) && count($allportfolioes)){
                // insert other translation for Categories
                foreach ($allportfolioes as $allportfolio){
                    $transPortfolio_arr[] = [
                        'name' => $allportfolio ['name'],
                        'local' => $allportfolio['local'],
                        'client' => $allportfolio['client'],
                        'desc' => $allportfolio['desc'],
                        'portfolio_id' => $unTransPortfolio_id
                    ];
                }

                $this->portfolioTranslation->insert($transPortfolio_arr);
            }
            DB::commit();

            return redirect()->route('admin.portfolio')->with('success', 'Data added successfully');
        }catch(\Exception $ex){
            DB::rollback();
            return $ex->getMessage();
            return redirect()->route('admin.portfolio.create')->with('error', 'Data failed to add');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $categories = Pcategory::get();

        return view('admin.portfolio.edit',compact('portfolio','categories'));
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            "category" => "required",
            "desc" => "required"
        ])->validate();

        $portfolio = Portfolio::findOrFail($id);
        $portfolio->pcategory_id = $request->category;
        $portfolio->name = $request->name;
        $portfolio->client = $request->client;
        $portfolio->desc = $request->desc;
        $portfolio->date = $request->date;

        // image desktop
        $new_cover = $request->file('cover');

        if($new_cover){
        if($portfolio->cover && file_exists(storage_path('app/public/' . $portfolio->cover))){
            Storage::delete('public/'. $portfolio->cover);
        }

        $new_cover_path = $new_cover->store('images/portfolio', 'public');

        $portfolio->cover = $new_cover_path;

        }

        // image mobile
        $new_mobileImage = $request->file('mobileImage');

        if($new_mobileImage){
        if($portfolio->mobileImage && file_exists(storage_path('app/public/' . $portfolio->mobileImage))){
            Storage::delete('public/'. $portfolio->mobileImage);
        }

        $new_mobileImage_path = $new_mobileImage->store('images/portfolio', 'public');

        $portfolio->mobileImage = $new_mobileImage_path;

        }

        if ($portfolio->save()) {

                return redirect()->route('admin.portfolio')->with('success', 'Data updated successfully');

               } else {

                return redirect()->route('admin.portfolio.edit')->with('error', 'Data failed to update');

               }
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->delete();

        return redirect()->route('admin.portfolio')->with('success', 'Data deleted successfully');
    }
}
