@extends('layouts.app')

@section('content')
  @livewire('view-patient', [$name, $from_designation_id])
@endsection
