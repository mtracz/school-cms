<a class="ui right corner red label editButton" onClick="enableEdit(this)">
	<i class="edit icon"></i>
</a>

@section("scripts")
@parent
<script type="text/javascript">

	function enableEdit(x) {
		$(x).closest(".panel").attr("data-editable","");
	};
</script>

@endsection
