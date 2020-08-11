@extends('adminlte::page')

@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)
@section('plugins.jquery-confirm', true)

@section('title', isset($title) ? $title : "Title" )


@include("Backend.layouts.alerts.errors")
@include("Backend.layouts.alerts.message")
