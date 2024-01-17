<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ListingAs;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListingAsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ListingAs::create([
            'title' => 'I am a registered business'
        ]);
        ListingAs::create([
            'title' => 'I am a private seller'
        ]);


        $home = Category::create([
            'title' => 'HOME IMPROVEMENT',
            'type' => 'post'
        ]);
        $tips = Category::create([
            'title' => 'TIPS & ADVICE',
            'type' => 'post'
        ]);

        $how = Post::create([
            'title' => 'How Real Estate Drone Photography Can Elevate Your Listing?',
            'template' => 'default',
            'content' => '<h6 style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; line-height: 1.4; color: #1f1b2d; font-size: 1.125rem; -webkit-font-smoothing: antialiased; font-family: \'Noto Sans\', sans-serif;">Feugiat eget gravida urna placerat posuere pulvinar. Id&nbsp;nibh hendrerit semper urna consequat. Mauris elit tellus risus ultricies ut&nbsp;consequat. Tempor tellus imperdiet nec velit fames pellentesque sed sed arcu. Neque quam id&nbsp;pellentesque in&nbsp;diam&nbsp;in.</h6>
<p style="font-size: 16px; box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased; caret-color: #666276; color: #666276; font-family: \'Noto Sans\', sans-serif;">Purus ornare nisl est&nbsp;nec. Nunc, enim tellus pretium viverra quisque id&nbsp;in&nbsp;metus volutpat. Urna eget velit venenatis, commodo eget massa. Magna donec dictum cras nullam platea. Diam rhoncus massa lectus pellentesque tristique. Amet commodo, egestas vitae bibendum. Volutpat elit condimentum integer tortor porttitor justo vel lobortis risus. Lacinia pellentesque fermentum tellus orci mauris, velit duis eget. Commodo justo, hac ligula molestie felis, iaculis. Vitae dui at&nbsp;ante orci, dictum fusce. Urna, sed urna fringilla faucibus euismod aliquet&nbsp;nec. Quis libero, fermentum amet eu, condimentum auctor. Sit vel ipsum sem tempus gravida&nbsp;et. Scelerisque blandit orci, est quis. Nisi, tellus amet est nascetur habitant faucibus ornare et&nbsp;vivamus.</p>
<p style="font-size: 16px; box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased; caret-color: #666276; color: #666276; font-family: \'Noto Sans\', sans-serif;">Convallis massa nunc, tempus eget egestas sollicitudin mauris. Purus donec sed neque arcu, dictumst tortor nisi, odio. A&nbsp;sit lectus sem velit orci, rhoncus pharetra facilisis. Cras sodales a, dui pellentesque enim odio rutrum&nbsp;leo. Auctor viverra sit sit&nbsp;ut. Massa, elit venenatis, ultrices viverra at&nbsp;sagittis, velit. Cursus tempus phasellus consectetur suspendisse a&nbsp;blandit pellentesque diam neque. Massa est nibh congue elit amet, diam faucibus. Morbi non est semper ullamcorper quam iaculis&nbsp;at.</p>
<blockquote class="blockquote" style="box-sizing: border-box; margin: 0px 0px 1.25rem; -webkit-font-smoothing: antialiased; font-size: 1.125rem; position: relative; color: #1f1b2d; font-weight: bold; font-family: \'Noto Sans\', sans-serif;">
<p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
<footer class="fs-base" style="box-sizing: border-box; -webkit-font-smoothing: antialiased; margin-bottom: 0px; font-size: 1rem !important;">&mdash; Annette Black</footer></blockquote>
<p style="font-size: 16px; box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased; caret-color: #666276; color: #666276; font-family: \'Noto Sans\', sans-serif;">Praesent sed pulvinar posuere nisl tincidunt. Iaculis sit quam magna congue. Amet vel non aliquet habitasse. Egestas erat odio et, eleifend turpis etiam blandit interdum. Nec augue ut&nbsp;senectus quisque diam quis. At&nbsp;augue accumsan, in&nbsp;bibendum. A&nbsp;eget et, eget quisque egestas netus&nbsp;vel. Velit, aliquet turpis convallis ullamcorper. Scelerisque sagittis condimentum pretium in&nbsp;vitae etiam lacinia quis amet. Porttitor consequat, sollicitudin vivamus pharetra nibh faucibus neque, viverra. Praesent amet sed lacus vitae.</p>
<p style="font-size: 16px; box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased; caret-color: #666276; color: #666276; font-family: \'Noto Sans\', sans-serif;">Velit parturient tellus tellus, congue pulvinar tellus viverra. In cum massa mattis ac. Amet vitae massa ut mi etiam. Auctor aliquam tristique felis donec eu sit nisi. Accumsan mauris eget convallis mattis sed etiam scelerisque.</p>',
            'user_id' => 1,
            'allowed_comment' => true
        ]);

        $your = Post::create([
            'title' => 'Your Guide to a Smart Apartment Searching',
            'template' => 'default',
            'content' => '<h6 style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; line-height: 1.4; color: #1f1b2d; font-size: 1.125rem; -webkit-font-smoothing: antialiased; font-family: \'Noto Sans\', sans-serif;">Feugiat eget gravida urna placerat posuere pulvinar. Id&nbsp;nibh hendrerit semper urna consequat. Mauris elit tellus risus ultricies ut&nbsp;consequat. Tempor tellus imperdiet nec velit fames pellentesque sed sed arcu. Neque quam id&nbsp;pellentesque in&nbsp;diam&nbsp;in.</h6>
<p style="font-size: 16px; box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased; caret-color: #666276; color: #666276; font-family: \'Noto Sans\', sans-serif;">Purus ornare nisl est&nbsp;nec. Nunc, enim tellus pretium viverra quisque id&nbsp;in&nbsp;metus volutpat. Urna eget velit venenatis, commodo eget massa. Magna donec dictum cras nullam platea. Diam rhoncus massa lectus pellentesque tristique. Amet commodo, egestas vitae bibendum. Volutpat elit condimentum integer tortor porttitor justo vel lobortis risus. Lacinia pellentesque fermentum tellus orci mauris, velit duis eget. Commodo justo, hac ligula molestie felis, iaculis. Vitae dui at&nbsp;ante orci, dictum fusce. Urna, sed urna fringilla faucibus euismod aliquet&nbsp;nec. Quis libero, fermentum amet eu, condimentum auctor. Sit vel ipsum sem tempus gravida&nbsp;et. Scelerisque blandit orci, est quis. Nisi, tellus amet est nascetur habitant faucibus ornare et&nbsp;vivamus.</p>
<p style="font-size: 16px; box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased; caret-color: #666276; color: #666276; font-family: \'Noto Sans\', sans-serif;">Convallis massa nunc, tempus eget egestas sollicitudin mauris. Purus donec sed neque arcu, dictumst tortor nisi, odio. A&nbsp;sit lectus sem velit orci, rhoncus pharetra facilisis. Cras sodales a, dui pellentesque enim odio rutrum&nbsp;leo. Auctor viverra sit sit&nbsp;ut. Massa, elit venenatis, ultrices viverra at&nbsp;sagittis, velit. Cursus tempus phasellus consectetur suspendisse a&nbsp;blandit pellentesque diam neque. Massa est nibh congue elit amet, diam faucibus. Morbi non est semper ullamcorper quam iaculis&nbsp;at.</p>
<blockquote class="blockquote" style="box-sizing: border-box; margin: 0px 0px 1.25rem; -webkit-font-smoothing: antialiased; font-size: 1.125rem; position: relative; color: #1f1b2d; font-weight: bold; font-family: \'Noto Sans\', sans-serif;">
<p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
<footer class="fs-base" style="box-sizing: border-box; -webkit-font-smoothing: antialiased; margin-bottom: 0px; font-size: 1rem !important;">&mdash; Annette Black</footer></blockquote>
<p style="font-size: 16px; box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased; caret-color: #666276; color: #666276; font-family: \'Noto Sans\', sans-serif;">Praesent sed pulvinar posuere nisl tincidunt. Iaculis sit quam magna congue. Amet vel non aliquet habitasse. Egestas erat odio et, eleifend turpis etiam blandit interdum. Nec augue ut&nbsp;senectus quisque diam quis. At&nbsp;augue accumsan, in&nbsp;bibendum. A&nbsp;eget et, eget quisque egestas netus&nbsp;vel. Velit, aliquet turpis convallis ullamcorper. Scelerisque sagittis condimentum pretium in&nbsp;vitae etiam lacinia quis amet. Porttitor consequat, sollicitudin vivamus pharetra nibh faucibus neque, viverra. Praesent amet sed lacus vitae.</p>
<p style="font-size: 16px; box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased; caret-color: #666276; color: #666276; font-family: \'Noto Sans\', sans-serif;">Velit parturient tellus tellus, congue pulvinar tellus viverra. In cum massa mattis ac. Amet vitae massa ut mi etiam. Auctor aliquam tristique felis donec eu sit nisi. Accumsan mauris eget convallis mattis sed etiam scelerisque.</p>',
            'user_id' => 1,
            'allowed_comment' => true
        ]);

        $top = Post::create([
            'title' => 'Top 10 Ways to Refresh Your Space',
            'template' => 'default',
            'content' => '<h6 style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; line-height: 1.4; color: #1f1b2d; font-size: 1.125rem; -webkit-font-smoothing: antialiased; font-family: \'Noto Sans\', sans-serif;">Feugiat eget gravida urna placerat posuere pulvinar. Id&nbsp;nibh hendrerit semper urna consequat. Mauris elit tellus risus ultricies ut&nbsp;consequat. Tempor tellus imperdiet nec velit fames pellentesque sed sed arcu. Neque quam id&nbsp;pellentesque in&nbsp;diam&nbsp;in.</h6>
<p style="font-size: 16px; box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased; caret-color: #666276; color: #666276; font-family: \'Noto Sans\', sans-serif;">Purus ornare nisl est&nbsp;nec. Nunc, enim tellus pretium viverra quisque id&nbsp;in&nbsp;metus volutpat. Urna eget velit venenatis, commodo eget massa. Magna donec dictum cras nullam platea. Diam rhoncus massa lectus pellentesque tristique. Amet commodo, egestas vitae bibendum. Volutpat elit condimentum integer tortor porttitor justo vel lobortis risus. Lacinia pellentesque fermentum tellus orci mauris, velit duis eget. Commodo justo, hac ligula molestie felis, iaculis. Vitae dui at&nbsp;ante orci, dictum fusce. Urna, sed urna fringilla faucibus euismod aliquet&nbsp;nec. Quis libero, fermentum amet eu, condimentum auctor. Sit vel ipsum sem tempus gravida&nbsp;et. Scelerisque blandit orci, est quis. Nisi, tellus amet est nascetur habitant faucibus ornare et&nbsp;vivamus.</p>
<p style="font-size: 16px; box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased; caret-color: #666276; color: #666276; font-family: \'Noto Sans\', sans-serif;">Convallis massa nunc, tempus eget egestas sollicitudin mauris. Purus donec sed neque arcu, dictumst tortor nisi, odio. A&nbsp;sit lectus sem velit orci, rhoncus pharetra facilisis. Cras sodales a, dui pellentesque enim odio rutrum&nbsp;leo. Auctor viverra sit sit&nbsp;ut. Massa, elit venenatis, ultrices viverra at&nbsp;sagittis, velit. Cursus tempus phasellus consectetur suspendisse a&nbsp;blandit pellentesque diam neque. Massa est nibh congue elit amet, diam faucibus. Morbi non est semper ullamcorper quam iaculis&nbsp;at.</p>
<blockquote class="blockquote" style="box-sizing: border-box; margin: 0px 0px 1.25rem; -webkit-font-smoothing: antialiased; font-size: 1.125rem; position: relative; color: #1f1b2d; font-weight: bold; font-family: \'Noto Sans\', sans-serif;">
<p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
<footer class="fs-base" style="box-sizing: border-box; -webkit-font-smoothing: antialiased; margin-bottom: 0px; font-size: 1rem !important;">&mdash; Annette Black</footer></blockquote>
<p style="font-size: 16px; box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased; caret-color: #666276; color: #666276; font-family: \'Noto Sans\', sans-serif;">Praesent sed pulvinar posuere nisl tincidunt. Iaculis sit quam magna congue. Amet vel non aliquet habitasse. Egestas erat odio et, eleifend turpis etiam blandit interdum. Nec augue ut&nbsp;senectus quisque diam quis. At&nbsp;augue accumsan, in&nbsp;bibendum. A&nbsp;eget et, eget quisque egestas netus&nbsp;vel. Velit, aliquet turpis convallis ullamcorper. Scelerisque sagittis condimentum pretium in&nbsp;vitae etiam lacinia quis amet. Porttitor consequat, sollicitudin vivamus pharetra nibh faucibus neque, viverra. Praesent amet sed lacus vitae.</p>
<p style="font-size: 16px; box-sizing: border-box; margin-top: 0px; margin-bottom: 1.25rem; -webkit-font-smoothing: antialiased; caret-color: #666276; color: #666276; font-family: \'Noto Sans\', sans-serif;">Velit parturient tellus tellus, congue pulvinar tellus viverra. In cum massa mattis ac. Amet vitae massa ut mi etiam. Auctor aliquam tristique felis donec eu sit nisi. Accumsan mauris eget convallis mattis sed etiam scelerisque.</p>',
            'user_id' => 1,
            'allowed_comment' => true
        ]);

        $how->categories()->sync($home);
        $your->categories()->sync($tips);
        $top->categories()->sync([$home->id, $tips->id]);
    }
}
