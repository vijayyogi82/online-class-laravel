
@php
	$random = $progress->id.'CR-'.uniqid();
@endphp
<!-- <a href="" onclick="printDiv('printableArea')" class="btn btn-primary py-2 font-16"><i class="feather icon-printer mr-2"></i>Print</a> -->
<a href="" onclick="printDiv('printableArea')"   class="btn btn-secondary">
    {{ __('Print Certificate') }}
</a>
