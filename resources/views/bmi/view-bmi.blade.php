@extends('layouts.app')

@section('content')
  @livewire('bmi-crud', [$from_first_name, $from_id])
@endsection
