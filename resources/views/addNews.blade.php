@extends("mainLayout")

@section("styles")
@parent
{!!Html::style("css/addNews.css")!!}
{!!Html::style("css/content-tools.min.css")!!}
@endsection


@section("content_layout")

@component("templates.form")

@slot("news_route")
{{route("news.add.post")}}
@endslot

@slot("news_header")
Dodaj newsa
@endslot

@slot("news_settings")

<div class="field">
	<div class="ui slider checkbox">
		<input type="checkbox" name="is_pinned">
		<label>Przypnij</label>
	</div>
	<i class="pin icon"></i>				
	@if($newsPinned)
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
				<input type="checkbox" name="publish_at_now" checked id="publish_at_now">
				<label>Teraz</label>
			</div>
		</div>
		<br>
		<div class="three fields disabled" id="publish_at_fields">				
			<div class="field">
				<label>Data</label>
				<div class="ui calendar" id="publish_at_date">
					<div class="ui input left icon ">
						<i class="time icon"></i>
						<input type="text" placeholder="Data" name="publish_at_date" >
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
						<input type="text" placeholder="Godzina" name="publish_at_time">	
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
				<input type="checkbox" name="expire_at_never" checked id="expire_at_never">
				<label>Nigdy</label>
			</div>
		</div>	
		<br>
		<div class="two fields disabled" id="expire_at_fields">
			<div class="field">
				<label>Data</label>
				<div class="ui calendar" id="expire_at_date">
					<div class="ui input left icon">
						<i class="time icon"></i>
						<input type="text" placeholder="Data" name="expire_at_date">
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
						<input type="text" placeholder="Godzina" name="expire_at_time">	
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
{!!Html::script("js/content-tools.min.js")!!}
{!!Html::script("js/addNews.js")!!}
@endsection