@extends('layout')
@section('title', 'Tasks')
@section('content')
<button id="slideToggle"><b>Create a new task </b></button>
<div id="slideToggleDiv" style="display: none"><br>
<form>
	<input type="text" name="title" placeholder="title" required="required" /><br><br>
	<input type="date" name="dateToFinish" required="required" /><br><br>
	<textarea name="description" placeholder="description" required="required" /></textarea><br><br>
	<button id="createTask">Create</button>
</form><br>
</div> <!-- end div id="slideToggleDiv" -->
<h2>Tasks</h2>
<p id="msg"></p> 
<div id="title"></div>
<h2>Expired tasks</h2>
<p id="expMsg"></p>
<div id="expired"></div>
@endsection
