<a class="ui right corner red label editButton" onClick="enableEdit(this)">
	<i class="edit icon"></i>
</a>

@section("scripts")
@parent
<script type="text/javascript">

	function enableEdit(x) {

		var parent = $(x).closest(".panel");

		$(parent).find(".editMe").attr("data-editable","");

		runContentTools();
	};

</script>

@endsection
