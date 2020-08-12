@extends('layouts.email')

@section('content')
	<table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
		<!-- Body content -->
		<tr>
			<td class="content-cell">
				<div class="f-fallback">
					<h1>Hello there!</h1>
					<p>You've been invited to participate in {{$event->title}}</p>
					<p></p>
					<!-- Discount -->
					<table class="discount" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td align="center">
								<h1 class="f-fallback discount_heading">{{$event->title}}</h1>
								<p class="f-fallback discount_body">{{$event->description}}</p>

								<p class="f-fallback discount_body">Scheduled for: {{$event->start_at }} | <b>{{str_replace('_', ' ', $event->timezone)}} time</b></p>

								<table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
									<tr>
										<td align="center">
											<a href="" class="f-fallback button button--green" style="color: white !important;" target="_blank">View</a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<p>If you have any questions, feel free to <a href="mailto:support@o2oevents.com" style="color: black !important; font-weight: 600">email our customer success team</a>. (We're lightning quick at replying.)</p>
					<p>Thanks,
						<br>O2O Calendar Team</p>
					<!-- Sub copy -->
					<table class="body-sub" role="presentation">
						<tr>
							<td>
								<p class="f-fallback sub"><strong>P.S.</strong> Need immediate help getting started? Check out our <a href="support.o2oevents.com">help documentation</a>.</p>
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
@endsection