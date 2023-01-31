{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('notification_text', 'Notification_text:') !!}
			{!! Form::textarea('notification_text') !!}
		</li>
		<li>
			{!! Form::label('about_text', 'About_text:') !!}
			{!! Form::text('about_text') !!}
		</li>
		<li>
			{!! Form::label('phone', 'Phone:') !!}
			{!! Form::text('phone') !!}
		</li>
		<li>
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email') !!}
		</li>
		<li>
			{!! Form::label('fb_link', 'Fb_link:') !!}
			{!! Form::text('fb_link') !!}
		</li>
		<li>
			{!! Form::label('wa_link', 'Wa_link:') !!}
			{!! Form::text('wa_link') !!}
		</li>
		<li>
			{!! Form::label('tw_link', 'Tw_link:') !!}
			{!! Form::text('tw_link') !!}
		</li>
		<li>
			{!! Form::label('insta_link', 'Insta_link:') !!}
			{!! Form::text('insta_link') !!}
		</li>
		<li>
			{!! Form::label('yt_link', 'Yt_link:') !!}
			{!! Form::text('yt_link') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}