@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Event', 'value' => "Detail", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Infomation
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    </thead>
                    <tbody id="tbody">
                    <tr>
                        <td>Name</td>
                        <td>{{ $event->name_event }}</td>
                    </tr>
                    <tr>
                        <td>Des</td>
                        <td>{{ $event->description_event }}</td>
                    </tr>
                    <tr>
                        <td>Department</td>
                        <td>{{ $event->department }}</td>
                    </tr>
                    <tr>
                        <td>Gold</td>
                        <td>{{ $event->gold }}</td>
                    </tr>
                    </tbody>
                </table>
                <!--begin: Datatable -->
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}">
                    <input type="hidden" name="gold" value="{{ $event->gold }}">
                    <div class="kt-portlet__body">
                        <div class="form-group form-group-last row">
                            <label class="col-form-label col-lg-3 col-sm-12">Add Student</label>
                            <div class="col-lg-12 col-md-9 col-sm-12">
                                <input id="kt_tagify_1" name='user_login' placeholder='Thêm member bằng mã user code'
                                       value='' autofocus data-blacklist='.NET,PHP'>
                                <div class="kt-margin-t-10">
                                    <a href="javascript:;" id="kt_tagify_1_remove" class="btn btn-label-brand btn-bold">Remove
                                        tags</a>
                                    <button type="button" id="submit_event" class="btn btn-brand">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-danger" id="error_type" style="display: none;margin-left: 10px"></div>
                        <div class="kt-separator kt-separator--dashed kt-separator--lg">
                        </div>
                    </div>
                </form>
                <div class="kt-portlet__head-label col-md-2" style="margin-bottom: 20px">

                    <a href="{{ route("qr-code.index", ['id' => $event->id]) }}" class="btn btn-primary">Check in</a>

                </div>
                <div class="kt-portlet__body" style="overflow-x: scroll">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="kt-portlet__head-title">
                                Student List
                            </h3>
                        </div>
                        <div class="col-md-2">
                            Total Student: <span class="btn btn-danger">{{ count($studentEvent) }}</span>
                        </div>
                        <div class="col-md-2">
                            Total Relatives: <span class="btn btn-danger">{{ $totalRelaties }}</span>
                        </div>
                        <div class="col-md-4 text-right">
                            <h3 class="kt-portlet__head-title">
                                <a href="{{ route('export.event', ['id' => $event->id]) }}" data-toggle="kt-tooltip"
                                   title="Xuất Excel"><i class="flaticon-download-1"></i></a>
                            </h3>
                        </div>
                    </div>
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                        <thead class="table-active">
                        <tr>
                            <th class="text-white">STT</th>
                            <th class="text-white">User Code</th>
                            <th class="text-white">FullName</th>
                            <th class="text-white">Name Event</th>
                            <th class="text-white">Gold</th>
                            <th class="text-white">Active</th>
                            <th class="text-white">Action</th>
                        </tr>
                        </thead>
                        <tbody id="tbody-2">
                        <?php $i = 1 ?>
                        @foreach($studentEvent as $item)
                            <?php $name_event = \App\Models\EventSwin::where('id', $item->event_id)->first()->name_event;
                            ?>
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->user_code }}</td>
                                <td>{{ $item->full_name }}</td>
                                <td>{{ $name_event }}</td>
                                <td>{{ $item->gold }} <img width="20px"
                                                           src="{{ asset('assets/admin/images/dong-coin.jpg') }}"
                                                           alt="">
                                </td>
                                <td>@if($item->is_active == 1)
                                        <button type="button"
                                                class="btn btn-success btn-elevate btn-pill btn-elevate-air btn-sm">
                                            Attendance
                                        </button>
                                    @else
                                        <button type="button"
                                                class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">
                                            Warning
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn" id="delete_event" data-id="{{ $item->id }}"
                                            data-toggle="kt-tooltip" title="Delete"
                                            data-original-title="Close"><i class="flaticon-delete"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
@endsection

@section('script')
{{--    <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/tagify.js') }}" type="text/javascript"></script>--}}
{{--    <script src="{{asset('assets/admin/plugins/general/@yaireo/tagify/dist/tagify.polyfills.min.js')}}"--}}
{{--            type="text/javascript"></script>--}}

    <script>
        $(document).ready(function () {
            $("#example").on("click", "#delete_event", function () {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('student-delete') }}/" + id,
                    type: 'GET',
                }).done(function (response) {
                    // Gọi hàm renderCart trả về cart item con
                    location.reload();
                    toastr.success(response.msg_delete);
                });
            })

            $("#submit_event").on("click", function () {
                $.ajax({
                    url: "{{ route('event.update') }}",
                    type: 'POST',
                    data: $("form").serialize(),
                }).done(function (response) {
                    if (!$.isEmptyObject(response.error_type)) {
                        $("#error_type").html('');
                        $("#error_type").css('display', 'block');
                        $("#error_type").append(response.error_type);
                    } else {
                        $('#tbody-2').empty();
                        $('#tbody-2').html(response);
                    }
                });
            })
        });

        var KTTagify = function () {

            // Private functions
            var demo1 = function () {

                $.ajax({
                    url: "{{ route('student.list') }}",
                    type: 'get',
                }).done(function (response) {
                    var input = document.getElementById('kt_tagify_1'),
                        // init Tagify script on the above inputs
                        tagify = new Tagify(input, {
                            whitelist: response,
                            blacklist: [".NET", "PHP"], // <-- passed as an attribute in this demo
                        })
                    // "remove all tags" button rooms listener
                    document.getElementById('kt_tagify_1_remove').addEventListener('click', tagify.removeAllTags.bind(tagify))

                    // Chainable rooms listeners
                    tagify.on('add', onAddTag)
                        .on('remove', onRemoveTag)
                        .on('input', onInput)
                        .on('edit', onTagEdit)
                        .on('invalid', onInvalidTag)
                        .on('click', onTagClick)
                        .on('dropdown:show', onDropdownShow)
                        .on('dropdown:hide', onDropdownHide)

                    // tag added callback
                    function onAddTag(e) {
                        console.log("onAddTag: ", e.detail);
                        console.log("original input value: ", input.value)
                        tagify.off('add', onAddTag) // exmaple of removing a custom Tagify rooms
                    }

                    // tag remvoed callback
                    function onRemoveTag(e) {
                        console.log(e.detail);
                        console.log("tagify instance value:", tagify.value)
                    }

                    // on character(s) added/removed (user is typing/deleting)
                    function onInput(e) {
                        console.log(e.detail);
                        console.log("onInput: ", e.detail);
                    }

                    function onTagEdit(e) {
                        console.log("onTagEdit: ", e.detail);
                    }

                    // invalid tag added callback
                    function onInvalidTag(e) {
                        console.log("onInvalidTag: ", e.detail);
                    }

                    // invalid tag added callback
                    function onTagClick(e) {
                        console.log(e.detail);
                        console.log("onTagClick: ", e.detail);
                    }

                    function onDropdownShow(e) {
                        console.log("onDropdownShow: ", e.detail)
                    }

                    function onDropdownHide(e) {
                        console.log("onDropdownHide: ", e.detail)
                    }
                })

            }

            var demo2 = function () {
                var input = document.getElementById('kt_tagify_2');
                var tagify = new Tagify(input, {
                    enforceWhitelist: true,
                    whitelist: ["The Shawshank Redemption", "The Godfather", "The Godfather: Part II", "The Dark Knight", "12 Angry Men", "Schindler's List", "Pulp Fiction", "The Lord of the Rings: The Return of the King", "The Good, the Bad and the Ugly", "Fight Club", "The Lord of the Rings: The Fellowship of the Ring", "Star Wars: Episode V - The Empire Strikes Back", "Forrest Gump", "Inception", "The Lord of the Rings: The Two Towers", "One Flew Over the Cuckoo's Nest", "Goodfellas", "The Matrix", "Seven Samurai", "Star Wars: Episode IV - A New Hope", "City of God", "Se7en", "The Silence of the Lambs", "It's a Wonderful Life", "The Usual Suspects", "Life Is Beautiful", "Léon: The Professional", "Spirited Away", "Saving Private Ryan", "La La Land", "Once Upon a Time in the West", "American History X", "Interstellar", "Casablanca", "Psycho", "City Lights", "The Green Mile", "Raiders of the Lost Ark", "The Intouchables", "Modern Times", "Rear Window", "The Pianist", "The Departed", "Terminator 2: Judgment Day", "Back to the Future", "Whiplash", "Gladiator", "Memento", "Apocalypse Now", "The Prestige", "The Lion King", "Alien", "Dr. Strangelove or: How I Learned to Stop Worrying and Love the Bomb", "Sunset Boulevard", "The Great Dictator", "Cinema Paradiso", "The Lives of Others", "Paths of Glory", "Grave of the Fireflies", "Django Unchained", "The Shining", "WALL·E", "American Beauty", "The Dark Knight Rises", "Princess Mononoke", "Aliens", "Oldboy", "Once Upon a Time in America", "Citizen Kane", "Das Boot", "Witness for the Prosecution", "North by Northwest", "Vertigo", "Star Wars: Episode VI - Return of the Jedi", "Reservoir Dogs", "M", "Braveheart", "Amélie", "Requiem for a Dream", "A Clockwork Orange", "Taxi Driver", "Lawrence of Arabia", "Like Stars on Earth", "Double Indemnity", "To Kill a Mockingbird", "Eternal Sunshine of the Spotless Mind", "Toy Story 3", "Amadeus", "My Father and My Son", "Full Metal Jacket", "The Sting", "2001: A Space Odyssey", "Singin' in the Rain", "Bicycle Thieves", "Toy Story", "Dangal", "The Kid", "Inglourious Basterds", "Snatch", "Monty Python and the Holy Grail", "Hacksaw Ridge", "3 Idiots", "L.A. Confidential", "For a Few Dollars More", "Scarface", "Rashomon", "The Apartment", "The Hunt", "Good Will Hunting", "Indiana Jones and the Last Crusade", "A Separation", "Metropolis", "Yojimbo", "All About Eve", "Batman Begins", "Up", "Some Like It Hot", "The Treasure of the Sierra Madre", "Unforgiven", "Downfall", "Raging Bull", "The Third Man", "Die Hard", "Children of Heaven", "The Great Escape", "Heat", "Chinatown", "Inside Out", "Pan's Labyrinth", "Ikiru", "My Neighbor Totoro", "On the Waterfront", "Room", "Ran", "The Gold Rush", "The Secret in Their Eyes", "The Bridge on the River Kwai", "Blade Runner", "Mr. Smith Goes to Washington", "The Seventh Seal", "Howl's Moving Castle", "Lock, Stock and Two Smoking Barrels", "Judgment at Nuremberg", "Casino", "The Bandit", "Incendies", "A Beautiful Mind", "A Wednesday", "The General", "The Elephant Man", "Wild Strawberries", "Arrival", "V for Vendetta", "Warrior", "The Wolf of Wall Street", "Manchester by the Sea", "Sunrise", "The Passion of Joan of Arc", "Gran Torino", "Rang De Basanti", "Trainspotting", "Dial M for Murder", "The Big Lebowski", "The Deer Hunter", "Tokyo Story", "Gone with the Wind", "Fargo", "Finding Nemo", "The Sixth Sense", "The Thing", "Hera Pheri", "Cool Hand Luke", "Andaz Apna Apna", "Rebecca", "No Country for Old Men", "How to Train Your Dragon", "Munna Bhai M.B.B.S.", "Sholay", "Kill Bill: Vol. 1", "Into the Wild", "Mary and Max", "Gone Girl", "There Will Be Blood", "Come and See", "It Happened One Night", "Life of Brian", "Rush", "Hotel Rwanda", "Platoon", "Shutter Island", "Network", "The Wages of Fear", "Stand by Me", "Wild Tales", "In the Name of the Father", "Spotlight", "Star Wars: The Force Awakens", "The Nights of Cabiria", "The 400 Blows", "Butch Cassidy and the Sundance Kid", "Mad Max: Fury Road", "The Maltese Falcon", "12 Years a Slave", "Ben-Hur", "The Grand Budapest Hotel", "Persona", "Million Dollar Baby", "Amores Perros", "Jurassic Park", "The Princess Bride", "Hachi: A Dog's Tale", "Memories of Murder", "Stalker", "Nausicaä of the Valley of the Wind", "Drishyam", "The Truman Show", "The Grapes of Wrath", "Before Sunrise", "Touch of Evil", "Annie Hall", "The Message", "Rocky", "Gandhi", "Harry Potter and the Deathly Hallows: Part 2", "The Bourne Ultimatum", "Diabolique", "Donnie Darko", "Monsters, Inc.", "Prisoners", "8½", "The Terminator", "The Wizard of Oz", "Catch Me If You Can", "Groundhog Day", "Twelve Monkeys", "Zootopia", "La Haine", "Barry Lyndon", "Jaws", "The Best Years of Our Lives", "Infernal Affairs", "Udaan", "The Battle of Algiers", "Strangers on a Train", "Dog Day Afternoon", "Sin City", "Kind Hearts and Coronets", "Gangs of Wasseypur", "The Help"],
                    callbacks: {
                        add: console.log, // callback when adding a tag
                        remove: console.log // callback when removing a tag
                    }
                });
            }

            var demo3 = function () {
                var input = document.getElementById('kt_tagify_3');

                // init Tagify script on the above inputs
                var tagify = new Tagify(input);

                // add a class to Tagify's input element
                //tagify.DOM.input.classList.remove('tagify__input');
                tagify.DOM.input.classList.add('form-control');
                tagify.DOM.input.setAttribute('placeholder', 'enter tag...');

                // re-place Tagify's input element outside of the  element (tagify.DOM.scope), just before it
                tagify.DOM.scope.parentNode.insertBefore(tagify.DOM.input, tagify.DOM.scope);
            }

            var demo4 = function () {
                var input = document.getElementById('kt_tagify_4');
                var tagify = new Tagify(input, {
                    pattern: /^.{0,20}$/, // Validate typed tag(s) by Regex. Here maximum chars length is defined as "20"
                    delimiters: ", ", // add new tags when a comma or a space character is entered
                    maxTags: 6,
                    blacklist: ["fuck", "shit", "pussy"],
                    keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
                    whitelist: ["temple", "stun", "detective", "sign", "passion", "routine", "deck", "discriminate", "relaxation", "fraud", "attractive", "soft", "forecast", "point", "thank", "stage", "eliminate", "effective", "flood", "passive", "skilled", "separation", "contact", "compromise", "reality", "district", "nationalist", "leg", "porter", "conviction", "worker", "vegetable", "commerce", "conception", "particle", "honor", "stick", "tail", "pumpkin", "core", "mouse", "egg", "population", "unique", "behavior", "onion", "disaster", "cute", "pipe", "sock", "dialect", "horse", "swear", "owner", "cope", "global", "improvement", "artist", "shed", "constant", "bond", "brink", "shower", "spot", "inject", "bowel", "homosexual", "trust", "exclude", "tough", "sickness", "prevalence", "sister", "resolution", "cattle", "cultural", "innocent", "burial", "bundle", "thaw", "respectable", "thirsty", "exposure", "team", "creed", "facade", "calendar", "filter", "utter", "dominate", "predator", "discover", "theorist", "hospitality", "damage", "woman", "rub", "crop", "unpleasant", "halt", "inch", "birthday", "lack", "throne", "maximum", "pause", "digress", "fossil", "policy", "instrument", "trunk", "frame", "measure", "hall", "support", "convenience", "house", "partnership", "inspector", "looting", "ranch", "asset", "rally", "explicit", "leak", "monarch", "ethics", "applied", "aviation", "dentist", "great", "ethnic", "sodium", "truth", "constellation", "lease", "guide", "break", "conclusion", "button", "recording", "horizon", "council", "paradox", "bride", "weigh", "like", "noble", "transition", "accumulation", "arrow", "stitch", "academy", "glimpse", "case", "researcher", "constitutional", "notion", "bathroom", "revolutionary", "soldier", "vehicle", "betray", "gear", "pan", "quarter", "embarrassment", "golf", "shark", "constitution", "club", "college", "duty", "eaux", "know", "collection", "burst", "fun", "animal", "expectation", "persist", "insure", "tick", "account", "initiative", "tourist", "member", "example", "plant", "river", "ratio", "view", "coast", "latest", "invite", "help", "falsify", "allocation", "degree", "feel", "resort", "means", "excuse", "injury", "pupil", "shaft", "allow", "ton", "tube", "dress", "speaker", "double", "theater", "opposed", "holiday", "screw", "cutting", "picture", "laborer", "conservation", "kneel", "miracle", "brand", "nomination", "characteristic", "referral", "carbon", "valley", "hot", "climb", "wrestle", "motorist", "update", "loot", "mosquito", "delivery", "eagle", "guideline", "hurt", "feedback", "finish", "traffic", "competence", "serve", "archive", "feeling", "hope", "seal", "ear", "oven", "vote", "ballot", "study", "negative", "declaration", "particular", "pattern", "suburb", "intervention", "brake", "frequency", "drink", "affair", "contemporary", "prince", "dry", "mole", "lazy", "undermine", "radio", "legislation", "circumstance", "bear", "left", "pony", "industry", "mastermind", "criticism", "sheep", "failure", "chain", "depressed", "launch", "script", "green", "weave", "please", "surprise", "doctor", "revive", "banquet", "belong", "correction", "door", "image", "integrity", "intermediate", "sense", "formal", "cane", "gloom", "toast", "pension", "exception", "prey", "random", "nose", "predict", "needle", "satisfaction", "establish", "fit", "vigorous", "urgency", "X-ray", "equinox", "variety", "proclaim", "conceive", "bulb", "vegetarian", "available", "stake", "publicity", "strikebreaker", "portrait", "sink", "frog", "ruin", "studio", "match", "electron", "captain", "channel", "navy", "set", "recommend", "appoint", "liberal", "missile", "sample", "result", "poor", "efflux", "glance", "timetable", "advertise", "personality", "aunt", "dog"],
                    transformTag: transformTag,
                    dropdown: {
                        enabled: 3,
                    }
                });

                function transformTag(tagData) {
                    var states = [
                        'success',
                        'brand',
                        'danger',
                        'success',
                        'warning',
                        'dark',
                        'primary',
                        'info'];

                    tagData.class = 'tagify__tag tagify__tag--' + states[KTUtil.getRandomInt(0, 7)];

                    if (tagData.value.toLowerCase() == 'shit') {
                        tagData.value = 's✲✲t'
                    }
                }

                tagify.on('add', function (e) {
                    console.log(e.detail)
                });

                tagify.on('invalid', function (e) {
                    console.log(e, e.detail);
                });
            }

            var demo5 = function () {
                // Init autocompletes
                var toEl = document.getElementById('kt_tagify_5');
                var tagifyTo = new Tagify(toEl, {
                    delimiters: ", ", // add new tags when a comma or a space character is entered
                    maxTags: 10,
                    blacklist: ["fuck", "shit", "pussy"],
                    keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
                    whitelist: [
                        {
                            value: 'Chris Muller',
                            email: 'chris.muller@wix.com',
                            initials: '',
                            initialsState: '',
                            pic: './assets/media/users/100_11.jpg',
                            class: 'tagify__tag--brand'
                        }, {
                            value: 'Nick Bold',
                            email: 'nick.seo@gmail.com',
                            initials: 'SS',
                            initialsState: 'warning',
                            pic: ''
                        }, {
                            value: 'Alon Silko',
                            email: 'alon@keenthemes.com',
                            initials: '',
                            initialsState: '',
                            pic: './assets/media/users/100_6.jpg'
                        }, {
                            value: 'Sam Seanic',
                            email: 'sam.senic@loop.com',
                            initials: '',
                            initialsState: '',
                            pic: './assets/media/users/100_8.jpg'
                        }, {
                            value: 'Sara Loran',
                            email: 'sara.loran@tilda.com',
                            initials: '',
                            initialsState: '',
                            pic: './assets/media/users/100_9.jpg'
                        }, {
                            value: 'Eric Davok',
                            email: 'davok@mix.com',
                            initials: '',
                            initialsState: '',
                            pic: './assets/media/users/100_13.jpg'
                        }, {
                            value: 'Sam Seanic',
                            email: 'sam.senic@loop.com',
                            initials: '',
                            initialsState: '',
                            pic: './assets/media/users/100_13.jpg'
                        }, {
                            value: 'Lina Nilson',
                            email: 'lina.nilson@loop.com',
                            initials: 'LN',
                            initialsState: 'danger',
                            pic: './assets/media/users/100_15.jpg'
                        }],
                    templates: {
                        dropdownItem: function (tagData) {
                            try {
                                return '<div class="tagify__dropdown__item">' +
                                    '<div class="kt-media-card">' +
                                    '    <span class="kt-media kt-media--' + (tagData.initialsState ? tagData.initialsState : '') + '" style="background-image: url(' + tagData.pic + ')">' +
                                    '        <span>' + tagData.initials + '</span>' +
                                    '    </span>' +
                                    '    <div class="kt-media-card__info">' +
                                    '        <a href="#" class="kt-media-card__title">' + tagData.value + '</a>' +
                                    '        <span class="kt-media-card__desc">' + tagData.email + '</span>' +
                                    '    </div>' +
                                    '</div>' +
                                    '</div>';
                            } catch (err) {
                            }
                        }
                    },
                    transformTag: function (tagData) {
                        tagData.class = 'tagify__tag tagify__tag--brand';
                    },
                    dropdown: {
                        classname: "color-blue",
                        enabled: 1,
                        maxItems: 5
                    }
                });
            }

            return {
                // public functions
                init: function () {
                    demo1();
                    demo2();
                    demo3();
                    demo4();
                    demo5();
                }
            };
        }();

        jQuery(document).ready(function () {
            KTTagify.init();
        });

    </script>
@endsection
