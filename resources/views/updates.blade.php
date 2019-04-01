@extends('layouts.page')

@section('content')
    <div class="container mx-auto px-4 pt-6">
        <section class="block md:flex">

            <div class="w-full pb-6">
                <div class="px-2">
                    <h1 class="content-title text-4xl pt-6 mt-4 md:pt-0 md:mt-0 text-center md:text-left">
                        Updates
                    </h1>
                    <p class="mb-4">
                        Lorem ipsum dolor sit amet, stet conclusionemque eu eos. An augue tantas epicurei sea. Saepe civibus mnesarchum eam no, cu veri atqui perfecto quo, usu nusquam constituto no. Numquam abhorreant expetendis mea ex. Malis oporteat vis cu, no dolorum salutatus scriptorem pro, at nam viderer accusamus.
                    </p>
                </div>
            </div>

        </section>

        <section class="block md:flex">

            <div class="block md:w-1/2 pb-8">
                <h2 class="content-title text-2xl pt-6 mt-4 md:pt-0 md:mt-0 text-center">Recent Tweets</h2>
                <section id="twitter">
                    @include('partials.twitter-timeline')
                </section>
            </div>

            <div class="block md:w-1/2 pb-8">
                <h2 class="content-title text-2xl pt-6 mt-4 md:pt-0 md:mt-0 text-center">GitHub Activity</h2>
                <section id="github_activity_feed">
                    @include('partials.github-activity-feed')
                </section>
            </div>

        </section>
    </div>
@endsection

@section('footer-extras')
    <script src="{{ mix('/js/TwitterTimelineWidget.js') }}" charset="utf-8"></script>
    <script src="{{ mix('/js/GitHubActivityTimelineWidget.js') }}" charset="utf-8"></script>
@endsection
