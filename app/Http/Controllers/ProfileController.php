<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Property;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Number;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $requestData = $request->validated();
        unset($requestData['photo']);
        unset($requestData['social']);
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->has('photo')) {
            $path = $request->photo->store('profile');

            if ($request->user()->profile_photo_path) {
                Storage::delete($request->user()->profile_photo_path);
            }

            $request->user()->forceFill([
                'profile_photo_path' => $path
            ])->save();
        }

        $social = $request->social;

        if ($request->socialKey) {
            foreach ($request->socialKey as $index => $key) {
                $social[$key] = $request->socialValue[$index];
            }
        }

        $request->user()->forceFill([
            'socials' => $social
        ])->save();

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', __('Updated profile'));
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user->profile_photo_path) {
            Storage::delete($user->profile_photo_path);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function changePassword(Request $request)
    {
        $user = $request->user();

        return view('profile.change-password', compact('user'));
    }

    public function requestNewPassword(Request $request)
    {
        if (!auth()->user()) {
            return back();
        }

        Password::sendResetLink(['email' => $request->user()->email]);

        return back()->with(['status' => __('The link has been sent to your email')]);
    }

    public function listing(Request $request): View
    {
        $user = $request->user();
        $status = $request->query('status');
        $properties = $user->properties()
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status == 'published' ? 1 : ($status == 'draft' ? 0 : 2));
            })
            ->paginate(4);

        return view('profile.listing', compact('user', 'properties'));
    }

    public function wishlist(Request $request): View
    {
        $user = $request->user();

        $properties = Property::whereLikedBy($user->id) // find only articles where user liked them
            ->with('likeCounter') // highly suggested to allow eager load
            ->Published()
            ->get();

        return view('profile.wishlist', compact('user', 'properties'));
    }

    public function clearWishlist(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password'
        ]);

        DB::table('likeable_likes')->where('user_id', $request->user()->id)->delete();

        return back()->with(['status' => __('Your wish list has been cleaned')]);
    }

    public function reviews(Request $request): View
    {
        $user = $request->user();

        $reviewsAboutMe = $user->receivedReviews()->paginate(4, ['*'], 'reviews_about_me');
        $average = str_replace('.', ',', $user->reviewsAvgDecimal);

        $reviewsByMe = $user->reviews()->paginate(4, ['*'], 'reviews_by_me');

        return view('profile.reviews', compact('user', 'reviewsAboutMe', 'reviewsByMe', 'average'));
    }

    public function notifications(Request $request): View
    {
        $user = $request->user();

        return view('profile.notifications', compact('user'));
    }

    public function updateNotifications(Request $request)
    {
        $user = $request->user();
        $notifications = array_merge($request->rentnotifications ?? [], $request->salenotifications ?? [], $request->bothnotifications ?? []);

        $user->notifications = $notifications;
        $user->save();

        return back()->with(['status' => __('Notifications have been updated')]);
    }

    public function changeStatusListing(Request $request, Property $listing)
    {
        $request->validate([
            'status' => 'required'
        ]);

        if ($listing->status->value == $request->status) {
            return back()->with(['status' => __('This property already has that status')]);
        }

        $listing->status = $request->status;
        $listing->save();


        return back()->with(['status' => __('Status has been updated')]);
    }

    public function destroyListing(Request $request, Property $listing)
    {
        $request->validate([
            'password' => 'required|current_password'
        ]);

        return dd($listing);
    }

    public function destroyAllListing(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password',
            'status' => 'required'
        ]);

        $properties = Property::where('status', $request->status == 'published' ? 1 : ($request->status == 'draft' ? 0 : 2))->get();

        return dd($properties);
    }
}
