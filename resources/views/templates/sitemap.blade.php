@extends("mainLayout")

@section("styles")
@parent
{!! Html::style("css/sitemap.css") !!}

@endsection

@section("content_layout")

<div class="column">
	<div class="row">
		<div class="sitemap panel">

			<div class="title fifth-color">
				<i class="map outline icon"></i>  Mapa strony
			</div>

			<div class="content editMe">

				<div class="ui list">
					@foreach($menus as $menu)

					<div class="item">
						<i class="sidebar icon"></i>
						<div class="content">
							<div class="header">{{ $menu->name }}</div>
							<div class="list">

								@foreach($menu->menu_item as $item)
								@if($item->is_dropdown)

								<div class="item">
									<i class="square outline icon"></i>
									<div class="content">
										<div class="header">{{ $item->name }}</div>
										<div class="list">

											@foreach($item->link as $link)
											<div class="item">
												<i class="external icon"></i>
												<div class="content">
													<div class="header">
														<a href="{{ $link->url }}">
															{{ $link->name }}
														</a>
													</div>
												</div>
											</div>
											@endforeach

										</div>
									</div>
								</div>

								@else 

								<div class="item">
									<i class="external icon"></i>
									<div class="content">
										<div class="header">
											<a href="{{ $item->link[0]->url }}">
											{{ $item->link[0]->name }}
											</a>
										</div>
									</div>
								</div>

								@endif
								@endforeach

							</div>
						</div>
					</div>
					@endforeach
				</div>

			</div>
		</div>
	</div>
</div>

@endsection

@section("scripts")
@parent

@endsection
