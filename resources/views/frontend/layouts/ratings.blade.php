
	@if($ratings)
		@for($i = 0; $i < 5; $i++)
			@if( ($ratings - $i) >= 1 )
                <li class="fa fa-star"></li>
			@elseif( ($ratings - $i) < 1 && ($ratings - $i) > 0 )
                <li class="fa fa-star-half-alt"></li>
			@else
                <li style="color:#bec0c2 !important" class="fa fa-star disable"></li>
			@endif
		@endfor
	@endif


