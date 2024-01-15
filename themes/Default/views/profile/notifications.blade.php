@extends('profile.layout', [
    'before' => [
        'Home' => route('home'),
        'Account' => route('profile.edit'),
    ],
    'active' => __('Notifications'),
])
@section('content')
				<h1 class="h2">{{ __('Notifications') }}</h1>
				<p class="mb-4 pt-1">{{ __('Get real-time updates on your favorite homes, neighborhoods, and more') }}.</p>
				<!-- Nav tabs-->
				<ul class="nav nav-tabs flex-column flex-sm-row align-items-stretch align-items-sm-start border-bottom mb-4"
								role="tablist">
								<li class="nav-item me-sm-3 mb-3">
												<a class="nav-link active text-center" href="#notifications-rent" data-bs-toggle="tab" role="tab"
																aria-controls="notifications-rent" aria-selected="true">{{ __('Rent notifications') }}</a>
								</li>
								<li class="nav-item mb-3">
												<a class="nav-link text-center" href="#notifications-sale" data-bs-toggle="tab" role="tab"
																aria-controls="notifications-sale" aria-selected="false">{{ __('Sale notifications') }}</a>
								</li>
				</ul>
				<form action="{{ route('profile.notifications.update') }}" method="POST">
								@csrf
								@method('PATCH')
								<!-- Tabs content-->
								<div class="tab-content py-2" id="notification-settings">
												<!-- Rent notifications tab-->
												<div class="tab-pane fade show active" id="notifications-rent" role="tabpanel">
																<div class="d-flex justify-content-between mb-4">
																				<div class="me-2">
																								<h6 class="mb-1">{{ __('New rental alerts') }}</h6>
																								<p class="fs-sm mb-0">{{ __('New rentals that match your') }}
																												<a href='{{ route('profile.wishlist') }}'>{{ __('Wishlist') }}</a>
																								</p>
																				</div>
																				<div class="form-check form-switch">
																								<input name="rentnotifications[]" value="new-rental" @checked(in_array('new-rental', $user->notificationsArray))
																												class="form-check-input" type="checkbox" id="new-rental">
																								<label class="form-check-label" for="new-rental"></label>
																				</div>
																</div>
																<div class="d-flex justify-content-between mb-4">
																				<div class="me-2">
																								<h6 class="mb-1">{{ __('Rental status updates') }}</h6>
																								<p class="fs-sm mb-0">{{ __('Updates like price changes and off-market status on your') }}
																												<a href='{{ route('profile.wishlist') }}'>{{ __('Wishlist') }}</a>
																								</p>
																				</div>
																				<div class="form-check form-switch">
																								<input name="rentnotifications[]" value="rental-update" @checked(in_array('rental-update', $user->notificationsArray))
																												class="form-check-input" type="checkbox" id="rental-update">
																								<label class="form-check-label" for="rental-update"></label>
																				</div>
																</div>
																<div class="d-flex justify-content-between mb-4">
																				<div class="me-2">
																								<h6 class="mb-1">{{ __(':site recommendations', ['site' => setting('site_name')]) }}</h6>
																								<p class="fs-sm mb-0">
																												{{ __('Rentals we think you\'ll like. These recommendations may be slightly outside your search criteria') }}
																								</p>
																				</div>
																				<div class="form-check form-switch">
																								<input name="rentnotifications[]" value="rental-recomendation" @checked(in_array('rental-recomendation', $user->notificationsArray))
																												class="form-check-input" type="checkbox" id="rental-recomendation">
																								<label class="form-check-label" for="rental-recomendation"></label>
																				</div>
																</div>
												</div>
												<!-- Sale notifications tab-->
												<div class="tab-pane fade" id="notifications-sale" role="tabpanel">
																<div class="d-flex justify-content-between mb-4">
																				<div class="me-2">
																								<h6 class="mb-1">{{ __('New sale alerts') }}</h6>
																								<p class="fs-sm mb-0">{{ __('New sales that match your ') }} <a
																																href='{{ route('profile.wishlist') }}'>{{ __('Wishlist') }}</a></p>
																				</div>
																				<div class="form-check form-switch">
																								<input name="salenotifications[]" @checked(in_array('new-sale', $user->notificationsArray)) value="new-sale"
																												class="form-check-input" type="checkbox" id="new-sale">
																								<label class="form-check-label" for="new-sale"></label>
																				</div>
																</div>
																<div class="d-flex justify-content-between mb-4">
																				<div class="me-2">
																								<h6 class="mb-1">{{ __('Sale status updates') }}</h6>
																								<p class="fs-sm mb-0">{{ __('Updates like price changes and off-market status on your') }} <a
																																href='{{ route('profile.wishlist') }}'>{{ __('Wishlist') }}</a></p>
																				</div>
																				<div class="form-check form-switch">
																								<input name="salenotifications[]" @checked(in_array('sale-update', $user->notificationsArray)) value="sale-update"
																												class="form-check-input" type="checkbox" id="sale-update">
																								<label class="form-check-label" for="sale-update"></label>
																				</div>
																</div>
																<div class="d-flex justify-content-between mb-4">
																				<div class="me-2">
																								<h6 class="mb-1">{{ __(':site recommendations', ['site' => setting('site_name')]) }}</h6>
																								<p class="fs-sm mb-0">
																												{{ __('Sales we think you\'ll like. These recommendations may be slightly outside your search criteria') }}
																								</p>
																				</div>
																				<div class="form-check form-switch">
																								<input name="salenotifications[]" value="sale-recomendation" @checked(in_array('sale-recomendation', $user->notificationsArray))
																												class="form-check-input" type="checkbox" id="sale-recomendation">
																								<label class="form-check-label" for="sale-recomendation"></label>
																				</div>
																</div>
												</div>
												<div class="d-flex justify-content-between mb-4">
																<div class="me-2">
																				<h6 class="mb-1">{{ __('Featured news') }}</h6>
																				<p class="fs-sm mb-0">{{ __('News and tips you may be interested in') }}</p>
																</div>
																<div class="form-check form-switch">
																				<input name="bothnotifications[]" value="featured-news" @checked(in_array('featured-news', $user->notificationsArray))
																								class="form-check-input" type="checkbox" id="featured-news">
																				<label class="form-check-label" for="featured-news"></label>
																</div>
												</div>
												<div class="d-flex justify-content-between mb-4">
																<div class="me-2">
																				<h6 class="mb-1">{{ __(':site extras', ['site' => setting('site_name')]) }}</h6>
																				<p class="fs-sm mb-0">
																								{{ __('Occasional notifications about new features to make finding the perfect rental easy') }}</p>
																</div>
																<div class="form-check form-switch">
																				<input name="bothnotifications[]" value="extras" @checked(in_array('extras', $user->notificationsArray))
																								class="form-check-input" type="checkbox" id="extras">
																				<label class="form-check-label" for="extras"></label>
																</div>
												</div>
								</div>
								<div class="border-top pt-4">
												<div class="form-check form-switch">
																<input class="form-check-input" type="checkbox" id="all-notifications"
																				data-master-checkbox-for="#notification-settings">
																<label class="form-check-label"
																				for="all-notifications">{{ __('Enable / disable all notifications') }}</label>
												</div>
								</div>
								<div class="d-flex mt-3">
												<button class="btn btn-primary">{{ __('Save changes') }}</button>
								</div>
				</form>
@endsection
