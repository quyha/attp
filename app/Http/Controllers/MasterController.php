<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App;
use DB;

class MasterController extends Controller
{
	    
    public function get($locale){		    	
    	App::setLocale($locale);

    	$data['hot_news1'] = DB::table('tbl_news')->where('c_lang',App::getLocale())->orderBy('pk_news_id','desc')->first();
    	if($data['hot_news1']!=null){
	    	$data['hot_news1']->c_category_news==1 ? $data['cate_hot_news1']='tin-trong-nuoc' : $data['cate_hot_news1']='tin-quoc-te';	    
		}

    	$data['hot_news2'] = DB::table('tbl_science')->where('c_lang',App::getLocale())->orderBy('pk_science_id','desc')->first();

    	$data['hot_news3'] = DB::table('tbl_service')->where('c_lang',App::getLocale())->orderBy('pk_service_id','desc')->first();
    	if($data['hot_news3']!=null){
    		$data['cate_hot_news3']=DB::table('tbl_category_service')->where('pk_category_service_id',$data['hot_news3']->fk_category_service_id)->first();
    	}

    	$data['hot_news4'] = DB::table('tbl_other')->where('c_lang',App::getLocale())->orderBy('pk_other_id','desc')->first();
    	if($data['hot_news4']!=null){
    		$data['cate_hot_news4']=DB::table('tbl_category_other')->where('pk_category_other_id',$data['hot_news4']->fk_category_other_id)->first();
    	}

    	$data['hot_news5'] = DB::table('tbl_about')->where('c_lang',App::getLocale())->orderBy('pk_about_id','desc')->first();
    	if($data['hot_news5']!=null){
    		$data['cate_hot_news5']=DB::table('tbl_category_about')->where('pk_category_about_id',$data['hot_news5']->fk_category_about_id)->first();
    	}

    	$data['hot'] = DB::table('tbl_news')->where([['c_lang',App::getLocale()],['c_status',1]])->take(5)->orderBy('pk_news_id','desc')->get();

    	$data['in_news1'] = DB::table('tbl_news')->where([
										    		['c_lang',App::getLocale()],
										    		['c_category_news',1],
										    		['c_status',0]
										    		])
										    	 ->orderBy('pk_news_id','desc')->first();
		$data['in_news2'] = DB::table('tbl_news')->where([
										    		['c_lang',App::getLocale()],
										    		['c_category_news',1],
										    		['c_status',0]
										    		])
										    	 ->orderBy('pk_news_id','desc')->skip(1)->take(4)->get();

		$data['out_news1'] = DB::table('tbl_news')->where([
										    		['c_lang',App::getLocale()],
										    		['c_category_news','<>',1],
										    		['c_status',0]
										    		])
										    	 ->orderBy('pk_news_id','desc')->first();
		$data['out_news2'] = DB::table('tbl_news')->where([
										    		['c_lang',App::getLocale()],
										    		['c_category_news','<>',1],
										    		['c_status',0]
										    		])
										    	 ->orderBy('pk_news_id','desc')->skip(1)->take(4)->get();

		$data['science'] = DB::table('tbl_science')->where('c_lang',App::getLocale())->orderBy('pk_science_id','desc')->take(3)->get();

		$data['cate_service'] = DB::table('tbl_category_service')->where([
																	['c_lang',App::getLocale()],
																	['c_enable',1]		
																	])			
																->get();
		
		$data['cate_other'] = DB::table('tbl_category_other')->where([
																	['c_lang',App::getLocale()],
																	['c_enable',1]		
																	])			
																->get();																															
		$data['cate_about'] = DB::table('tbl_category_about')->where([
																	['c_lang',App::getLocale()],
																	['c_enable',1]		
																	])			
																->get();																							    	 						
		$data['video'] = DB::table('tbl_video')->where('c_lang',App::getLocale())->orderBy('pk_video_id','desc')->take(12)->get();	

		$data['document'] = DB::table('tbl_document')->where('c_lang',App::getLocale())->orderBy('pk_document_id','desc')->take(4)->get();

		
    	return view('pages.home',$data);

    }
    public function list_news($locale){
    	App::setLocale($locale);
    	$data['hot_news1'] = DB::table('tbl_news')->where('c_lang',App::getLocale())->orderBy('pk_news_id','desc')->first();
    	if($data['hot_news1']!=null){
	    	$data['hot_news1']->c_category_news==1 ? $data['cate_hot_news1']='tin-trong-nuoc' : $data['cate_hot_news1']='tin-quoc-te';	    
		}

    	$data['hot_news2'] = DB::table('tbl_science')->where('c_lang',App::getLocale())->orderBy('pk_science_id','desc')->first();

    	$data['hot_news3'] = DB::table('tbl_service')->where('c_lang',App::getLocale())->orderBy('pk_service_id','desc')->first();
    	if($data['hot_news3']!=null){
    		$data['cate_hot_news3']=DB::table('tbl_category_service')->where('pk_category_service_id',$data['hot_news3']->fk_category_service_id)->first();
    	}

    	$data['hot_news4'] = DB::table('tbl_other')->where('c_lang',App::getLocale())->orderBy('pk_other_id','desc')->first();
    	if($data['hot_news4']!=null){
    		$data['cate_hot_news4']=DB::table('tbl_category_other')->where('pk_category_other_id',$data['hot_news4']->fk_category_other_id)->first();
    	}

    	$data['hot_news5'] = DB::table('tbl_about')->where('c_lang',App::getLocale())->orderBy('pk_about_id','desc')->first();
    	if($data['hot_news5']!=null){
    		$data['cate_hot_news5']=DB::table('tbl_category_about')->where('pk_category_about_id',$data['hot_news5']->fk_category_about_id)->first();
    	}
    	
    		$data['cate_news'] = DB::table('tbl_news')->where([
    														['c_lang',App::getLocale()],
    														['c_status',0]	
    													])->orderBy('pk_news_id','desc')->simplePaginate(15);
    	
    	return view('pages.cate_news',$data);
    }
    public function list_document($locale){
    	App::setLocale($locale);
    	$data['hot_news1'] = DB::table('tbl_news')->where('c_lang',App::getLocale())->orderBy('pk_news_id','desc')->first();
    	if($data['hot_news1']!=null){
	    	$data['hot_news1']->c_category_news==1 ? $data['cate_hot_news1']='tin-trong-nuoc' : $data['cate_hot_news1']='tin-quoc-te';	    
		}

    	$data['hot_news2'] = DB::table('tbl_science')->where('c_lang',App::getLocale())->orderBy('pk_science_id','desc')->first();

    	$data['hot_news3'] = DB::table('tbl_service')->where('c_lang',App::getLocale())->orderBy('pk_service_id','desc')->first();
    	if($data['hot_news3']!=null){
    		$data['cate_hot_news3']=DB::table('tbl_category_service')->where('pk_category_service_id',$data['hot_news3']->fk_category_service_id)->first();
    	}

    	$data['hot_news4'] = DB::table('tbl_other')->where('c_lang',App::getLocale())->orderBy('pk_other_id','desc')->first();
    	if($data['hot_news4']!=null){
    		$data['cate_hot_news4']=DB::table('tbl_category_other')->where('pk_category_other_id',$data['hot_news4']->fk_category_other_id)->first();
    	}

    	$data['hot_news5'] = DB::table('tbl_about')->where('c_lang',App::getLocale())->orderBy('pk_about_id','desc')->first();
    	if($data['hot_news5']!=null){
    		$data['cate_hot_news5']=DB::table('tbl_category_about')->where('pk_category_about_id',$data['hot_news5']->fk_category_about_id)->first();
    	}

    	$data['document'] = DB::table('tbl_document')->where('c_lang',App::getLocale())->orderBy('pk_document_id','desc')->simplePaginate(30);
    	return view('pages.document',$data);
    }
    public function list_science($locale){
    	App::setLocale($locale);
    	$data['hot_news1'] = DB::table('tbl_news')->where('c_lang',App::getLocale())->orderBy('pk_news_id','desc')->first();
    	if($data['hot_news1']!=null){
	    	$data['hot_news1']->c_category_news==1 ? $data['cate_hot_news1']='tin-trong-nuoc' : $data['cate_hot_news1']='tin-quoc-te';	    
		}

    	$data['hot_news2'] = DB::table('tbl_science')->where('c_lang',App::getLocale())->orderBy('pk_science_id','desc')->first();

    	$data['hot_news3'] = DB::table('tbl_service')->where('c_lang',App::getLocale())->orderBy('pk_service_id','desc')->first();
    	if($data['hot_news3']!=null){
    		$data['cate_hot_news3']=DB::table('tbl_category_service')->where('pk_category_service_id',$data['hot_news3']->fk_category_service_id)->first();
    	}

    	$data['hot_news4'] = DB::table('tbl_other')->where('c_lang',App::getLocale())->orderBy('pk_other_id','desc')->first();
    	if($data['hot_news4']!=null){
    		$data['cate_hot_news4']=DB::table('tbl_category_other')->where('pk_category_other_id',$data['hot_news4']->fk_category_other_id)->first();
    	}

    	$data['hot_news5'] = DB::table('tbl_about')->where('c_lang',App::getLocale())->orderBy('pk_about_id','desc')->first();
    	if($data['hot_news5']!=null){
    		$data['cate_hot_news5']=DB::table('tbl_category_about')->where('pk_category_about_id',$data['hot_news5']->fk_category_about_id)->first();
    	}

    	
    		$data['list_science1'] = DB::table('tbl_science')->where('c_lang',App::getLocale())->orderBy('pk_science_id','desc')->first();
    		$data['list_science2'] = DB::table('tbl_science')->where('c_lang',App::getLocale())->orderBy('pk_science_id','desc')->skip(1)->take(2)->get();
    		$data['skip_news'] = DB::table('tbl_science')->where('c_lang',App::getLocale())->orderBy('pk_science_id','desc')->take(3)->get();
    		if(count($data['skip_news'])==3){
    		$data['list_science3'] = DB::table('tbl_science')->where([
    			['c_lang',App::getLocale()],
    			['pk_science_id','<',$data['skip_news'][2]->pk_science_id]
    			])->orderBy('pk_science_id','desc')->simplePaginate(10);
    		}
    		else{$data['list_science3']=null;}
    		$data['folder_img'] = 'science';
    
    	return view('pages.list_news',$data);
    }
    public function cate_news($locale,$cate,$kind){
    	App::setLocale($locale);
    	$data['hot_news1'] = DB::table('tbl_news')->where('c_lang',App::getLocale())->orderBy('pk_news_id','desc')->first();
    	if($data['hot_news1']!=null){
	    	$data['hot_news1']->c_category_news==1 ? $data['cate_hot_news1']='tin-trong-nuoc' : $data['cate_hot_news1']='tin-quoc-te';	    
		}

    	$data['hot_news2'] = DB::table('tbl_science')->where('c_lang',App::getLocale())->orderBy('pk_science_id','desc')->first();

    	$data['hot_news3'] = DB::table('tbl_service')->where('c_lang',App::getLocale())->orderBy('pk_service_id','desc')->first();
    	if($data['hot_news3']!=null){
    		$data['cate_hot_news3']=DB::table('tbl_category_service')->where('pk_category_service_id',$data['hot_news3']->fk_category_service_id)->first();
    	}

    	$data['hot_news4'] = DB::table('tbl_other')->where('c_lang',App::getLocale())->orderBy('pk_other_id','desc')->first();
    	if($data['hot_news4']!=null){
    		$data['cate_hot_news4']=DB::table('tbl_category_other')->where('pk_category_other_id',$data['hot_news4']->fk_category_other_id)->first();
    	}

    	$data['hot_news5'] = DB::table('tbl_about')->where('c_lang',App::getLocale())->orderBy('pk_about_id','desc')->first();
    	if($data['hot_news5']!=null){
    		$data['cate_hot_news5']=DB::table('tbl_category_about')->where('pk_category_about_id',$data['hot_news5']->fk_category_about_id)->first();
    	}

    	switch ($cate) {
    		case 'tin-tuc':
    			if($kind=='tin-trong-nuoc'){
    				$data['list_news1'] = DB::table('tbl_news')->where([
										    		['c_lang',App::getLocale()],
										    		['c_category_news',1],
										    		['c_status',0]
										    		])
										    	 ->orderBy('pk_news_id','desc')->first();
		    		$data['list_news2'] = DB::table('tbl_news')->where([
										    		['c_lang',App::getLocale()],
										    		['c_category_news',1],
										    		['c_status',0]
										    		])
										    	 ->orderBy('pk_news_id','desc')->skip(1)->take(2)->get();
		    		$data['skip_news'] = DB::table('tbl_news')->where([
										    		['c_lang',App::getLocale()],
										    		['c_category_news',1],
										    		['c_status',0]
										    		])
										    	 ->orderBy('pk_news_id','desc')->take(3)->get();
		    		if(count($data['skip_news'])==3){
		    		$data['list_news3'] = DB::table('tbl_news')->where([
		    			['c_lang',App::getLocale()],
		    			['c_category_news',1],
						['c_status',0],
		    			['pk_news_id','<',$data['skip_news'][2]->pk_news_id]
		    			])->orderBy('pk_news_id','desc')->simplePaginate(10);
		    		}
		    		else{$data['list_news3']=null;}
		    		$data['title'] = trans('a.tintrongnuoc');
		    		$data['url'] ='tin-tuc/tin-trong-nuoc';
		    		// $data['folder_img'] = asset('public/upload/news');

    			}
    			if($kind=='tin-quoc-te'){
    				$data['list_news1'] = DB::table('tbl_news')->where([
										    		['c_lang',App::getLocale()],
										    		['c_category_news','<>',1],
										    		['c_status',0]
										    		])
										    	 ->orderBy('pk_news_id','desc')->first();
		    		$data['list_news2'] = DB::table('tbl_news')->where([
										    		['c_lang',App::getLocale()],
										    		['c_category_news','<>',1],
										    		['c_status',0]
										    		])
										    	 ->orderBy('pk_news_id','desc')->skip(1)->take(2)->get();
		    		$data['skip_news'] = DB::table('tbl_news')->where([
										    		['c_lang',App::getLocale()],
										    		['c_category_news','<>',1],
										    		['c_status',0]
										    		])
										    	 ->orderBy('pk_news_id','desc')->take(3)->get();
		    		if(count($data['skip_news'])==3){
		    		$data['list_news3'] = DB::table('tbl_news')->where([
		    			['c_lang',App::getLocale()],
		    			['c_category_news','<>',1],
						['c_status',0],
		    			['pk_news_id','<',$data['skip_news'][2]->pk_news_id]
		    			])->orderBy('pk_news_id','desc')->simplePaginate(10);
		    		}
		    		else{$data['list_news3']=null;}
		    		$data['title'] = trans('a.tinquocte');
		    		$data['url'] ='tin-tuc/tin-quoc-te';
		    		// $data['folder_img'] = asset('public/upload/news');

    			}
    			break;
    		case 'gioi-thieu':
    			$data['cate_about'] = DB::table('tbl_category_about')->where([
																	['c_lang',App::getLocale()],
																	])			
																->get();
				foreach($data['cate_about'] as $rows_cate_about){												
				if($kind==$rows_cate_about->c_slug){
					$data['list_news1'] = DB::table('tbl_about')->where([
										    		['c_lang',App::getLocale()],
										    		['fk_category_about_id',$rows_cate_about->pk_category_about_id]
										    		])
										    	 ->orderBy('pk_about_id','desc')->first();
		    		$data['list_news2'] = DB::table('tbl_about')->where([
										    		['c_lang',App::getLocale()],
										    		['fk_category_about_id',$rows_cate_about->pk_category_about_id]
										    		])
										    	 ->orderBy('pk_about_id','desc')->skip(1)->take(2)->get();
		    		$data['skip_news'] = DB::table('tbl_about')->where([
										    		['c_lang',App::getLocale()],
										    		['fk_category_about_id',$rows_cate_about->pk_category_about_id]
										    		])
										    	 ->orderBy('pk_about_id','desc')->take(3)->get();
		    		if(count($data['skip_news'])==3){
		    		$data['list_news3'] = DB::table('tbl_about')->where([
		    			['c_lang',App::getLocale()],
		    			['fk_category_about_id',$rows_cate_about->pk_category_about_id],
		    			['pk_about_id','<',$data['skip_news'][2]->pk_about_id]
		    			])->orderBy('pk_about_id','desc')->simplePaginate(10);
		    		}
		    		else{$data['list_news3']=null;}
		    		$data['url'] ='gioi-thieu/'.$rows_cate_about->c_slug;
		    		$data['title'] = $rows_cate_about->c_name;
		    		
		    	}
		    		
		    		$data['folder_img'] = asset('public/upload/about');

		    		
		    		// $data['folder_img'] = asset('public/upload/news');
				}	
    			break;
    		case 'dich-vu-phan-tich':
    			$data['cate_service'] = DB::table('tbl_category_service')->where([
																	['c_lang',App::getLocale()]
																	])			
																->get();
				foreach($data['cate_service'] as $rows_cate_service){												
				if($kind==$rows_cate_service->c_slug){
					$data['list_news1'] = DB::table('tbl_service')->where([
										    		['c_lang',App::getLocale()],
										    		['fk_category_service_id',$rows_cate_service->pk_category_service_id]
										    		])
										    	 ->orderBy('pk_service_id','desc')->first();
		    		$data['list_news2'] = DB::table('tbl_service')->where([
										    		['c_lang',App::getLocale()],
										    		['fk_category_service_id',$rows_cate_service->pk_category_service_id]
										    		])
										    	 ->orderBy('pk_service_id','desc')->skip(1)->take(2)->get();
		    		$data['skip_news'] = DB::table('tbl_service')->where([
										    		['c_lang',App::getLocale()],
										    		['fk_category_service_id',$rows_cate_service->pk_category_service_id]
										    		])
										    	 ->orderBy('pk_service_id','desc')->take(3)->get();
		    		if(count($data['skip_news'])==3){
		    		$data['list_news3'] = DB::table('tbl_service')->where([
		    			['c_lang',App::getLocale()],
		    			['fk_category_service_id',$rows_cate_service->pk_category_service_id],
		    			['pk_service_id','<',$data['skip_news'][2]->pk_service_id]
		    			])->orderBy('pk_service_id','desc')->simplePaginate(10);
		    		}
		    		else{$data['list_news3']=null;}
		    		$data['url'] ='dich-vu-phan-tich/'.$rows_cate_service->c_slug;
		    		$data['title'] = $rows_cate_service->c_name;
		    		
		    	}
		    		
		    		$data['folder_img'] = asset('public/upload/service');

		    		
		    		// $data['folder_img'] = asset('public/upload/news');
				}
    			break;
    		case 'dich-vu-khac':
    			$data['cate_other'] = DB::table('tbl_category_other')->where([
																	['c_lang',App::getLocale()]
																	])			
																->get();
				foreach($data['cate_other'] as $rows_cate_other){												
				if($kind==$rows_cate_other->c_slug){
					$data['list_news1'] = DB::table('tbl_other')->where([
										    		['c_lang',App::getLocale()],
										    		['fk_category_other_id',$rows_cate_other->pk_category_other_id]
										    		])
										    	 ->orderBy('pk_other_id','desc')->first();
		    		$data['list_news2'] = DB::table('tbl_other')->where([
										    		['c_lang',App::getLocale()],
										    		['fk_category_other_id',$rows_cate_other->pk_category_other_id]
										    		])
										    	 ->orderBy('pk_other_id','desc')->skip(1)->take(2)->get();
		    		$data['skip_news'] = DB::table('tbl_other')->where([
										    		['c_lang',App::getLocale()],
										    		['fk_category_other_id',$rows_cate_other->pk_category_other_id]
										    		])
										    	 ->orderBy('pk_other_id','desc')->take(3)->get();
		    		if(count($data['skip_news'])==3){
		    		$data['list_news3'] = DB::table('tbl_other')->where([
		    			['c_lang',App::getLocale()],
		    			['fk_category_other_id',$rows_cate_other->pk_category_other_id],
		    			['pk_other_id','<',$data['skip_news'][2]->pk_other_id]
		    			])->orderBy('pk_other_id','desc')->simplePaginate(10);
		    		}
		    		else{$data['list_news3']=null;}
		    		$data['url'] ='dich-vu-khac/'.$rows_cate_other->c_slug;
		    		$data['title'] = $rows_cate_other->c_name;
		    		
		    	}
		    		
		    		$data['folder_img'] = asset('public/upload/other');

		    		
		    		// $data['folder_img'] = asset('public/upload/news');
				}
    			break;
    		default:
    			# code...
    			break;
    	}

    	return view('pages.list_news_1',$data);

    }
    public function detail_news($locale,$cate,$kind,$slug){    	
    	App::setLocale($locale);
    	$data['hot_news1'] = DB::table('tbl_news')->where('c_lang',App::getLocale())->orderBy('pk_news_id','desc')->first();
    	if($data['hot_news1']!=null){
	    	$data['hot_news1']->c_category_news==1 ? $data['cate_hot_news1']='tin-trong-nuoc' : $data['cate_hot_news1']='tin-quoc-te';	    
		}

    	$data['hot_news2'] = DB::table('tbl_science')->where('c_lang',App::getLocale())->orderBy('pk_science_id','desc')->first();

    	$data['hot_news3'] = DB::table('tbl_service')->where('c_lang',App::getLocale())->orderBy('pk_service_id','desc')->first();
    	if($data['hot_news3']!=null){
    		$data['cate_hot_news3']=DB::table('tbl_category_service')->where('pk_category_service_id',$data['hot_news3']->fk_category_service_id)->first();
    	}

    	$data['hot_news4'] = DB::table('tbl_other')->where('c_lang',App::getLocale())->orderBy('pk_other_id','desc')->first();
    	if($data['hot_news4']!=null){
    		$data['cate_hot_news4']=DB::table('tbl_category_other')->where('pk_category_other_id',$data['hot_news4']->fk_category_other_id)->first();
    	}

    	$data['hot_news5'] = DB::table('tbl_about')->where('c_lang',App::getLocale())->orderBy('pk_about_id','desc')->first();
    	if($data['hot_news5']!=null){
    		$data['cate_hot_news5']=DB::table('tbl_category_about')->where('pk_category_about_id',$data['hot_news5']->fk_category_about_id)->first();
    	}
    	switch ($cate) {
    		case 'tin-tuc':
    			$data['detail'] = DB::table('tbl_news')->where([['c_lang',App::getLocale()],['c_slug',$slug]])->first();
    			$kind_news = $data['detail']->c_category_news;
    			if($kind_news==1) $data['kind']='tin-trong-nuoc'; else $data['kind']='tin-quoc-te';
    			$data['title'] = $data['detail']->c_name;
    			$data['relate'] = DB::table('tbl_news')->where('c_lang',App::getLocale())->skip(RAND(3,7))->take(3)->get();
    			$data['relate2'] = DB::table('tbl_news')->where('c_lang',App::getLocale())->skip(RAND(7,15))->take(3)->get();
    			$data['link'] = url(App::getLocale()).'/tin-tuc'.'/'.$data['kind'];	
    			break;
    		case 'nghien-cuu-khoa-hoc':
    			$data['detail'] = DB::table('tbl_science')->where([['c_lang',App::getLocale()],['c_slug',$slug]])->first();
    			$data['title'] = $data['detail']->c_name;
    			$data['relate'] = DB::table('tbl_science')->where('c_lang',App::getLocale())->skip(RAND(3,7))->take(3)->get();
    			$data['relate2'] = DB::table('tbl_science')->where('c_lang',App::getLocale())->skip(RAND(7,15))->take(3)->get();
    			$data['folder_img'] = asset('public/upload/science');
    			$data['link'] = url(App::getLocale()).'/nghien-cuu-khoa-hoc/bai-viet';
				break;	
    		case 'dich-vu-phan-tich':
    			$data['detail'] = DB::table('tbl_service')->where([['c_lang',App::getLocale()],['c_slug',$slug]])->first();
    			$data['cate_service'] = DB::table('tbl_category_service')->where([
																	['c_lang',App::getLocale()],
																	['pk_category_service_id',$data['detail']->fk_category_service_id]
																	])			
																->first();
																
    			$data['title'] = $data['detail']->c_name;
    			$data['relate'] = DB::table('tbl_service')->where('c_lang',App::getLocale())->skip(RAND(3,7))->take(3)->get();
    			$data['relate2'] = DB::table('tbl_service')->where('c_lang',App::getLocale())->skip(RAND(7,15))->take(3)->get();
    			$data['folder_img'] = asset('public/upload/service');
    			$data['link'] = url(App::getLocale()).'/dich-vu-phan-tich'.'/'.$data['cate_service']->c_slug;
    			break;
    		case 'dich-vu-khac':
				$data['detail'] = DB::table('tbl_other')->where([['c_lang',App::getLocale()],['c_slug',$slug]])->first();
    			$data['cate_other'] = DB::table('tbl_category_other')->where([
																	['c_lang',App::getLocale()],
																	['pk_category_other_id',$data['detail']->fk_category_other_id]
																	])			
																->first();
																
    			$data['title'] = $data['detail']->c_name;
    			$data['relate'] = DB::table('tbl_other')->where('c_lang',App::getLocale())->skip(RAND(3,7))->take(3)->get();
    			$data['relate2'] = DB::table('tbl_other')->where('c_lang',App::getLocale())->skip(RAND(7,15))->take(3)->get();
    			$data['folder_img'] = asset('public/upload/other');
    			$data['link'] = url(App::getLocale()).'/dich-vu-khac'.'/'.$data['cate_other']->c_slug;
				break;
			case 'gioi-thieu':
				$data['detail'] = DB::table('tbl_about')->where([['c_lang',App::getLocale()],['c_slug',$slug]])->first();
    			$data['cate_about'] = DB::table('tbl_category_about')->where([
																	['c_lang',App::getLocale()],
																	['pk_category_about_id',$data['detail']->fk_category_about_id]
																	])			
																->first();
																
    			$data['title'] = $data['detail']->c_name;
    			$data['relate'] = DB::table('tbl_about')->where('c_lang',App::getLocale())->skip(RAND(3,7))->take(3)->get();
    			$data['relate2'] = DB::table('tbl_about')->where('c_lang',App::getLocale())->skip(RAND(7,15))->take(3)->get();
    			$data['folder_img'] = asset('public/upload/about');
    			$data['link'] = url(App::getLocale()).'/gioi-thieu'.'/'.$data['cate_about']->c_slug;
				break;	
    		default:
    			# code...
    			break;
    	}
    	
    	return view('pages.detail_news',$data);
    }
    

}
