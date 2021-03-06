@extends('layouts.app')

@section('content')
<div class="container">
	
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="clearfix">
						<span class="pull-left">Reservations</span>
						<a href="{{ url('/jobs/reservations/create') }}" class="btn btn-xs pull-right">Add</a>
					</div>
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>
									Uuid
								</th>
								<th>
									Customer
								</th>
								<th>
									Reservation time
								</th>
								<th>
									Status
								</th>
								<th>
									Bill
								</th>
								<th>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($reservations as $reservation)
							<tr>
								<td>
									{{ $reservation->uuid }}
								</td>
								<td>
									{{ $reservation->name }}
								</td>
								<td>
									{{ $reservation->reserve_at->toDayDateTimeString() }}
								</td>
								<td>
									{{ $reservation->status }}
								</td>
								<td>
									{{ 'PHP ' . $reservation->total_bill }}
								</td>
								<td>
									<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-{{ $reservation->id }}">
										Details
									</button>

									<div class="modal fade" id="modal-{{ $reservation->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog modal-sm" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Job Details</h4>
												</div>
												<div class="modal-body">
													<table class="table">
														<thead>
															<tr>
																<th>
																	
																</th>
																<th>
																	
																</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	Uuid
																</td>
																<td>
																	{{ $reservation->uuid }}
																</td>
															</tr>
															<tr>
																<td>
																	Customer
																</td>
																<td>
																	{{ $reservation->name }}
								                                    <br/>
								                                    {{ $reservation->phone }}
																</td>
															</tr>
															<tr>
																<td>
																	Service Type
																</td>
																<td>
																	{{ $reservation->service_type }}
																</td>
															</tr>
															<tr>
																<td>
																	Kilogram
																</td>
																<td>
																	{{ $reservation->kilogram }}
																</td>
															</tr>
															<tr>
																<td>
																	Washer Mode
																</td>
																<td>
																	{{ $reservation->washer_mode }}
																</td>
															</tr>
															<tr>
																<td>
																	Dryer Mode
																</td>
																<td>
																	{{ $reservation->dryer_mode }}
																</td>
															</tr>
															<tr>
																<td>
																	Detergent
																</td>
																<td>
																	{{ $reservation->detergent_qty }} x {{ $reservation->detergent }}
																</td>
															</tr>
															<tr>
																<td>
																	Bleach
																</td>
																<td>
																	{{ $reservation->bleach_qty }} x {{ $reservation->bleach }}
																</td>
															</tr>
															<tr>
																<td>
																	Fabric Conditoner
																</td>
																<td>
																	{{ $reservation->fabric_conditioner_qty }} x {{ $reservation->fabric_conditioner }}
																</td>
															</tr>
															<tr>
																<td>
																	Services
																</td>
																<td>
																	<ul class="list-unstyled">
																		@if($reservation->is_press)
																		<li>Press</li>
																		@endif
																		@if($reservation->is_fold)
																		<li>Fold</li>
																		@endif
																	</ul>
																</td>
															</tr>
															<tr>
																<td>
																	Machine
																</td>
																<td>
																	<ul class="list-unstyled">
								                                        <li>{{ $reservation->washer ? $reservation->washer->name : '' }}</li>
								                                        <li>{{ $reservation->dryer ? $reservation->dryer->name : '' }}</li>
								                                     </ul>
																</td>
															</tr>
															<tr>
																<td>
																	Status
																</td>
																<td>
																	{{ $reservation->status }}
																</td>
															</tr>
															<tr>
																<td>
																	Total Bill
																</td>
																<td>
																	{{ $reservation->totalBill }}
																</td>
															</tr>
														</tbody>
													</table>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>

									@if($reservation->isEditable())
									<a href="{{ url('/jobs') . '/' . $reservation->id . '/edit' }}" class="btn btn-default btn-xs">Edit</a>
									@endif

									@if($reservation->status !== 'Approved')
									<form action="{{ url('/jobs/approve') . '/' . $reservation->id }}" method="POST">
										<button type="submit" class="btn btn-default btn-xs">Approve</button>
	                                    {{ csrf_field() }}
	                                    {{ method_field('PUT') }}
	                                </form>
	                                @endif
									<form action="{{ url('/jobs/decline') . '/' . $reservation->id }}" method="POST">
										<button type="submit" class="btn btn-danger btn-xs">Decline</button>
	                                    {{ csrf_field() }}
	                                    {{ method_field('PUT') }}
	                                </form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="clearfix">
						<span class="pull-left">Walk-in Pending</span>
						<a href="{{ url('/jobs/walk-ins/create') }}" class="btn btn-xs pull-right">Add</a>
					</div>
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>
									Uuid
								</th>
								<th>
									Customer
								</th>
								<th>
									Status
								</th>
								<th>
									Bill
								</th>
								<th>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($pendings as $pending)
							<tr>
								<td>
									{{ $pending->uuid }}
								</td>
								<td>
									{{ $pending->name }}
								</td>
								<td>
									{{ $pending->status }}
								</td>
								<td>
									{{ 'PHP ' . $pending->total_bill }}
								</td>
								<td>
									<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-{{ $pending->id }}">
										Details
									</button>

									<div class="modal fade" id="modal-{{ $pending->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog modal-sm" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Job Details</h4>
												</div>
												<div class="modal-body">
													<table class="table">
														<thead>
															<tr>
																<th>
																	
																</th>
																<th>
																	
																</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	Uuid
																</td>
																<td>
																	{{ $pending->uuid }}
																</td>
															</tr>
															<tr>
																<td>
																	Customer
																</td>
																<td>
																	{{ $pending->name }}
									                                <br/>
									                                {{ $pending->phone }}
																</td>
															</tr>
															<tr>
																<td>
																	Service Type
																</td>
																<td>
																	{{ $pending->service_type }}
																</td>
															</tr>
															<tr>
																<td>
																	Kilogram
																</td>
																<td>
																	{{ $pending->kilogram }}
																</td>
															</tr>
															<tr>
																<td>
																	Washer Mode
																</td>
																<td>
																	{{ $pending->washer_mode }}
																</td>
															</tr>
															<tr>
																<td>
																	Dryer Mode
																</td>
																<td>
																	{{ $pending->dryer_mode }}
																</td>
															</tr>
															<tr>
																<td>
																	Detergent
																</td>
																<td>
																	{{ $pending->detergent }} x {{ $pending->detergent }}
																</td>
															</tr>
															<tr>
																<td>
																	Bleach
																</td>
																<td>
																	{{ $pending->bleach_qty }} x {{ $pending->bleach }}
																</td>
															</tr>
															<tr>
																<td>
																	Fabric Conditoner
																</td>
																<td>
																	{{ $pending->fabric_conditioner_qty }} x {{ $pending->fabric_conditioner }}
																</td>
															</tr>
															<tr>
																<td>
																	Services
																</td>
																<td>
																	<ul class="list-unstyled">
																		@if($pending->is_press)
																		<li>Press</li>
																		@endif
																		@if($pending->is_fold)
																		<li>Fold</li>
																		@endif
																	</ul>
																</td>
															</tr>
															<tr>
																<td>
																	Machine
																</td>
																<td>
																	<ul class="list-unstyled">
									                                    <li>{{ $pending->washer ? $pending->washer->name : '' }}</li>
									                                    <li>{{ $pending->dryer ? $pending->dryer->name : '' }}</li>
									                                 </ul>
																</td>
															</tr>
															<tr>
																<td>
																	Status
																</td>
																<td>
																	{{ $pending->status }}
																</td>
															</tr>
															<tr>
																<td>
																	Total Bill
																</td>
																<td>
																	{{ $pending->totalBill }}
																</td>
															</tr>
														</tbody>
													</table>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>						

									@if($pending->isEditable())
									<a href="{{ url('/jobs') . '/' . $pending->id . '/edit' }}" class="btn btn-default btn-xs">Edit</a>
									@endif

									<form action="{{ url('/jobs/queue-washer') . '/' . $pending->id }}" method="POST">
                                        <button type="submit" class="btn btn-xs">Queue</button>
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                    </form>
									<form action="{{ url('/jobs/decline') . '/' . $pending->id }}" method="POST">
										<button type="submit" class="btn btn-danger btn-xs">Cancel</button>
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                    </form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		@foreach($washers as $machine)
		<div class="col-md-4">
			<div class="panel panel-default
			@if( $machine->washJobs()->pendingWasher()->count() > 0 )
			panel-warning
			@else
			panel-success
			@endif">
				<div class="panel-heading">
					{{ $machine->name }}
				</div>
				<div class="panel-body">
					@if( $machine->washJobs()->pendingWasher()->count() > 0 )
					<table class="table">
						<tr>
							<th>
								Uuid
							</th>
							<th>
								Customer Name
							</th>
							<th>
								Queue Number
							</th>
							<th></th>
						</tr>
						<?php $jobs = $machine->washJobs()->pendingWasher()->get(); ?>

						@foreach($jobs as $index => $job)
						@if( $index == 0 )
						<tr class="info">
						@else
						<tr>
						@endif
							<td>
								{{ $job->uuid }}
							</td>
							<td>
								{{ $job->name }}
							</td>
							<td>
								{{ $job->queue }}
							</td>
							<td>
								@if( $index == 0 )
								<form action="{{ url('/jobs/queue-dryer') . '/' . $job->id }}" method="POST">
									<button type="submit" class="btn btn-primary btn-xs">Done</button>
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                </form>
								@endif

								<form action="{{ url('/jobs/cancel') . '/' . $job->id }}" method="POST">
									<button type="submit" class="btn btn-danger btn-xs">Cancel</button>
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                </form>
							</td>
						</tr>
						@endforeach
					</table>
					@else
					Available!
					@endif
				</div>
			</div>
		</div>
		@endforeach
	</div>


	<div class="row">
		@foreach($dryers as $machine)
		<div class="col-md-4">
			<div class="panel panel-default
			@if( $machine->dryJobs()->pendingDryer()->count() > 0 )
			panel-warning
			@else
			panel-success
			@endif">
				<div class="panel-heading">
					{{ $machine->name }}
				</div>
				<div class="panel-body">
					@if( $machine->dryJobs()->pendingDryer()->count() > 0 )
					<table class="table">
						<tr>
							<th>
								Uuid
							</th>
							<th>
								Customer Name
							</th>
							<th>
								Queue
							</th>
							<th></th>
						</tr>
						@foreach($machine->dryJobs()->pendingDryer()->get() as $index => $job)
						@if( $index == 0 )
						<tr class="info">
						@else
						<tr>
						@endif
							<td>
								{{ $job->uuid }}
							</td>
							<td>
								{{ $job->name }}
							</td>
							<td>
								{{ $job->queue }}
							</td>
							<td>
								@if( $index == 0 )
								<form action="{{ url('/jobs/done') . '/' . $job->id }}" method="POST">
									<button type="submit" class="btn btn-primary btn-xs">Done</button>
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                </form>
								@endif

								<form action="{{ url('/jobs/cancel') . '/' . $job->id }}" method="POST">
									<button type="submit" class="btn btn-danger btn-xs">Cancel</button>
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                </form>
							</td>
						</tr>
						@endforeach
					</table>
					@else
					Available!
					@endif
				</div>
			</div>
		</div>
		@endforeach
	</div>

	@if($done->count() > 0)
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Done
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
                                <th>
                                    Uuid
                                </th>
                                <th>
                                    Customer
                                </th>
                                <th>
                                    Service Type
                                </th>
                                <th>
                                    Kilogram
                                </th>
                                <th>
                                    Washer Mode
                                </th>
                                <th>
                                    Dryer Mode
                                </th>
                                <th>
                                    Detergent
                                </th>
                                <th>
                                    Bleach
                                </th>
                                <th>
                                    Fabric Conditioner
                                </th>
                                <th>
                                    Services
                                </th>
                                <th>
                                    Machines
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Total Bill
                                </th>
                                <th></th>
                            </tr>
						</thead>
						<tbody>
							@foreach($done as $job)
                             <tr>
                                 <td>
                                     {{ $job->uuid }}
                                 </td>
                                 <td>
                                    {{ $job->name }}
                                    <br/>
                                    {{ $job->phone }}
                                 </td>
                                 <td>
                                     {{ $job->service_type }}
                                 </td>
                                 <td>
                                     {{ $job->kilogram }}
                                 </td>
                                 <td>
                                     {{ $job->washer_mode }}
                                 </td>
                                 <td>
                                     {{ $job->dryer_mode }}
                                 </td>
                                 <td>
                                     {{ $job->detergent }}
                                 </td>
                                 <td>
                                     {{ $job->bleach }}
                                 </td>
                                 <td>
                                     {{ $job->fabric_conditioner }}
                                 </td>
                                 <td>
                                     <ul class="list-unstyled">
                                         @if($job->is_press)
                                         <li>Press</li>
                                         @endif
                                         @if($job->is_fold)
                                         <li>Fold</li>
                                         @endif
                                     </ul>
                                 </td>
                                 <td>
                                    <ul class="list-unstyled">
                                        <li>{{ $job->washer ? $job->washer->name : '' }}</li>
                                        <li>{{ $job->dryer ? $job->dryer->name : '' }}</li>
                                     </ul>
                                 </td>
                                 <td>
                                     {{ $job->status }}
                                 </td>
                                 <td>
                                     {{ $job->totalBill }}
                                 </td>
                                 <td>
                                    <form action="{{ url('/jobs/paid') . '/' . $job->id }}" method="POST">
										<button type="submit" class="btn btn-xs">Paid</button>
	                                    {{ csrf_field() }}
	                                    {{ method_field('PUT') }}
                                	</form>
                                 </td>
                             </tr>
                            @endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@endif
</div>
@stop

@section('scripts')

@stop