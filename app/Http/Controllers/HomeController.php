<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Currency;
use App\Models\FrontSection;
use App\Models\ListingAs;
use App\Models\Message;
use App\Models\Page;
use App\Models\Property;
use App\Models\Review;
use App\Models\TemporaryFile;
use App\Models\User;
use App\Models\Facility;
use App\Models\Outdoor;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HomeController extends Controller
{
    public function checkout(Package $package)
    {
        return view('checkout', compact('package'));
    }
    public function createIntent(Request $request)
    {
        try {
            $stripe = new \Stripe\StripeClient('sk_test_51OZaFOBuGIglNGvFd4i84yU0iUA3ZW89O9dP1MrpBlvc8BgZajLTlCdzBeFvdPsROS6h4CCkAKvQQn7wSEKVpv4400RSHQivN6');

            $package = Package::findOrfail($request->package_id);

            $response = $stripe->paymentIntents->create([
                'amount' => $package->only_price * 100,
                'currency' => currency()->getUserCurrency(),
                'automatic_payment_methods' => ['enabled' => true],
            ]);

            return response()->json(['data' => $response, 'package_id' => $package->id]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th]);
        }
    }
    function calculateEndDate($package)
    {
        switch ($package->interval) {
            case 'day':
                return now()->addDays($package->duration);
            case 'week':
                return now()->addWeeks($package->duration);
            case 'month':
                return now()->addMonths($package->duration);
            case 'year':
                return now()->addYears($package->duration);
            default:
                return null;
        }
    }
    public function buyPlan(Request $request)
    {
        try {
            $package = Package::findOrFail($request->package_id);

            $request->user()->packages()->detach();

            $request->user()->packages()->sync([
                $package->id => [
                    'start_at' => now(),
                    'end_at' => $package->duration > 0 ? $this->calculateEndDate($package) : null,
                    'limit_listing' => $package->listing_limit,
                    'limit_ads' => $package->ads_limit
                ]
            ]);

            return response()->json(['data' => __('You have subscribed to this new plan')]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th]);
        }
    }
    public function successPurchased()
    {
        return view('success');
    }
    public function changeCurrency($currency)
    {
        $previousUrl = url()->previous();

        if (str_contains($previousUrl, 'currency=')) {
            $url = preg_replace('/(currency=.{3})/', 'currency=' . $currency, $previousUrl);
        } else {
            $url = $previousUrl . (str_contains($previousUrl, '?') ? '&' : '?') . 'currency=' . $currency;
        }

        return redirect($url);
    }

    public function index()
    {
        $page = Page::findOrFail(setting('site_homepage_page'));

        return view('index', compact('page'));
    }

    public function agentListing(User $agent)
    {
        $rents = $agent->properties()->where('property_type', 1)->paginate(9, ['*'], 'pages_for_rents');
        $sales =
            $agent->properties()->where('property_type', 0)->paginate(9, ['*'], 'pages_for_sales');

        return view('agent', compact('agent', 'rents', 'sales'));
    }

    public function agentReviewsListing(User $agent)
    {
        $reviews = $agent->receivedReviews()->paginate(5, ['*'], 'reviews_about_me');

        $avgFive = $agent->properties->map(function ($property) {
            return $property->reviews->where('stars', 5)->avg('stars') * 20;
        })->sum();

        $avgFour = $agent->properties->map(function ($property) {
            return $property->reviews->where('stars', 4)->avg('stars') * 20;
        })->sum();

        $avgThree = $agent->properties->map(function ($property) {
            return $property->reviews->where('stars', 3)->avg('stars') * 20;
        })->sum();

        $avgTwo = $agent->properties->map(function ($property) {
            return $property->reviews->where('stars', 2)->avg('stars') * 20;
        })->sum();

        $avgOne = $agent->properties->map(function ($property) {
            return $property->reviews->where('stars', 1)->avg('stars') * 20;
        })->sum();

        // Suma total de todos los valores
        $total = $avgFive + $avgFour + $avgThree + $avgTwo + $avgOne;

        // Normaliza los valores para que sumen 100%
        $avgFive = ($total > 0) ? Number::forHumans(($avgFive / $total) * 100) : 0;
        $avgFour = ($total > 0) ? Number::forHumans(($avgFour / $total) * 100) : 0;
        $avgThree = ($total > 0) ? Number::forHumans(($avgThree / $total) * 100) : 0;
        $avgTwo = ($total > 0) ? Number::forHumans(($avgTwo / $total) * 100) : 0;
        $avgOne = ($total > 0) ? NUmber::forHumans(($avgOne / $total) * 100) : 0;

        return view('agent_reviews', compact('agent', 'reviews', 'avgFive', 'avgFour', 'avgThree', 'avgTwo', 'avgOne'));
    }

    public function addListing()
    {
        abort_unless(request()->user()->propertiesRestants > 0, 419);

        $property = new Property();
        $types = Category::PropertyType()->get();
        $listingAs = ListingAs::all();
        $outdoors = Outdoor::all();

        return view('add_listing', compact('property', 'types', 'listingAs', 'outdoors'));
    }

    public function editListing(Property $property)
    {
        abort_unless(request()->user()->propertiesRestants > 0, 419);

        $types = Category::PropertyType()->get();
        $listingAs = ListingAs::all();
        $outdoors = Outdoor::all();

        return view('edit_listing', compact('property', 'types', 'listingAs', 'outdoors'));
    }

    public function storeListing(Request $request)
    {
        abort_unless($request->user()->propertiesRestants > 0, 419);

        if ($request->user()->propertiesRestants <= 0) {
            return back()->with(['status' => __('You need to buy a new plan, you no longer have properties')]);
        }

        $package =  $request->user()->packages()->first();
        $package->pivot->increment('used_listing');

        $property = $this->saveListing($request);

        return to_route('home.listing.edit', $property)->with(['status' => __('The property has been added')]);
    }

    public function updateListing(Request $request, Property $property)
    {
        abort_unless($request->user()->havePlanActive, 419);

        $this->saveListing($request, $property);

        return back()->with(['status' => __('The property has been updated')]);
    }

    public function saveListing($request, $property = new Property())
    {

        $request->validate([
            'title' => 'required',
            'property_type' => 'required',
            'category_id' => 'required|exists:categories,id',
            'rent_interval' => 'required_if:property_type,1',
            'rent_duration' => 'required_if:property_type,1',
            'listing_as_id' => 'required|exists:listing_as,id',
            'address' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'outdoors.*' => 'nullable|max:255',
            'description' => 'required|string',
            'price' => 'required',
            'contact.*' => 'nullable|max:255'
        ]);

        $contact = [];

        if ($request->contact) {
            foreach ($request->contact as $k => $v) {
                $contact[] = ['key' => $k, 'value' => $v];
            }
        }

        $property->title = $request->title;
        $property->category_id = $request->category_id;
        $property->property_type = $request->property_type;
        $property->rent_interval = $request->rent_interval;
        $property->rent_duration = $request->rent_duration;
        $property->listing_as_id = $request->listing_as_id;
        $property->country = $request->country;
        $property->city = $request->city;
        $property->state = $request->state;
        $property->zip_code = $request->zip_code;
        $property->address = $request->address;
        $property->contact = $contact;
        $property->description = $request->description;
        $property->user_id = $request->user()->id;

        $property->save();

        if ($request->main_image) {

            $temporary = TemporaryFile::where('folder', $request->main_image)->first();
            if ($temporary) {

                if ($property->main_image) {
                    Storage::delete($property->main_image);
                }

                $file = Storage::get('temp/' . $request->main_image . '/' . $temporary->filename);

                Storage::put('properties/' . $temporary->filename, $file);

                // Realizar el movimiento del archivo
                $property->forceFill([
                    'main_image' => 'properties/' . $temporary->filename
                ])->save();

                //Delete Folder
                if (Storage::directoryExists(storage_path('app/public/temp/' . $request->main_image))) {
                    Storage::deleteDirectory('/temp/' . $request->main_image);
                }

                $temporary->delete();
            }
        }

        if ($request->has('gallery')) {
            $medias = [];
            $temps = [];

            foreach ($request->gallery as $image) {
                $temporary = TemporaryFile::where('folder', $image)->first();
                if ($temporary) {
                    $temps[$image] = $temporary;
                }

                if (parse_url($image)) {
                    // Dividir la URL por la barra inclinada ("/")
                    $segmentos = explode('/', $image);
                    // Filtrar los elementos vacíos del array resultante
                    $segmentos = array_filter($segmentos);
                    // Obtener el último valor después de la última barra
                    $ultimo_valor = end($segmentos);

                    $media = Media::where('file_name', $ultimo_valor)->first();

                    if ($media) {
                        $medias[] = $media;
                    }
                }
            }

            if (count($medias) > 0) {
                $property->clearMediaCollectionExcept('gallery', $medias);
            } else {
                $property->clearMediaCollection('gallery');
            }

            foreach ($temps as $image => $temporary) {
                if ($temporary) {
                    $property
                        ->addMediaFromUrl(Storage::url('temp/' . $image . '/' . $temporary->filename))
                        ->toMediaCollection('gallery');

                    //Delete Folder
                    if (Storage::directoryExists(storage_path('app/public/temp/' . $image))) {
                        Storage::deleteDirectory('/temp/' . $image);
                    }

                    $temporary->delete();
                }
            }
        }

        if ($request->price) {
            $keyEnd = [];
            foreach ($request->price as $k => $v) {
                $keyEnd[$k] = ['price' => str_replace('.', '', str_replace(',', '', $v))];
            }

            $property->prices()->sync($keyEnd);
        }


        if ($request->outdoors) {
            $keyEnd = [];
            $filtered = array_filter($request->outdoors, fn ($i) => $i != null);
            foreach ($filtered as $k => $v) {
                $keyEnd[$k] = ['distance' => $v];
            }

            $property->outdoors()->sync($keyEnd);
        }

        if ($request->details) {
            $keyEnd = [];

            foreach ($request->details as $k => $v) {
                if (is_array($v)) {
                    $keyEnd[$k] = ['value' => implode(',', $v)];
                } else {
                    $keyEnd[$k] = ['value' => $v];
                }
            }

            $property->facilities()->sync($keyEnd);
        }

        return $property;
    }

    public function showListing(Property $property)
    {
        if ($property->status->value != 1 && request()->user()?->id !== $property->user_id) {
            abort(404);
        }

        $recents = [];
        $sortByReviews = request()->query('sort_by');
        $average = str_replace('.', ',', $property->reviews->avg('stars'));

        $reviews = $property->reviews()
            ->when($sortByReviews, function ($query) use ($sortByReviews) {
                return match ($sortByReviews) {
                    'asc' => $query,
                    'desc' => $query->orderByDesc('created_at'),
                    'high' => $query->orderByDesc('stars'),
                    'low' => $query->orderBy('stars'),
                    'popular' => $query->orderBy(DB::table('likeable_like_counters')->select('count')->whereColumn('likeable_like_counters.likeable_id', 'reviews.id'), 'desc'),
                    default => $query->orderByDesc('created_at')
                };
            })
            ->paginate(4, ['*'], 'reviews_page');

        $recents = Property::whereNot('id', $property->id)->limit(4)->get();

        return view('single_listing', compact('property', 'reviews', 'average', 'recents'));
    }

    public function searchListing(Request $request)
    {
        $city = $request->query('city');
        $property_type = $request->query('property_type');
        $for = $request->query('for');
        $posted = $request->query('posted');
        $verified = $request->query('verified');
        $featured = $request->query('featured');
        $options = $request->query('options');
        $sort = $request->query('sort_by');
        $min_price = $request->query('min_price');
        $max_price = $request->query('max_price');
        $facility = $request->query('facility');
        $terms = $request->query('terms');
        $checks = $request->query('checks');

        $facilities = Facility::all();

        $types = Category::PropertyType()->get();

        $properties = Property::query()
            ->when($city, function ($query) use ($city) {
                return $query->where('address', 'like', '%' . $city . '%');
            })
            ->when($property_type, function ($query) use ($property_type) {
                return $query->whereHas('category', function ($builder) use ($property_type) {
                    return $builder->whereIn('categories.id', $property_type);
                });
            })
            ->when($for, function ($query) use ($for) {
                return $query->where('property_type', $for == 'sale' ? 0 : 1);
            })
            ->when($posted, function ($query) use ($posted) {
                return $query->where(function ($builder) use ($posted) {
                    return match ($posted) {
                        'lastweek' => $builder->where('created_at', '>=', now()->subWeek()),
                        'yesterday' => $builder->whereDate('created_at', now()->yesterday()),
                        default => $builder,
                    };
                });
            })
            ->when($options, function ($query) use ($options) {
                return $query->when(in_array('featured', $options), function ($query) {
                    return $query->where(function ($query) {
                        $query->whereNotNull('featured')
                            ->when(in_array('verified', request()->query('options')), function ($query) {
                                $query->orWhereNotNull('verified');
                            });
                    });
                })
                    ->when(in_array('verified', $options), function ($query) {
                        return $query->where(function ($query) {
                            $query->whereNotNull('verified')
                                ->when(in_array('featured', request()->query('options')), function ($query) {
                                    $query->orWhereNotNull('featured');
                                });
                        });
                    })
                    ->when(in_array('new', $options), function ($query) {
                        return $query->where(function ($query) {
                            $query->whereDate('created_at', '>=', now()->subDays(7));
                        });
                    });
            })
            ->when($min_price, function ($query) use ($min_price) {
                return $query->whereHas('prices', function ($query) use ($min_price) {
                    return $query->where('currency_id', currency_active())
                        ->where('price', '>=', $min_price);
                });
            })
            ->when($max_price, function ($query) use ($max_price) {
                return $query->whereHas('prices', function ($query) use ($max_price) {
                    return $query->where('currency_id', currency_active())
                        ->where('price', '<=', $max_price);
                });
            })
            ->when($facility, function ($query) use ($facility) {
                return $query->whereHas('facilities', function ($query) use ($facility) {
                    $facilityIds = array_keys($facility);
                    $facilityValues = array_values($facility);

                    return $query->whereIn('facility_id', $facilityIds)
                        ->whereIn('value', $facilityValues);
                });
            })
            ->when($terms, function ($query) use ($terms) {

                $termsFilted = array_filter($terms, function ($value) {
                    return $value !== null;
                });
                if ($termsFilted != []) {
                    return $query->whereHas('facilities', function ($query) use ($terms) {
                        $facilityIds = array_keys($terms);
                        $facilityValues = array_values($terms);
                        return $query->whereIn('facility_id', $facilityIds)
                            ->where('value', 'like', '%' . implode('', $facilityValues) . '%');
                    });
                } else {
                    return $query;
                }
            })
            ->when($checks, function ($query) use ($checks) {
                return $query->whereHas('facilities', function ($query) use ($checks) {
                    foreach ($checks as $facilityId => $facilityValues) {
                        $query->where(function ($subquery) use ($facilityId, $facilityValues) {
                            $subquery->where('facility_id', $facilityId)
                                ->whereIn('value', $facilityValues);
                        });
                    }
                });
            })
            ->when($sort, function ($query) use ($sort) {
                return match ($sort) {
                    'newest' => $query->orderByDesc('created_at'),
                    'popularity' => $query->withCount('likes')->orderBy('likes_count', 'desc'),
                    'low-high-price' => $query->orderBy(
                        DB::table('currency_property')
                            ->select('price')
                            ->where('currency_property.currency_id', '=', currency_active())
                            ->whereColumn('currency_property.property_id', 'properties.id')
                    ),
                    'high-low-price' => $query->orderBy(
                        DB::table('currency_property')
                            ->select('price')
                            ->where('currency_property.currency_id', '=', currency_active())
                            ->whereColumn('currency_property.property_id', 'properties.id'),
                        'desc'
                    ),
                    'high-rating' => $query->withCount('reviews')->orderBy('reviews_count', 'desc'),
                    'average-rating' => $query->withAvg('reviews', 'stars')->orderBy('reviews_avg_stars', 'desc'),
                    default => $query,
                };
            })
            ->Published()
            ->paginate(9);

        return view('search', compact('types', 'properties', 'facilities'));
    }

    public function showPage(Page $page)
    {
        return view('single_page', compact('page'));
    }

    public function sendMessage(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'message' => 'required',
            'date' => 'nullable|date|after_or_equal:' . now()
        ]);

        if ($request->receiver_id == $user->id) {
            return back()->with(['error' => __('You cannot send messages yourself')]);
        }

        $user->sents()->create([
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'booking' => $request->date
        ]);


        return back()->with(['status' => __('Your message has been sent')]);
    }

    public function uploadFile(Request $request)
    {
        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . '-' . now()->timestamp . '.' . $extension;
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('temp/' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
                'extension' => $extension
            ]);

            return $folder;
        }

        if ($request->hasFile('gallery')) {
            $file = $request->gallery[0];
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . '-' . now()->timestamp . '.' . $extension;
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('temp/' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
                'extension' => $extension
            ]);

            return $folder;
        }

        return '';
    }

    public function RemoveFile(Request $request)
    {
        $temp = TemporaryFile::where('folder', $request->uniqueFileId)->first();
        if ($temp) {
            $temp->delete();
        }

        //Delete Folder
        if (Storage::directoryExists('temp/' . $request->uniqueFileId)) {
            Storage::deleteDirectory('/temp/' . $request->uniqueFileId);
        }

        return response()->json([
            'status' => 1,
        ]);
    }

    public function storeReview(Request $request, Property $property)
    {
        $request->validate([
            'message' => 'required',
            'stars' => 'required|integer'
        ]);

        $property->reviews()->create([
            'message' => $request->message,
            'stars' => $request->stars,
            'user_id' => $request->user()->id
        ]);

        return redirect(url()->previous() . '#reviews')->with(['status' => __('Your review has been sent')]);
    }

    public function likeProperty($property)
    {
        $property = Property::findOrFail($property);

        if (!$property->liked()) {
            $property->like(); // add like from the property
        } else {
            $property->unlike(); // remove like from the property
        }


        return response()->json([
            'status' => 1,
            'count' => $property->likeCount
        ]);
    }
    public function likeReview($model)
    {
        $review = Review::findOrFail($model);

        if (!$review->liked()) {
            $review->like(); // add like from the review
        } else {
            $review->unlike(); // remove like from the review
        }


        return response()->json([
            'status' => 1,
            'count' => $review->likeCount
        ]);
    }
}
