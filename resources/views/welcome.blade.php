@extends('layouts.app')

@section('scripts')
    <script>
      $(document).ready(function() {
        $('#calendar').fullCalendar({
          showNonCurrentDates: false,
          contentHeight : "auto",
          height: 'parent' +80 ,
          aspectRatio: 1.5,
          themeSystem: 'bootstrap3'
        });
      });
    </script>

@endsection

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-2 calendar">
        <div id="calendar"></div>
    </div>
</div>
@endsection


