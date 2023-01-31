{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('patient_name', 'Patient_name:') !!}
			{!! Form::text('patient_name') !!}
		</li>
		<li>
			{!! Form::label('patient_phone', 'Patient_phone:') !!}
			{!! Form::text('patient_phone') !!}
		</li>
		<li>
			{!! Form::label('age', 'Age:') !!}
			{!! Form::text('age') !!}
		</li>
		<li>
			{!! Form::label('bags', 'Bags:') !!}
			{!! Form::text('bags') !!}
		</li>
		<li>
			{!! Form::label('hospital', 'Hospital:') !!}
			{!! Form::text('hospital') !!}
		</li>
		<li>
			{!! Form::label('address', 'Address:') !!}
			{!! Form::text('address') !!}
		</li>
		<li>
			{!! Form::label('notes', 'Notes:') !!}
			{!! Form::textarea('notes') !!}
		</li>
		<li>
			{!! Form::label('latitude', 'Latitude:') !!}
			{!! Form::text('latitude') !!}
		</li>
		<li>
			{!! Form::label('longitude', 'Longitude:') !!}
			{!! Form::text('longitude') !!}
		</li>
		<li>
			{!! Form::label('blood_type_id', 'Blood_type_id:') !!}
			{!! Form::text('blood_type_id') !!}
		</li>
		<li>
			{!! Form::label('city_id', 'City_id:') !!}
			{!! Form::text('city_id') !!}
		</li>
		<li>
			{!! Form::label('client_id', 'Client_id:') !!}
			{!! Form::text('client_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}