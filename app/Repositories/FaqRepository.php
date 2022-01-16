<?php

namespace App\Repositories;

use App\Models\Faq\Faq;
use App\Models\Faq\FaqTranslation;
use App\Repositories\Interfaces\FaqRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqRepository implements FaqRepositoryInterface{

    private $faq;
    private $faqTranslation;
    public function __construct(Faq $faq, FaqTranslation $faqTranslation)
    {
        $this->faq = $faq;
        $this->faqTranslation = $faqTranslation;
    }

    public function index()
    {
        $faq = Faq::orderBy('id','desc')->get();

        return view('admin.faq.index',compact('faq'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        try{
            /** transformation to collection */
            $allfaqs = collect($request->faq)->all();

            $request->is_active ? $is_active = true : $is_active = false;

            DB::beginTransaction();
            // create the default language's banner
            $unTransFaq_id = $this->faq->insertGetId([
                'is_active' => $request->is_active = 1
            ]);

            // check the Category and request
            if(isset($allfaqs) && count($allfaqs)){
                // insert other translation for Categories
                foreach ($allfaqs as $allfaq){
                    $transFaq_arr[] = [
                        'question' => $allfaq ['question'],
                        'local' => $allfaq['local'],
                        'answer' => $allfaq['answer'],
                        'faq_id' => $unTransFaq_id
                    ];
                }

                $this->faqTranslation->insert($transFaq_arr);
            }
            DB::commit();

            return redirect()->route('admin.faq')->with('success', 'Data added successfully');
        }catch(\Exception $ex){
            DB::rollback();
            // return $ex->getMessage();
            return redirect()->route('admin.faq.create')->with('error', 'Data failed to add');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);

        return view('admin.faq.edit',compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        if ( $faq->save()) {

            return redirect()->route('admin.faq')->with('success', 'Data updated successfully');

           } else {

            return redirect()->route('admin.faq.create')->with('error', 'Data failed to update');

           }
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);

        $faq->delete();

        return redirect()->route('admin.faq')->with('success', 'Data deleted successfully');
    }
}
