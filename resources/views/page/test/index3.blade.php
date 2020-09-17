@extends('layouts.master')

@section('pagetitle' , 'Index')

@section('content')


<input type="text" name="daterange" value="01/01/2018 - 01/15/2018" />




@endsection

@section('script')

<script>
  $(function() {
    $('input[name="daterange"]').daterangepicker({
      opens: 'left'
    }, function(start, end, label) {
      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
  });
</script>
   

@endsection








