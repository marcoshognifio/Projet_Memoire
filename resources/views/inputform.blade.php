@php

	$label ??= null;
	$type ??= 'text';
	$class ??= null;
	$name ??= '';
	$value ??= null;
	$items ??=null;

@endphp


<div @class(["form-control",$class])>

		<label for="{{$name}}">{{$label}}</label>

	@switch($type)

		@case('select')
			<select name="{{$name}}" id="{{$name}}">

				@foreach($items as $item)

					<option value="{{$item['id']}}">{{strtoupper($item['nom'])}}</option>
				
				@endforeach

			</select>
			@break

		@case('select_list')
			<select name="{{$name}}" id="{{$name}}">

				@foreach($items as $item)

					<option value={{$item['id']}}>{{strtoupper($item['nom'])}}</option>
				
				@endforeach

			</select>
			@break
			
		@case('textarea')
			<textarea type="{{$type}}" id="{{$name}}" name="{{$name}}" >{{old($name,$value)}}</textarea>
			@break

		@default
			<input type="{{$type}}" id="{{$name}}" name="{{$name}}" value="{{old($name,$value)}}">
			
	@endswitch

	@error($name)
		<div>
			{{$message}}
		</div>
	@enderror
</div>