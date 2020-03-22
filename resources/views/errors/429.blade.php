@extends('errors::illustrated-layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Slow down! Too Many Requests'))
