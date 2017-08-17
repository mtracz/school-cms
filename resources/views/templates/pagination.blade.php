
<div class="ui pagination menu">

	@if($current_page == $first_page)

	<a class="disabled item" href="?page={{ $first_page }}"><i class="chevron left icon"></i></a>
	<div class="disabled item"><i class="caret left icon"></i></div>

	@else

	<a class="item" href="?page={{ $first_page }}"><i class="chevron left icon"></i></a>
	<a class="item" href="?page={{ $prev_page }}"><i class="caret left icon"></i></a>
	
	@endif

	@foreach($paginator_array as $page)

		@if($page == $current_page)

		<div class="active item">{{ $page }}</div>

		@else

		<a class="item" href="?page={{ $page }}"> {{ $page }} </a>

		@endif

	@endforeach

	@if($current_page == $last_page)

	<div class="disabled item"><i class="caret right icon"></i></div>
	<a class="disabled item"><i class="chevron right icon"></i></a>

	@else

	<a class="item" href="?page={{ $next_page }}"><i class="caret right icon"></i></a>
	<a class="item" href="?page={{ $last_page }}"><i class="chevron right icon"></i></a>
	
	@endif

</div>
