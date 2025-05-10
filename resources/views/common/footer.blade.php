<footer class="bg-app has-shapes has-bg-brash bg-brash-top " style="background-image: url(theme/images/brushes/footer.svg)">
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-12">
                <div class="text-center pb-60">
                    <h2 class="section-title">Join 75,000+ growing business That <strong>Use {{$site_name}} To Their Brand</strong></h2>
                    <a href="{{ url('signup_company') }}" class="btn btn-primary has-icon">Get Started With Us
                        <span class="icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5522 6.66669L20.5522 14.6667C21.0329 15.1473 21.0699 15.9036 20.6632 16.4267L20.5522 16.5523L12.5522 24.5523L10.6666 22.6667L17.7228 15.6095L10.6666 8.55231L12.5522 6.66669Z" fill="currentColor"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-12">
                <div class="border-bottom"></div>
            </div>
        </div>
        <div class="row pt-60 pb-60">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="pr-0 pr-lg-4">
                    <img class="mb-25" src="{{ url(PAGE_LOGO_URL)}}"  height="70"alt="">
					<ul class="list-unstyled footer-links">
                        <li><a href="{{ url('ride') }}">{{trans('messages.footer.ride')}}</a></li>
                        <li><a href="{{ url('drive') }}">{{trans('messages.footer.drive')}}</a></li>
                        <li><a href="{{ url('safety') }}">{{trans('messages.footer.safety')}}</a></li>
                      
                    </ul>
                </div>
            </div>
         
            
             <div class="col-lg-9 col-md col-sm-6">
                 
               <div class="row justify-content-center text-center">
                   	@if (in_array(Route::current()->uri(),['/','ride','signup_rider','ride','signin_rider']) || Auth::check() && Auth::user()->user_type='Rider')
                       	@if($app_links[0]->value !="" )
                        <div class="col-lg-3 col-md col-sm-6">
                            <div class="pl-0 pl-md-3 mt-5 mt-md-0">
                            <a class="btn btn-sm btn-outline-primary" href="{{$app_links[0]->value}}" target="_blank">
                                <img src="{{ url('images/new/app.png') }}" alt="Download on the Appstore" class="CToWUd">
                            </a>
                            </div>
                        </div>
                        @endif
                        @if($app_links[2]->value !="" )
                        <div class="col-lg-3 col-md col-sm-6">
                            <div class="pl-0 pl-md-3 mt-5 mt-md-0">
                                <a href="{{$app_links[2]->value}}" target="_blank" class="btn btn-sm btn-outline-primary">
    							<img src="{{ url('images/new/google.png') }}" alt="Get it on Googleplay" class="CToWUd bot_footimg">
    							</a>
                               
                            </div>
                        </div>
                        @endif
                	@else    
                	@if($app_links[1]->value !="" )
                    <div class="col-lg-3 col-md col-sm-6">
                        <div class="pl-0 pl-md-3 mt-5 mt-md-0">
                           <a  class="btn btn-sm btn-outline-primary" href="{{$app_links[1]->value}}" target="_blank">
							<img src="{{ url('images/new/app.png') }}" alt="Download on the Appstore" class="CToWUd">
						   </a>
                           
                        </div>
                    </div>
                     @endif
                     @if($app_links[3]->value !="" )
                     <div class="col-lg-3 col-md col-sm-6">
                        <div class="pl-0 pl-md-3 mt-5 mt-md-0">
                            <a  class="btn btn-sm btn-outline-primary"href="{{$app_links[3]->value}}" target="_blank">
							<img src="{{ url('images/new/google.png') }}" alt="Get it on Googleplay" class="CToWUd bot_footimg">
							</a>
                           
                        </div>
                    </div>
                     @endif
                     @endif
                     
                         <div class="col-lg-3 col-md col-sm-6">
                            <div class="pl-0 pl-md-3 mt-5 mt-md-0">
    					
    							<select name="language" class="btn btn-sm btn-outline-primary" aria-labelledby="language-selector-label" id="js-language-select" style="height: 60px;">
    @foreach($language as $key => $value)
        <option value="{{ $key }}" {{ (Session::get('language') ? Session::get('language') : $default_language[0]->value) == $key ? 'selected' : '' }}>
            {{ $value }}
        </option>
    @endforeach
</select>

    						
                            </div>
                        </div>
                        <div class="col-lg-3 col-md col-sm-6">
                            <div class="pl-0 pl-md-3 mt-5 mt-md-0">
        					   <select id="js-currency-select" class="btn btn-sm btn-outline-primary" style="height: 60px;">
        						@foreach($currency_select as $code)
        						<option value="{{$code}}" @if(session('currency') == $code ) selected="selected" @endif >{{$code}}
        						</option>
        						@endforeach
        					  </select>
                            </div>
                        </div>
                   </div>
                 

                 <div class="row justify-content-center mt-5 text-center">
                     	<div class="col-lg-6 col-md col-sm-6">
    					     @for($i=0; $i < $join_us->count(); $i++)
    					@if($join_us[$i]->value)
    					<a href="{{ $join_us[$i]->value }}" target="_blank" class"mr-9"> 
    						<span class="ti-{{ str_replace('_','-',$join_us[$i]->name) }}"></span>
    					</a> 
    					 @endif
					     @endfor
    					 </div>
                   		@foreach($company_pages as $company_page)
                         <div class="col-lg-3 col-md col-sm-6">
                            <div class="pl-0 pl-md-3 mt-5 mt-md-0">
                            <a  href="{{ url($company_page->url) }}" target="_blank">
                               	{{ $company_page->name }}
                            </a>
                            </div>
                        </div>
                        @endforeach
                 </div>
                 
                 <div class="row justify-content-center text-center mt-5">
                    
    				
					
					 	 @if(!Auth::user())
					 	<div class="col-lg-3 col-md col-sm-6">
					 	    <div class="pl-0 pl-md-3 mt-5 mt-md-0">
					 	        <a class="btn btn-sm btn-outline-primary"href="{{ url('signup_rider') }}">{{trans('messages.footer.siginup_ride')}}</a>
					 	    </div>
					 	    
					 	</div>
					 	<div class="col-lg-4 col-md col-sm-6">
					 	     <div class="pl-0 pl-md-3 mt-5 mt-md-0">
					 	        <a class="btn btn-sm btn-outline-primary"href="{{ url('signup_driver') }}">{{trans('messages.footer.driver')}}</a>
					 	    </div>
					 	</div>
					 	@if(Auth::guard('company')->user()==null)
					 	<div class="col-lg-4 col-md col-sm-6">
					 	     <div class="pl-0 pl-md-3 mt-5 mt-md-0">
					 	        <a class="btn btn-sm btn-outline-primary text-small"href="{{ url('signup_company') }}">{{trans('messages.home.become_company')}}</a>
					 	    </div>
					 	</div>
					 		@endif
					 	@endif
				
								
                   	
                 </div>
                 
            </div>
            
            
         
            
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="block border-top text-center content" style="color:white">
                        Copyright &copy; {{$copyright_year}}  <a href="{{$copyright_url}}"> {{$copyright_name}}</a> All rights
				    reserved.
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shape-1 shape-xs bg-primary rounded-circle"></div>
    <div class="shape-2 shape-sm-2 bg-tertiary rounded-circle"></div>
    <div class="shape-3 shape-sm bg-secondary rounded-circle"></div>
    <div class="shape-4 shape-xs-2 bg-tertiary rounded-circle"></div>
    <div class="shape-5 shape-sm-2 bg-secondary rounded-circle"></div>
    <div class="shape-6 shape-sm-2 bg-primary rounded-circle"></div>
</footer>
