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

//TODO add link
@section('content')

@endsection