@extends("mainLayout")

@section("styles")
	@parent
	{!!Html::style("css/addNews.css")!!}
@endsection

@section("content")
	@php
		$is_news_editing = isset($editing_news);
		if($is_news_editing) {
			$publish_date = explode(" ",$editing_news->published_at);
			$expire_date = explode(" ",$editing_news->expire_at);
		}
	@endphp

@if($is_news_editing)	
	@component("templates.form",["editing_news" => $editing_news])
@else
	@component("templates.form")
@endif

@slot("news_route")
	@if($is_news_editing)
		{{ route("news.edit.post", $editing_news->id) }}
	@else
		{{ route("news.add.post") }}
	@endif
@endslot

@slot("news_header")	
	@if($is_news_editing)
		Edytuj newsa
	@else
		Dodaj newsa
	@endif
@endslot

@slot("news_settings")

<div class="field">

	<div class="ui slider checkbox">
		@if($is_news_editing && $editing_news->id === $newsPinned->news_id)
			<input type="checkbox" name="is_pinned" checked>
		@else
			<input type="checkbox" name="is_pinned">
		@endif
		<label>Przypnij</label>
	</div>
	<i class="pin icon"></i>
	@if($is_news_editing && $editing_news->id === $newsPinned->news_id)
	@else
		<div class="is_pinned_info">
			<i class="circle warning icon"></i>
			Istnieje już przypięty news. Przypięcie tego newsa spowoduje odpięcie istniejącego.
		</div>
	@endif
</div>

<div class="two fields">

	<div class="field">
		<h3>Data publikacji</h3>			
		<div class="field">
			<div class="ui checkbox" >
				@if($is_news_editing)
					<input type="checkbox" name="publish_at_now" id="publish_at_now">
				@else
					<input type="checkbox" name="publish_at_now" checked id="publish_at_now">
				@endif
				<label>Teraz</label>
			</div>
		</div>
		<br>
		@if($is_news_editing)
			<div class="three fields" id="publish_at_fields">
		@else
			<div class="three fields disabled" id="publish_at_fields">				
		@endif
			<div class="field">
				<label>Data</label>
				<div class="ui calendar" id="publish_at_date">
					<div class="ui input left icon ">
						<i class="time icon"></i>
						@if($is_news_editing)
							<input type="text" placeholder="Data" name="publish_at_date" value="{{$publish_date[0]}}" data-original_date="{{$publish_date[0]}}" id="original_publish_date">
						@else
							<input type="text" placeholder="Data" name="publish_at_date" >
						@endif
					</div>						
				</div>
				<div class="ui pointing red basic label hidden" id="publish_date_warning">
					To pole musi być wypełnione
				</div>					
			</div>

			<div class="field">
				<label>Godzina</label>
				<div class="ui calendar" id="publish_at_time">
					<div class="ui input left icon">
						<i class="time icon"></i>
						@if($is_news_editing)
							<input type="text" placeholder="Data" name="publish_at_time" value="{{$publish_date[1]}}">
						@else
						<input type="text" placeholder="Godzina" name="publish_at_time">
						@endif
					</div>						
				</div>
				<div class="ui pointing red basic label hidden" id="publish_time_warning">
					To pole musi być wypełnione
				</div>
			</div>	
			<div class="field">
				<div class="ui teal circular button" id="clear_publish">czyść</div>
			</div>			
		</div>
	</div>

	<div class="field">
		<h3>Data ukrycia publikacji</h3>
		<div class="field">
			<div class="ui checkbox" >
				@if($is_news_editing && $editing_news->expire_at)
					<input type="checkbox" name="expire_at_never" id="expire_at_never">
				@else
					<input type="checkbox" name="expire_at_never" checked id="expire_at_never">
				@endif
				<label>Nigdy</label>
			</div>
		</div>	
		<br>
		@if($is_news_editing && $editing_news->expire_at)
			<div class="three fields" id="expire_at_fields">
		@else
			<div class="three fields disabled" id="expire_at_fields">
		@endif
			<div class="field">
				<label>Data</label>
				<div class="ui calendar" id="expire_at_date">
					<div class="ui input left icon">
						<i class="time icon"></i>
						@if($is_news_editing && $editing_news->expire_at)
							<input type="text" placeholder="Data" name="expire_at_date" value="{{$expire_date[0]}}" data-original_date="{{$expire_date[0]}}" id="original_expire_date">
						@else
						<input type="text" placeholder="Data" name="expire_at_date">
						@endif
					</div>
				</div>
				<div class="ui pointing red basic label hidden" id="expire_date_warning">
					To pole musi być wypełnione
				</div>
			</div>
			<div class="field">
				<label>Godzina</label>
				<div class="ui calendar" id="expire_at_time">
					<div class="ui input left icon">
						<i class="time icon"></i>
						@if($is_news_editing && $editing_news->expire_at)
							<input type="text" placeholder="Data" name="expire_at_time" value="{{$expire_date[1]}}">
						@else
							<input type="text" placeholder="Godzina" name="expire_at_time">
						@endif
					</div>
				</div>
				<div class="ui pointing red basic label hidden" id="expire_time_warning">
					To pole musi być wypełnione
				</div>
			</div>
			<div class="field">
				<div class="ui teal circular  button" id="clear_expire">czyść</div>
			</div>
		</div>

	</div>	
</div>			
@endslot

@endcomponent

@endsection

@section("scripts")
	@parent
	{!!Html::script("js/addNews.js")!!}
@endsection