@if ($paginator->lastPage() > 1)
 
      <div class="pagination-box">
			<ul class="list-inline">
			    <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
			        <a href="{{ $paginator->url(1) }}"><i class="fa fa-angle-double-left"></i></a>
			    </li>
			    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
			        <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
			            <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
			        </li>
			    @endfor
			    <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
			        <a href="{{ $paginator->url($paginator->currentPage()+1) }}" ><i class="fa fa-angle-double-right"></i></a>
			    </li>
			</ul>
	</div>
 
@endif

 